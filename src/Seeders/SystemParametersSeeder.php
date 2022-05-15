<?php

namespace Premialabs\Seeders;

use Premialabs\Foundation\SystemParameter;
use Illuminate\Database\Seeder;

class SystemParametersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SystemParameter::upsert([
            [
                'param_type' => 'SYS',
                'code' => 'ENABLE_CLIENT_LOGIN',
                'description' => 'Enables logging requests from client',
                'value_type' => 'boolean'
            ], [
                'param_type' => 'SYS',
                'code' => 'ENABLE_BACKEND_LOGIN',
                'description' => 'Enables logging requests to external APIs from server',
                'value_type' => 'boolean'
            ], [
                'param_type' => 'USER',
                'code' => 'DUMMY_DATE_OF_START',
                'description' => 'Date type value',
                'value_type' => 'date'
            ], [
                'param_type' => 'USER',
                'code' => 'DUMMY_TEXT',
                'description' => 'Text type value',
                'value_type' => 'text'
            ], [
                'param_type' => 'SYS',
                'code' => 'ENABLE_USER_LOGIN',
                'description' => 'Enables logging of user sign-in and sign-out information',
                'value_type' => 'boolean'
            ], [
                'param_type' => 'SYS',
                'code' => 'ENABLE_USER_ACTIVE_LOGGING',
                'description' => 'Enables logging of user active status',
                'value_type' => 'boolean'
            ], [
                'param_type' => 'SYS',
                'code' => 'ENABLE_MODEL_AUDITING',
                'description' => 'Enables model auditing. Models to be audited can be selected in Settings > Models to Audit window.',
                'value_type' => 'boolean'
            ]
        ], ['code'], ['description']);
    }
}
