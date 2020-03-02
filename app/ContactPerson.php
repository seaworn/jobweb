<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    protected $table = 'contact_persons';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['full_name'];
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        $others = $this->other_names ?: '';
        return "{$this->first_name} {$this->middle_name} {$others}";
    }
}
