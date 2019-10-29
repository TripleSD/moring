<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ChecksSites
 *
 * @property int $id
 * @property string $url Контролируемый ULR
 * @property string|null $php_version Версия PHP на сайте
 * @property string|null $control_file Контрльный JSON файл
 * @property int|null $http_code HTTP статус сайта 302/404/
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChecksSites newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChecksSites newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChecksSites query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChecksSites whereControlFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChecksSites whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChecksSites whereHttpCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChecksSites whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChecksSites wherePhpVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChecksSites whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ChecksSites whereUrl($value)
 * @mixin \Eloquent
 */
class Sites extends Model
{
    //
}
