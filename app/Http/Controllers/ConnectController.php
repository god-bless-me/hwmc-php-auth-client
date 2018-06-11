<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\User;
use App\WeiXin\Work;
use function GuzzleHttp\Psr7\parse_query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ConnectController extends Controller
{

    /**
     * @var Work;
     */
    protected $client;

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        /**
         * @var $user User
         */
        $user = $request->user();
        $redirect = $request->input('redirect');
        $appid = $request->input('appid');

        $app = App::find($appid);

        if (!$app) {
            return view('oauth', [
                'error' => '参数错误！！！',
                'redirect' => $redirect,
            ]);
        }

        if (!$app->validate($redirect)) {
            return view('oauth', [
                'error' => '回调域名错误！！！',
                'redirect' => $redirect,
            ]);
        }

        return redirect($this->merge($redirect, [
            'pd_code' => $user->code($app),
        ]));
    }

    protected function merge($redirect, $params)
    {
        if (Str::contains($redirect, '?')) {
            list($redirect, $query) = explode('?', $redirect);
            $params += parse_query($query);
        }
        $query = http_build_query($params);
        return $redirect . '?' . $query;
    }

}
