<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function createForModule(Request $module)
    {
        //
        // Permission::create(['name'=> $module->name.'*']);

        return view('permissions.moduleCreate');
    }

    public function storeForModule(Request $module)
    {
        //
        // dd($module->name);
        Permission::create(['name'=> $module->name.'.*']);

        return view('permissions.moduleCreate');
    }




    public function index()
    {
        //
        $permissions = Permission::paginate(10);
        return view('permissions.index',['permissions' => $permissions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('permissions.create');
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

        $permission = Permission::create(['name' => $request->name]);

        return redirect()->route('permissions.create')->with('success', 'Permission created successfully.');
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
    public function edit(Permission $id)
    {
        //
        return view('permissions.edit', ['permission' => $id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        //
         //
        // dd($request->all());
        $request->validate([
            'name' => 'required',
        ]);

        $permission->update(['name' => $request->name]);

        return redirect()->route('permissions.edit', $permission->id)->with('success', 'Permission updated successfully.');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        //
        //
         // $job = Job::findOrFail($id);
        // if (!$job) {
        //     abort(404);
        // }
        $permission->delete();

        // Job::findOrFail($id)->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
