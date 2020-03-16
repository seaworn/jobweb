<?php

use Illuminate\Database\Seeder;
use App\AcademicLevel;

class AcademicLevelsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    foreach ([
      'High School',
      'Certificate',
      'Diploma',
      'Bachelors',
      'Masters',
      'Doctorate'
    ] as $level) {
      AcademicLevel::updateOrCreate(['name' => $level,]);
    }
  }
}
