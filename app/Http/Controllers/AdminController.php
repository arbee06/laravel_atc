<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function admin()
    {
        $user = User::all();
        return view("admin.admin",compact(['user']));
    }

}
