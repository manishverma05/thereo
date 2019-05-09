<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model {

    /**
     * Get the cover media record associated with the session.
     */
    public function cover_media() {
        return $this->hasOne('App\Models\SessionMediaMap')->where('type', 'cover');
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
    public function material() {
        return $this->hasOne('App\Models\SessionMediaMap')->where('type', 'material');
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
     * Get the access record associated with the session.
     */
    public function access() {
        return $this->hasMany('App\Models\SessionAccessMap');
    }

    /**
     * Get the attachment record associated with the session.
     */
    public function video() {
        return $this->hasOne('App\Models\SessionMediaMap')->where('type', 'video');
    }

}
