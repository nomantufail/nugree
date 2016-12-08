<?php

namespace App\Models\Sql;

use App\Libs\Json\Prototypes\Prototypes\User\UserJsonPrototype;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    protected $table = "user_json";
    protected $fillable = ['user_id', 'json'];

    public function decode()
    {
        return (new UserJsonPrototype())->map($this->getJsonObject());
    }

    public function getJson()
    {
        return $this->json;
    }

    public function getJsonObject()
    {
        return json_decode($this->getJson());
    }

    /**
     * relationships...
     */
    public function user()
    {
        return $this->belongsTo('App\Models\Sql\User');
    }
}
