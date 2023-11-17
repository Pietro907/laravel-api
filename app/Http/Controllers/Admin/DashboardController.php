<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        return view('admin.dashboard');
    }
}
