<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function __construct()
    {
        $user = app('request')->user();
        if ($user) {
            $roles = $user->appRoles(100000);

            app('view')->share('user', $user);
            app('view')->share('roles', $roles);
        }

        $messages = $this->getMessages();
        app('view')->share('messages', $messages);
    }

    public function success($msg)
    {
        return $this->message('success', $msg);
    }

    public function error($msg)
    {
        return $this->message('danger', $msg);
    }

    public function message($type, $message)
    {
        $key = 'messages';
        $cache = app('cache');
        $messages = $cache->get($key);
        $messages[] = [
            'type' => $type,
            'message' => $message,
        ];
        $cache->put($key, $messages, 10);
    }

    public function getMessages()
    {
        $key = 'messages';
        $cache = app('cache');
        $messages = $cache->pull($key);
        return $messages;
    }

}
