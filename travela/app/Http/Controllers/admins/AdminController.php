<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function tours()
    {
        return view('admin.tours');
    }

    public function users()
    {
        return view('admin.users');
    }

    public function bookings()
    {
        return view('admin.bookings');
    }

    public function comments()
    {
        return view('admin.comments');
    }

    public function statsTours()
    {
        return view('admin.stats_tours');
    }

    public function statsRevenue()
    {
        return view('admin.stats_revenue');
    }
}