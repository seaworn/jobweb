<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractType extends Model
{
    protected $table = 'contract_types';
    protected $fillable = ['name'];

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
