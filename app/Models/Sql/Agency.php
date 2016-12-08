<?php

namespace App\Models\Sql;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    protected $table = 'agencies';
    protected $fillable = ['agency', 'user_id'];
}
