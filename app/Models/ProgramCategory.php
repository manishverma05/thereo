<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramCategory extends Model {
    
    public function creator() {
        return $this->hasOne('App\user', 'id', 'created_by');
    }

}
