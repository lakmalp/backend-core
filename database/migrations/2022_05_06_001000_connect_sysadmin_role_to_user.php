<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Premialabs\Foundation\Role\gen\Role;
use Premialabs\Foundation\UserRole\gen\UserRole;
use App\Models\User;

class ConnectSysadminRoleToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sys_admin_user = User::where('email', 'sys@premialabs.com')->first();

        $sys_admin_role = Role::where('code', 'SYS_ADMIN')->first();

        UserRole::insert([
            'user_id' => $sys_admin_user->id,
            'role_id' => $sys_admin_role->id
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
