<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
 * @property string|null $moring_file Контрльный Moring файл
 * @property string|null $moring_version Версия Moring файла
 * @property string|null $moring_timestamp Время на сервере где расположен сайт
 * @property string|null $server_info Информация о веб сервере
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sites whereMoringFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sites whereMoringTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sites whereMoringVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sites whereServerInfo($value)
 */
class Sites extends Model
{
    protected $fillable = ['name', 'url', 'active', 'comment', 'file_url', 'https'];

    use SoftDeletes;

    public function checksList(){
        return $this->hasOne(SitesChecksList::class, 'site_id');
    }

    public function getPhpVersion()
    {
        return $this->hasOne(SitesPhpVersions::class,'site_id');
    }

    public function getHttpCode()
    {
        return $this->hasOne(SitesHttpCodes::class,'site_id');
    }
}
