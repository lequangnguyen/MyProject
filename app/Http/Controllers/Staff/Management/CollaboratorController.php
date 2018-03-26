<?php

namespace App\Http\Controllers\Staff\Management;

use Illuminate\Http\Request;
use App\Http\Requests\Staff\Management\Collaborator\StoreCollaboratorRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Enterprise\Collaborator;
use App\Models\Enterprise\Business;
use App\Models\Enterprise\GLN;
use App\Models\Social\Country;
use GuzzleHttp\Exception\RequestException;
use Carbon\Carbon;
use Mail;
use App\Remote\Remote;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;

use Event;
use App\Events\CollaboratorHasBeenAdded;

class CollaboratorController extends Controller
{
    public function index()
    {
        if (auth()->guard('staff')->user()->cannot('list-collaborator')) {
            abort(403);
        }
        $collaborators = Collaborator::orderBy('created_at', 'desc')->get();

        return view('staff.management.collaborator.index', compact('collaborators'));
    }

    public function add()
    {
        if (auth()->guard('staff')->user()->cannot('add-collaborator')) {
            abort(403);
        }
        return view('staff.management.collaborator.form');
    }

    public function store(StoreCollaboratorRequest $request, Remote $remote)
    {
        if (auth()->guard('staff')->user()->cannot('add-collaborator')) {
            abort(403);
        }

        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $client = new \GuzzleHttp\Client();

            try {
                $res = $client->request(
                    'POST',
                    'http://upload.icheck.vn/v1/images?uploadType=simple',
                    [
                        'body' => file_get_contents($request->file('avatar')),
                    ]
                );
                $res = json_decode((string) $res->getBody());
            } catch (RequestException $e) {
                return $e->getResponse()->getBody();
            }

            $data['avatar'] = $res->prefix;
        }

        if (!($password = $request->input('password'))) {
            $password = str_random(12);
        }

        $data['password'] = bcrypt($password);

        $collaborator = Collaborator::create($data);
        $collaborator->activatedBy()->associate(auth()->guard('staff')->user()->id);
        $collaborator->activated_at = Carbon::now();
        $collaborator->status = Collaborator::STATUS_ACTIVATED;
        $collaborator->save();

        Event::fire(new CollaboratorHasBeenAdded($collaborator, $password));

        return redirect()->route('Staff::Management::collaborator@index')
            ->with('success', 'Đã thêm Cộng tác viên ' . $collaborator->name);
    }

    public function sendLoginInfoEmail($business, $password)
    {
        Mail::raw('Mật khẩu của bé là: ' . $password,
            function ($message) use ($business) {
                $message->from('business@icheck.vn', 'iCheck cho doanh nghiệp');
                $message->to($business->login_email, $business->name);
                $message->subject('Thông tin đăng nhập iCheck cho doanh nghiệp');
            }
        );
    }

    public function show($id)
    {
        if (auth()->guard('staff')->user()->cannot('list-collaborator')) {
            abort(403);
        }
        $collaborator = Collaborator::findOrFail($id);

        return view('staff.management.collaborator.show', compact('business'));
    }

    public function edit($id)
    {
        if (auth()->guard('staff')->user()->cannot('edit-collaborator')) {
            abort(403);
        }
        $collaborator = Collaborator::findOrFail($id);

        return view('staff.management.collaborator.form', compact('collaborator'));
    }

    public function update($id, Request $request)
    {
        if (auth()->guard('staff')->user()->cannot('edit-collaborator')) {
            abort(403);
        }
        $collaborator = Collaborator::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:255',
            'avatar' => 'image',
            'address' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'password' => 'min:6|confirmed',
        ]);

        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $client = new \GuzzleHttp\Client();

            try {
                $res = $client->request(
                    'POST',
                    'http://upload.icheck.vn/v1/images?uploadType=simple',
                    [
                        'body' => file_get_contents($request->file('avatar')),
                    ]
                );
                $res = json_decode((string) $res->getBody());
            } catch (RequestException $e) {
                return $e->getResponse()->getBody();
            }

            $data['avatar'] = $res->prefix;
        }

        if (!$request->input('password')) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        $collaborator->update($data);

        return redirect()->route('Staff::Management::collaborator@edit', $collaborator->id)
            ->with('success', 'Đã cập nhật thông tin CTV');
    }

    public function approve($id, Request $request)
    {
        if (auth()->guard('staff')->user()->cannot('edit-collaborator')) {
            abort(403);
        }
        $business = Business::findOrFail($id);

        $this->validate($request, [
            'login_email' => 'required|email|unique:businesses,login_email',
            'password' => 'min:6|confirmed',
        ]);

        $gln = $business->gln->first();
        $duplicatedGln = GLN::where('gln', $gln->gln)
            ->where('status', GLN::STATUS_APPROVED)
            ->whereHas('business', function ($query) use ($business) {
                $query->where('id', '!=', $business->id);
            })
            ->first()
        ;

        if (!is_null($duplicatedGln)) {
            return redirect()->back()
                ->withErrors(['gln' => 'Mã địa điểm toàn cầu (GLN) ' . $gln->gln . ' đã được đăng ký bởi một doanh nghiệp khác.'])
                ->withInput()
            ;
        }

        $gln->status = GLN::STATUS_APPROVED;
        $gln->save();

        if (!($password = $request->input('password'))) {
            $password = str_random(12);
        }

        $business->login_email = $request->input('login_email');
        $business->password = bcrypt($password);
        $business->activatedBy()->associate(auth()->guard('staff')->user()->id);
        $business->activated_at = Carbon::now();
        $business->status = Business::STATUS_ACTIVATED;
        $business->save();

        $this->sendLoginInfoEmail($business, $password);

        return redirect()->route('Staff::Management::business@show', $business->id)
            ->with('success', 'Kích hoạt thành công tài khoản cho doanh nghiệp');
    }

    public function delete($id, Request $request)
    {
        if (auth()->guard('staff')->user()->cannot('edit-collaborator')) {
            abort(403);
        }
        $collaborator = Collaborator::findOrFail($id);

        return redirect()->route('Staff::Management::collaborator@index')
            ->with('success', 'Đã xoá CTV');
    }

    public function withdrawMoney($id, Request $request)
    {
        if (auth()->guard('staff')->user()->cannot('edit-collaborator')) {
            abort(403);
        }
        $collaborator = Collaborator::findOrFail($id);
        $collaborator->balance = 0;
        $collaborator->save();

        return redirect()->route('Staff::Management::collaborator@index')
            ->with('success', 'Đã rút sạch tiền của ' . $collaborator->name);
    }


}
