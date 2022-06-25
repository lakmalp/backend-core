<?php

namespace Premialabs\Seeders;

use Premialabs\Foundation\SystemParameter;
use Illuminate\Database\Seeder;

class SystemParametersSeeder extends Seeder
{
    private function _addSystemParameters()
    {
        SystemParameter::upsert(
            [
                [
                    '_seq' => 100000,
                    'param_type' => 'SYS',
                    'code' => 'ENABLE_CLIENT_LOGIN',
                    'description' => 'Enables logging requests from client',
                    'value_type' => 'boolean'
                ],
                [
                    '_seq' => 100100,
                    'param_type' => 'SYS',
                    'code' => 'ENABLE_BACKEND_LOGIN',
                    'description' => 'Enables logging requests to external APIs from server',
                    'value_type' => 'boolean'
                ],
                [
                    '_seq' => 100200,
                    'param_type' => 'USER',
                    'code' => 'DUMMY_DATE_OF_START',
                    'description' => 'Date type value',
                    'value_type' => 'date'
                ],
                [
                    '_seq' => 100300,
                    'param_type' => 'USER',
                    'code' => 'DUMMY_TEXT',
                    'description' => 'Text type value',
                    'value_type' => 'text'
                ],
                [
                    '_seq' => 100400,
                    'param_type' => 'SYS',
                    'code' => 'ENABLE_USER_LOGIN',
                    'description' => 'Enables logging of user sign-in and sign-out information',
                    'value_type' => 'boolean'
                ],
                [
                    '_seq' => 100500,
                    'param_type' => 'SYS',
                    'code' => 'ENABLE_USER_ACTIVE_LOGGING',
                    'description' => 'Enables logging of user active status',
                    'value_type' => 'boolean'
                ],
                [
                    '_seq' => 100600,
                    'param_type' => 'SYS',
                    'code' => 'ENABLE_MODEL_AUDITING',
                    'description' => 'Enables model auditing. Models to be audited can be selected in Settings > Models to Audit window.',
                    'value_type' => 'boolean'
                ]
            ],
            ['code'],
            ['description']
        );
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->_addSystemParameters();
    }
}
