<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramSessionMap extends Model {

    public function program() {
        return $this->hasOne('App\Models\Program', 'id', 'program_id');
    }

    public function session() {
        return $this->hasOne('App\Models\Session', 'id', 'session_id');
    }

}
