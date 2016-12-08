<?php

namespace App\Models\Sql;

use Illuminate\Database\Eloquent\Model;

class UserJson extends Model
{
    protected $table = "user_json";
    protected $fillable = ['user_id', 'json'];
}
