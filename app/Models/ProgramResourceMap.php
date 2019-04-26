<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramResourceMap extends Model {

    public function resource() {
        return $this->hasOne('App\Models\Resource','id','resource_id');
    }

}
