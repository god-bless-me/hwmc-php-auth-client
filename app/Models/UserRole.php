<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserRole
 *
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 * @property-read \App\Models\Role $role
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole appId()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole whereUserId($value)
 * @mixin \Eloquent
 * @property int $app_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole authApp()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole whereAppId($value)
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole auth()
 * @property string|null $expired_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole valid()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserRole whereUpdatedAt($value)
 */
class UserRole extends Model
{

    /**
     * @param $query UserRole
     * @return mixed
     */
    public function scopeAuth($query)
    {
        $query->whereAppId('100000');
        return $query;
    }

    /**
     * 未过期，有效的角色
     * @param $query UserRole
     * @return mixed
     */
    public function scopeValid($query){
        $query->where('expired_at','>',time())
        ->orWhereNull('expired_at');
        return $query;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
