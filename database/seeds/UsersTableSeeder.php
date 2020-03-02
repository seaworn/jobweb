<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 3)->create()->each(function ($user) {
            $role = Role::inRandomOrder()->first();
            $user->roles()->attach($role);
        });
        // ->each(function ($user)
        // {
        //     $user->personalInformation()->save(factory(App\PersonalInformation::class)->make());
        //     $user->contactPersons()->save(factory(App\ContactPerson::class, 2)->make());
        //     $user->academicQualifications()->save(factory(App\AcademicQualification::class, 3)->make());
        //     $user->professionalCertifications()->save(factory(App\ProfessionalCertification::class, 2)->make());
        //     $user->professionalMemberships()->save(factory(App\ProfessionalMembership::class)->make());
        //     $user->skills()->save(factory(App\Skill::class, 6)->make());
        //     $user->referees()->save(factory(App\Referee::class, 3)->make());
        // });
    }
}
