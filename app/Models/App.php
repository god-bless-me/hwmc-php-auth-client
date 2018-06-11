<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\App
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $secret
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereSecret($value)
 * @property string $redirect_host
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\App whereRedirectHost($value)
 */
class App extends Model
{
    protected $fillable = ['name', 'redirect_host'];

    public function validate($uri)
    {
        $uri = ltrim($uri,"http://");
        $uri = ltrim($uri,"https://");
        $res = Str::startsWith($uri, $this->redirect_host);

        //非正式环境不验证回调地址
        if (!$res && env('APP_ENV') != 'production') {
            return true;
        }
        return $res;
    }

}
