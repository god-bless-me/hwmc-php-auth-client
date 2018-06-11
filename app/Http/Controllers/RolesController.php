<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function __constrict()
    {
        parent::__construct();
    }

    public function roles(Request $request)
    {
        $appId = $request->input('app_id');
        $query = Role::with('app');

        if ($appId) {
            $query->whereAppId($appId);
        }

        $list = $query->paginate();
        return view('roles/roles', [
            'appId' => $appId,
            'list' => $list,
            'apps' => App::get(),
        ]);
    }

    public function add(Request $request)
    {
        $appId = $request->input('app_id');
        $name = $request->input('name');
        $key = $request->input('key');
        $desc = $request->input('desc');

        $role = new Role();
        $role->app_id = $appId;
        $role->name = $name;
        $role->key = $key;
        $role->desc = $desc;
        $role->save();
        $this->success('添加成功');
        return redirect('/roles?app_id=' . $appId);
    }

    public function users(Request $request)
    {
        $id = $request->input('role_id');
        $role = Role::find($id);

        if (!$role->allow($request->user())) {
            $this->error('你没有编辑该角色的权限');
            return redirect('/');
        }

        $items = $role->users;

        return view('roles/users', [
            'role_id' => $id,
            'items' => $items,
            'users' => User::enable()->get(),
        ]);
    }

    public function addUser(Request $request)
    {
        $role = Role::find($request->input('role_id'));

        if (!$role->allow($request->user())) {
            $this->error('你没有编辑该角色的权限');
            return redirect('/roles/users?role_id=' . $role->id);
        }

        $user = User::find($request->input('user_id'));

        $ur = UserRole::whereUserId($user->id)->whereRoleId($role->id)->first();
        if (!$ur) {
            $ur = new UserRole();
            $ur->role_id = $role->id;
            $ur->user_id = $user->id;
            $ur->app_id = $role->app->id;
        }

        $expiredAt = date('Y-m-d H:i:s', strtotime($request->input('expired_at')));
        if ($expiredAt == '1970-01-01 08:00:00') {
            $expiredAt = null;
        }

        $ur->expired_at = $expiredAt;
        $ur->save();

        $message = app('wechat.work')->messenger;
        if ($expiredAt != null) {
            $message->message("管理员临时给您增加了 {$role->app->name} 的 {$role->name} 权限，$expiredAt 权限自动过期");
        } else {
            $message->message("管理员给您增加了 {$role->app->name} 的 {$role->name} 权限");
        }
        $message->ofAgent(config('wechat.work.default.agent_id'));
        $message->toUser($user->username);
        $message->send();

        $this->success('已成功添加');
        return redirect('/roles/users?role_id=' . $role->id);
    }

    public function delUser(Request $request)
    {
        $role = Role::find($request->input('role_id'));
        if (!$role->allow($request->user())) {
            $this->error('你没有编辑该角色的权限');
            return redirect('/roles/users?role_id=' . $role->id);
        }

        $ur = UserRole::find($request->input('id'));

        if ($ur) {
            $ur->delete();
            $this->success('已移除');

            $message = app('wechat.work')->messenger;
            $message->message("管理员已将您的 {$role->app->name} 的 {$role->name} 权限移除");
            $message->ofAgent(config('wechat.work.default.agent_id'));
            $message->toUser($ur->user->username);
            $message->send();

            return redirect('/roles/users?role_id=' . $ur->role_id);
        }

        $this->error('参数错误，请联系管理员');
        return redirect('/roles/users');
    }

}
