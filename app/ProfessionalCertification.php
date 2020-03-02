<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfessionalCertification extends Model
{
    protected $table = 'professional_certifications';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getExpiryAttribute($value)
    {
        return $value ?: 'Does not expire';
    }
}
