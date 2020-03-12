<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobposts extends Model
{
    protected $table ='jobposts';
    protected $fillables=[
        'jobtitle',
        'refno',
        'joblocation',
        'jobdescription',
        'experiencelevel',
        'skillrequired',
        'duties',
        'salaryrange',
        'numberofposts',
        'deadline'

    ];
}
