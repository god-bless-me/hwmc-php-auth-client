<?php

namespace App\Http\Controllers\Api;

use App\Models\App;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function accessToken(Request $request)
    {
        $id = $request->input('id');
        $secret = $request->input('secret');
        $code = $request->input('code');

        $app = App::whereId($id)->whereSecret($secret)->first();

        if (!$app) {
            return $this->response([], 400, 'id or secret error');
        }

        $user = User::GetUserWithCode($app, $code);

        if (!$user) {
            return $this->response([], 400, 'code err');
        }

        $token = $user->newAccessToken($app);
        return $this->response($token);
    }

}