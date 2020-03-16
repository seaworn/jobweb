<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function applicants()
    {
        return $this->hasMany(User::class, 'applications');
    }

    public function jobFunction()
    {
        return $this->belongsTo(JobFunction::class);
    }

    public function contractType()
    {
        return $this->belongsTo(ContractType::class);
    }
}
