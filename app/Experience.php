<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'work_experience';
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
