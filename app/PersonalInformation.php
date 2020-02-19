<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    protected $table = 'personal_information';
    
    public function user() {
        return $this->belongsTo(User::class);
    }
}
