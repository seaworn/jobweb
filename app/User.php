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

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function getPersonalInformationAttribute() {
        return $this->profile;
    }
    
    public function academicQualifications() {
        return $this->hasManyThrough(AcademicQualification::class, Profile::class);
    }
    
    public function professionalCertifications() {
        return $this->hasManyThrough(ProfessionalCertification::class, Profile::class);
    }
    
    public function professionalMemberships() {
        return $this->hasManyThrough(ProfessionalMembership::class, Profile::class);
    }
    
    public function getSkillsAttribute() {
        // return $this->hasManyThrough(Skill::class, Profile::class);
        return $this->profile ? $this->profile->skills: null;
    }
    
    public function workExperience() {
        return $this->hasManyThrough(WorkExperience::class, Profile::class);
    }
    
    public function contactPerson() {
        return $this->hasOneThrough(ContactPerson::class, Profile::class);
    }
    
    public function referees() {
        return $this->hasManyThrough(Referee::class, Profile::class);
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
        return $this->hasMany(Job::class, 'applications');
    }
}
