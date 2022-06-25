<?php

namespace Premialabs\Seeders;

use Premialabs\Foundation\SystemParameter;
use Illuminate\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AddPermissionsToSysAdminRoleSeeder::class,
            SystemParametersSeeder::class,
        ]);
    }
}
