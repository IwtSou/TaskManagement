<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ApiUserController extends Controller
{
    public function getUsers()
    {

        return response()->json(['users' => User::select('id', 'name')->get()]);
    }
}
