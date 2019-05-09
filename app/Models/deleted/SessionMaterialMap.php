<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionMaterialMap extends Model {

    public function material() {
        return $this->hasOne('App\Models\Material', 'id', 'material_id');
    }

}
