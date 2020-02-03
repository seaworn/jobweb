<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $table = 'professional_certifications';

    public function user() {
        return $this->belongsTo(User::class);
    }
}
