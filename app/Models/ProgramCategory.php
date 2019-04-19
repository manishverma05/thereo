<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramCategory extends Model {

    /**
     * Get the cover media record associated with the program.
     */
    public function cover_media() {
        return $this->hasOne('App\Models\ProgramCategoryCoverMedia');
    }
    public function creator() {
        return $this->hasOne('App\user','id','created_by');
    }

}
