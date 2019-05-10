<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResourceMediaMap extends Model {

    public function media() {
        return $this->hasOne('App\Models\Media', 'id', 'media_id');
    }

}
