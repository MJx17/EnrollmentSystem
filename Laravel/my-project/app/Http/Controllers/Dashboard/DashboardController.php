<?php

// DashboardController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // You can fetch user-specific data here
        // For example, let's assume you are getting user data from the authenticated user
        $user = auth()->user();

        // Pass the user data to the dashboard view
        return view('dashboard', compact('user'));
    }
}
