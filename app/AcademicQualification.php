<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicQualification extends Model
{
    protected $table = 'academic_qualifications';

    protected $guarded = ['id', 'created_at', 'updated_at'];
    
    public function profile() {
        return $this->belongsTo(Profile::class);
    }
}
