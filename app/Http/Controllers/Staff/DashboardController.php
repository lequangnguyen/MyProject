<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Enterprise\Vendor;
use App\Models\Enterprise\Product;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('staff.dashboard');
    }
}
