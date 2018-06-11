<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\AccessToken
 *
 * @property int $id
 * @property int $app_id
 * @property string $access_token
 * @property string $expired_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccessToken whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccessToken whereAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccessToken whereExpireAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccessToken whereId($value)
 * @mixin \Eloquent
 * @property int $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccessToken valid()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccessToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccessToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AccessToken whereUserId($value)
 */
class AccessToken extends Model
{

    protected $hidden = ['id', 'app_id', 'updated_at', 'created_at'];

    /**
     * @param $query AccessToken
     * @return mixed
     */
    public function scopeValid($query)
    {
        $query->where('expired_at', '>', time());
        return $query;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
