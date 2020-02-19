<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function personal_information() {
        return $this->hasOne(PersonalInformation::class);
    }

    public function academic_qualifications() {
        return $this->hasMany(AcademicQualification::class);
    }

    public function professional_certifications() {
        return $this->hasMany(ProfessionalCertification::class);
    }

    public function professional_memberships() {
        return $this->hasMany(ProfessionalMembership::class);
    }

    public function skills() {
        return $this->belongsToMany(Skill::class);
    }

    public function work_experience() {
        return $this->hasMany(WorkExperience::class);
    }

    public function contact_persons() {
        return $this->hasMany(ContactPerson::class);
    }

    public function referees() {
        return $this->hasMany(Referee::class);
    }
}
