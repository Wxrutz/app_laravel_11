<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }
    public function dashboard()
    {
        $users = User::all();
        $courses = Course::all();

        // Prepare data for the chart
        $userLabels = $users->groupBy(function($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('M Y');
        })->keys();

        $userCounts = $users->groupBy(function($date) {
            return \Carbon\Carbon::parse($date->created_at)->format('M Y');
        })->map(function ($row) {
            return count($row);
        })->values();

        return view('admin.dashboard', compact('users', 'courses', 'userLabels', 'userCounts'));
    }
}
