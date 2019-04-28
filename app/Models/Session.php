<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model {

    /**
     * Get the cover media record associated with the session.
     */
    public function cover_media() {
        return $this->hasOne('App\Models\SessionCoverMedia');
    }

    /**
     * Get the program record associated with the session.
     */
    public function program() {
        return $this->hasOne('App\Models\ProgramSessionMap');
    }

    /**
     * Get the sessions record associated with the session.
     */
    public function materials() {
        return $this->hasMany('App\Models\SessionMaterialMap');
    }

    /**
     * Get the resources record associated with the session.
     */
    public function resources() {
        return $this->hasMany('App\Models\SessionResourceMap');
    }

    /**
     * Get the authors record associated with the session.
     */
    public function authors() {
        return $this->hasMany('App\Models\SessionAuthorMap');
    }

    /**
     * Get the session categories associated with the session.
     */
    public function session_categories() {
        return $this->hasMany('App\Models\SessionCategoryMap');
    }

    
    /**
     * Get the accesss record associated with the session.
     */
    public function accesss() {
        return $this->hasMany('App\Models\SessionAccessMap');
    }

    
    /**
     * Get the attachment record associated with the session.
     */
    public function attachment() {
        return $this->hasOne('App\Models\SessionAttachment');
    }

}
