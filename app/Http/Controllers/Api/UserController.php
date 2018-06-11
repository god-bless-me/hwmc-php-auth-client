<?php

namespace App\Http\Controllers\Api;

use App\Models\AccessToken;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function info(Request $request)
    {
        $token = $request->input('access_token');

        $accessToken = AccessToken::whereAccessToken($token)->valid()->first();
        if (!$accessToken) {
            return $this->response([], 400, 'token is err');
        }

        $user = $accessToken->user;
        if (!$user) {
            return $this->response([], 404, 'user not found');
        }

        $data = $user->toArray();
        $data['roles'] = $user->appRoles($accessToken->app_id);
        return $this->response($data);
    }

}