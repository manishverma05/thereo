<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model {

    /**
     * Get the cover media record associated with the resource.
     */
    public function cover_media() {
        return $this->hasOne('App\Models\ResourceMediaMap')->where('type', 'cover');
    }

    /**
     * Get the cover media record associated with the resource.
     */
    public function media() {
        return $this->hasOne('App\Models\ResourceMediaMap')->where('type', 'media');
    }

    /**
     * Get the attachment record associated with the resource.
     */
    public function product() {
        return $this->hasOne('App\Models\ResourceMediaMap')->where('type', 'product');
    }

    /**
     * Get the attachment record associated with the resource.
     */
    public function external() {
        return $this->hasOne('App\Models\ResourceMediaMap')->where('type', 'external');
    }

    /**
     * Get the attachment record associated with the resource.
     */
    public function mediaMap() {
        return $this->hasOne('App\Models\ResourceMediaMap');
    }

    public function creator() {
        return $this->hasOne('App\user', 'id', 'created_by');
    }

}
