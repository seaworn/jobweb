<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referee extends Model
{
    protected $table = 'referees';
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
