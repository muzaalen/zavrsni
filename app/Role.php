<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //relacija jedne role na više usera
    public function users() {
        return $this->belongsToMany('App\User');
}
}
