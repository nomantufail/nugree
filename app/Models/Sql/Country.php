<?php

namespace App\Models\Sql;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $table = "countries";

    public function user()
    {
        return $this->belongsTo('App\Models\Sql\User');
    }

}
