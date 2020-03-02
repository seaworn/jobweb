<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    protected $table = 'work_experience';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
