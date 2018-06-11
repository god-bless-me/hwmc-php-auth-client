<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Group
 *
 * @property int $id
 * @property string $app
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereApp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereName($value)
 * @mixin \Eloquent
 * @property string $app_id
 * @property string $key
 * @property string $desc
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereKey($value)
 * @property string $role
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereRole($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserRole[] $users
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereUpdatedAt($value)
 */
class Role extends Model
{

    /**
     * 权限验证，检测用户是否有编辑该角色的权限
     * @param User $user
     * @return bool
     */
    public function allow(User $user)
    {
        return true;
    }

    public function app()
    {
        return $this->belongsTo(App::class);
    }

    public function users()
    {
        return $this->hasMany(UserRole::class);
    }

}
