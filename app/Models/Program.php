<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model {

    /**
     * Get the cover media record associated with the program.
     */
    public function cover_media() {
        return $this->hasOne('App\Models\ProgramMediaMap')->where('type','cover');;
    }

    /**
     * Get the sessions record associated with the program.
     */
    public function sessions() {
        return $this->hasMany('App\Models\ProgramSessionMap');
    }
    /**
     * Get the updates record associated with the program.
     */
    public function updates() {
        return $this->hasMany('App\Models\ProgramUpdate');
    }

    /**
     * Get the resources record associated with the program.
     */
    public function resources() {
        return $this->hasMany('App\Models\ProgramResourceMap');
    }

    /**
     * Get the authors record associated with the program.
     */
    public function authors() {
        return $this->hasMany('App\Models\ProgramAuthorMap');
    }

    /**
     * Get the program categories associated with the program.
     */
    public function program_categories() {
        return $this->hasMany('App\Models\ProgramCategoryMap');
    }

    /**
     * Get the access record associated with the session.
     */
    public function access() {
        return $this->hasMany('App\Models\ProgramAccessMap');
    }

    public function creator() {
        return $this->hasOne('App\user', 'id', 'created_by');
    }

}
