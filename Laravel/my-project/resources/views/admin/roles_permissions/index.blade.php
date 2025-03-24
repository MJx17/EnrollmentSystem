@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Roles and Permissions</h1>
        
        <h2>Roles</h2>
        <ul>
            @foreach($roles as $role)
                <li>{{ $role->name }}</li>
            @endforeach
        </ul>

        <h2>Permissions</h2>
        <ul>
            @foreach($permissions as $permission)
                <li>{{ $permission->name }}</li>
            @endforeach
        </ul>
    </div>
@endsection
