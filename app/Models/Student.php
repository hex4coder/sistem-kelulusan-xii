<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    protected $guarded = [];

    public function kelulusan() : HasOne {
        return $this->hasOne(Kelulusan::class);
    }
}
