<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Fetch users with roles and paginate results (10 users per page)
        $users = User::with('roles')->paginate(10);

        return view('users.index', compact('users'));
    }
}
