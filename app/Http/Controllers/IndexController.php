<?php

namespace App\Http\Controllers;

use App\Models\User;
use EasyWeChat\Work\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Cookie;

class IndexController extends Controller
{

    /**
     * @var Application;
     */
    protected $client;

    public function __construct()
    {
        parent::__construct();

        $this->client = app('wechat.work');
    }

    /**
     * 登录页
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Laravel\Lumen\Http\Redirector
     */
    public function login(Request $request)
    {
        $redirect = $request->getSchemeAndHttpHost() . '/oauth?redirect=' . urlencode($request->input('redirect'));

        $oauth = $this->client->oauth->agent(config('wechat.work.default.agent_id'));

        //如果不是微信内访问则干掉scopes，使用二维码登录
        if (strpos($request->userAgent(), 'MicroMessenger') === false) {
            $oauth->scopes([]);
        }

        return $oauth->redirect($redirect);
    }

    /**
     *
     */
    public function logout(Request $request)
    {
        return (new Response())->withCookie(new Cookie(User::CookieName, ''))->withHeaders([
            'Location' => '/'
        ]);
    }

    /**
     * 登录授权回调页
     * @param Request $request
     * @return Response|null
     */
    public function oauth(Request $request)
    {
        $redirect = $request->input('redirect');
        $code = $request->input('code');
        $stage = $request->input('stage');

        $token = $this->client->oauth->getAccessToken($code);
        $user = $this->client->oauth->user($token);
        if ($user['id']) {
            $info = $this->client->user->get($user['id']);
        } else {
            return view('oauth', ['error' => $user['original']['errmsg'], 'redirect' => $redirect]);
        }

        if (!$info['enable']) {
            return view('oauth', ['error' => '用户已禁用', 'redirect' => $redirect]);
        }

        if ($info) {
            if (!empty($info['errcode'])) {
                return view('oauth', ['error' => $info['errmsg'], 'redirect' => $redirect]);
            }
            $user = User::whereUsername($info['userid'])->first();
            if (empty($user)) {
                $user = new User();
                $user->username = strtolower($info['userid']);
            }

            $user->name = $info['name'];
            $user->avatar = !Str::startsWith($info['avatar'], 'https:') ? ltrim($info['avatar'], 'http:') : $info['avatar'];
            $user->mobile = $info['mobile'];
            $user->email = $info['email'];
            $user->gender = $info['gender'];
            $user->enable = $info['enable'];
            $user->hide_mobile = $info['hide_mobile'];
            $user->save();

            return (new Response())->withCookie($user->toCookie())->withHeaders([
                'Location' => $redirect
            ]);
        }
        return view('oauth', ['error' => '用户已禁用', 'redirect' => $redirect]);
    }

    public function index(Request $request)
    {
        /**
         * @var $user User
         */
        $user = $request->user();

        return view('index', [
            'user' => $user,
            'ua' => $request->userAgent(),
        ]);
    }
}
