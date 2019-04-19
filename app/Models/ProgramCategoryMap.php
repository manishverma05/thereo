<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramCategoryMap extends Model {

    /**
     * Get the cover media record associated with the program.
     */
    public function program() {
        return $this->hasOne('App\Models\Program','id','program_id')->with('cover_media');
    }

}
