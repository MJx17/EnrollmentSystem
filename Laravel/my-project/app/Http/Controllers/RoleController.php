<?php

namespace App\Http\Controllers;

use App\Helpers\LaravelLogger;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $roles = Role::paginate(10);
        // dd($roles);
        // auth()->user()->can('transactions.index');
        return view('roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'name' => 'required',
        ]);

        $role = Role::create(['name' => $request->name]);

        // dd($role->getAttributes());
        // // Log the form submission
        // LaravelLogger::log('info' [
        //     // 'user_id' => auth()->id(),
        //     // 'form_data' => $validatedData, // Do not include sensitive data here
        // ]);

        LaravelLogger::log('Role Created', [
            // 'user_id' => auth()->id(),
             $role->getAttributes(),
        ]);

        // dd($role);
        return redirect()->route('roles.create')->with('success', 'Role created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $id)
    {
        //
        $permissions = Permission::all();
        return view('roles.edit', ['role' => $id, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'permissions' => 'required',
        ]);
        // dd($request->permissions);

        // $roles = Role::where('name', $request->name)->first();

        // $role = Role::find($id);
        // dd($role);

        // $role = $id;


        // dd($request->permissions);

        $permission = Permission::find($request->permissions);
        // dd($permission);

        $role->syncPermissions($permission);
        auth()->user()->can('transactions.index');


        return redirect()->route('roles.edit', $role->id)->with('success', 'Role updated successfully.');





    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
        // $job = Job::findOrFail($id);
        // if (!$job) {
        //     abort(404);
        // }
        $role->delete();

        // Job::findOrFail($id)->delete();

        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}