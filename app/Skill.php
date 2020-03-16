<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function profile() {
        return $this->belongsToMany(Profile::class, 'user_has_skills');
    }
}
