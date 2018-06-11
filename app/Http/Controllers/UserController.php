<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __constrict()
    {
        parent::__construct();
    }

    public function users(Request $request)
    {
        $users = User::paginate(20);
        return view('user/users', ['users' => $users, 'genders' => [
            1 => '男', 2 => '女'
        ]]);
    }
}
