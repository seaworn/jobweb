<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobFunction extends Model
{
    protected $table = 'job_functions';
    protected $fillable = ['name'];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
