<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramMediaMap extends Model {

    public function media() {
        return $this->hasOne('App\Models\Media', 'id', 'media_id');
    }

}
