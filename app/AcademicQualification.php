<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicQualification extends Model
{
    protected $table = 'academic_qualifications';
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
