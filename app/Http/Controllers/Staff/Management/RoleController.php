<?php


namespace App\Http\Controllers\Staff\Management;

use App\Models\Enterprise\Permission;
use App\Models\Enterprise\Role;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\RequestException;
use Auth;


class RoleController extends Controller
{
    public function index()
    {
        if (auth()->guard('staff')->user()->cannot('list-role')) {
            abort(403);
        }

        $roles = Role::paginate(15);
        return view('staff.management.role.index',compact('roles'));
    }

    public function add()
    {
        if (auth()->guard('staff')->user()->cannot('add-role')) {
            abort(403);
        }

        $permission = Permission::all();
        return view('staff.management.role.form', compact('permission'));
    }

    public function store(Request $request)
    {
        if (auth()->guard('staff')->user()->cannot('add-role')) {
            abort(403);
        }

        $this->validate($request,[
            'name' =>'required',
        ]);
        $data = $request->all();
        $role = Role::create($data);
        $role->save();
        $permissions = [];
        foreach($request->input('status',[]) as $permissionId=>$value){
            $permissions[$permissionId] = ['value'=>$value];
        }

        $role->permissions()->sync($permissions);

        return redirect()->route('Staff::Management::role@index')
            ->with('success', 'Đã thêm');
    }

    public function edit($id)
    {
        if (auth()->guard('staff')->user()->cannot('edit-role')) {
            abort(403);
        }

        $role = Role::findOrFail($id);
        $permission = Permission::all();
        $rolePermissions = $role->permissions->keyBy('id');
        return view('staff.management.role.form',compact('role','permission','rolePermissions'));
    }

    public function update($id,Request $request)
    {
        if (auth()->guard('staff')->user()->cannot('edit-role')) {
            abort(403);
        }

        $this->validate($request,[
            'name' => 'required',
        ]);

        $role = Role::findOrFail($id);
        $data = $request->all();

        $permissions = [];
        foreach($request->input('status',[]) as $permissionId=>$value){
            $permissions[$permissionId] = ['value'=>$value];
        }

        $role->permissions()->sync($permissions);


        $role->update($data);


        return redirect()->route('Staff::Management::role@index',$role->id)
            ->with('success', 'Đã cập nhật');
    }

    public function delete($id)
    {
        if (auth()->guard('staff')->user()->cannot('delete-role')) {
            abort(403);
        }

        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('Staff::Management::role@index')->with('success', 'Đã xoá thành công');
    }


}
