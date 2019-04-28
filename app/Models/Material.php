<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model {

    /**
     * Get the cover media record associated with the session.
     */
    public function cover_media() {
        return $this->hasOne('App\Models\MaterialCoverMedia');
    }

    /**
     * Get the attachment record associated with the session.
     */
    public function attachment() {
        return $this->hasOne('App\Models\MaterialAttachment');
    }

    public function creator() {
        return $this->hasOne('App\user', 'id', 'created_by');
    }

}
