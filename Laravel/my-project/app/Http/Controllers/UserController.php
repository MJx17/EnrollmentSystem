<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Get the search term and filter value from the request
        $search = $request->input('search');
        $roleFilter = $request->input('role');

        // Build the query
        $usersQuery = User::with('roles');

        // If there's a search term, filter users by name or email
        if ($search) {
            $usersQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // If a role filter is applied, filter users by role
        if ($roleFilter) {
            $usersQuery->whereHas('roles', function ($query) use ($roleFilter) {
                $query->where('name', $roleFilter);
            });
        }

        // Paginate the results
        $users = $usersQuery->paginate(10);

        // Return the view with the filtered users
        return view('users.index', compact('users', 'search', 'roleFilter'));
    }
}
