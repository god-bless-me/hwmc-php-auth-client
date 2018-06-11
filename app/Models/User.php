<?php

namespace App\Models;

use Log;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Cookie;


/**
 * App\Models\User
 *
 * @property int $id
 * @property string $username
 * @property string $name
 * @property string $avatar
 * @property string $mobile
 * @property string $email
 * @property int $gender
 * @property int $enable
 * @property int $hide_mobile
 * @property int|null $isleader
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AccessToken[] $accessTokens
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserRole[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User enable()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereHideMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIsleader($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUsername($value)
 * @mixin \Eloquent
 */
class User extends Model
{

    const CookieName = 'u';
    const CacheKeyCode = 'auth_code:';

    protected $hidden = ['enable', 'isleader', 'hide_mobile', 'created_at', 'updated_at'];

    /**
     * 根据 App 和 code 找出用户
     * @param App $app
     * @return null|User
     */
    static public function GetUserWithCode($app, $code)
    {
        /**
         * @var $cache \Cache
         */
        $cache = app('cache');

        $data = $cache->pull(self::CacheKeyCode . $code);
        if ($data) {
            $data = explode("\t", $data);
            if ($data[0] != $app->id) {

                app(LoggerInterface::class)->debug('api-auth-code-appid', [
                    'store' => $data[0],
                    'param' => $app->id
                ]);

                return null;
            }

            $user = User::with('roles')->find($data[1]);
            return $user;
        }

        app(LoggerInterface::class)->debug('api-auth-code', [
            'code' => $code,
            'data' => $data,
        ]);

        return null;
    }

    /**
     * 生成oauth的临时code，有效期十分钟
     * @param App $app
     * @return string
     */
    public function code($app)
    {
        $retry = 10;

        /**
         * @var $cache \Cache
         */
        $cache = app('cache');

        $code = '';
        while ($retry--) {
            $code = Str::random(32);
            if (!$cache->has(self::CacheKeyCode . $code)) {
                $cache->put(self::CacheKeyCode . $code, $app->id . "\t" . $this->id, 10);
                break;
            }
        }
        return $code;
    }

    /**
     * 生成新 Access Token
     * @param $app
     * @return AccessToken
     */
    public function newAccessToken($app)
    {
        $token = new AccessToken();
        $token->app_id = $app->id;
        $token->user_id = $this->id;
        $token->access_token = Str::random(32);
        $token->expired_at = date('Y-m-d H:i:s', time() + 86400);
        $token->save();
        return $token;
    }

    public function toCookie()
    {
        $val = encrypt($this->id . "\t" . $this->user_id);
        //todo cookie的过期时间
//        $expireAt = time() + 86400 * 30;
        return new Cookie(self::CookieName, $val);
    }

    public function appRoles($appId)
    {
        $roles = $this->roles()->whereAppId($appId)->valid()->get();
        $data = [];
        foreach ($roles as $role) {
            $data[] = $role->role->key;
        }
        return $data;
    }

    /**
     * @param User $query
     * @return mixed
     */
    public function scopeEnable($query)
    {
        $query->whereEnable(1);
        return $query;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Builder|UserRole
     */
    public function roles()
    {
        return $this->hasMany(UserRole::class)->with('role');
    }

    public function accessTokens()
    {
        return $this->hasMany(AccessToken::class);
    }

}
