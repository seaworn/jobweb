<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\{Role, Permission};

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, HasRoles;

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

    protected $appends = ['can', 'givenRole'];

    public function personalInformation() {
        return $this->hasOne(PersonalInformation::class);
    }
    
    public function academicQualifications() {
        return $this->hasMany(AcademicQualification::class);
    }
    
    public function professionalCertifications() {
        return $this->hasMany(ProfessionalCertification::class);
    }
    
    public function professionalMemberships() {
        return $this->hasMany(ProfessionalMembership::class);
    }
    
    public function skills() {
        return $this->belongsToMany(Skill::class, 'user_has_skills');
    }
    
    public function workExperience() {
        return $this->hasMany(WorkExperience::class);
    }
    
    public function contactPerson() {
        return $this->hasOne(ContactPerson::class);
    }
    
    public function referees() {
        return $this->hasMany(Referee::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
    
    public function getCanAttribute()
    {
        $permissions = [];
        foreach (Permission::get() as $permission) {
            $permissions[$permission->name] = $this->hasPermissionTo($permission);
        }
        return $permissions;
    }

    public function getGivenRoleAttribute()
    {
        $roles = [];
        foreach (Role::get() as $role) {
            $roles[$role->name] = $this->hasRole($role);
        }
        return $roles;
    }

    public function applications()
    {
        return $this->belongsToMany(Job::class, 'applications');
    }
}
