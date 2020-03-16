<?php

use Illuminate\Database\Seeder;
use App\ContractType;

class ContractTypesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    foreach ([
      'Permanent',
      'Contract',
      'Internship',
      'Graduate Program',
      'Industrial Attachment',
    ] as $type) {
      ContractType::updateOrCreate(['name' => $type,]);
    }
  }
}
