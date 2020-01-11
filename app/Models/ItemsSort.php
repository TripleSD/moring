<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemsSort extends Model
{
    protected $table = "items_sorts";

    protected $fillable = ['user_id', 'item_name', 'position'];
}
