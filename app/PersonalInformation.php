<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    protected $table = 'personal_information';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['full_name', 'has_disability', 'has_criminal_record'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        $others = $this->other_names ?: '';
        return "{$this->first_name} {$this->middle_name} {$others}";
    }

    public function getOtherNamesAttribute($value)
    {
        return $value ?: '';
    }

    public function getHasDisabilityAttribute()
    {
        return $this->attributes['disability'] || false;
    }

    public function getDisabilityAttribute($value)
    {
        return $value ?: 'No disability.';
    }

    public function getHasCriminalRecordAttribute()
    {
        return $this->attributes['criminal_record'] || false;
    }

    public function getCriminalRecordAttribute($value)
    {
        return $value ?: 'No criminal record.';
    }
}
