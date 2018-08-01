<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Product extends Model
{

    protected $primaryKey = 'id';

    public function thumbnails() {
        return $this->hasOne("App\\ProductThumbnail");
    }
}
