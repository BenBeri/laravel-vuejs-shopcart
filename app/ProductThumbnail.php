<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ProductThumbnail extends Model
{
    protected $primaryKey = 'id';

    public function product() {
        return $this->belongsTo("App\\Product");
    }
}
