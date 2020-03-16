<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfessionalCertification extends Model
{
    protected $table = 'professional_certifications';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function profile() {
        return $this->belongsTo(Profile::class);
    }

    public function getExpiryAttribute($value)
    {
        return $value ?: 'Does not expire';
    }
}
