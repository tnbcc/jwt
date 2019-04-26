<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRoleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\Models\Admin\Permission\AdminRoleUser::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('admin_id');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE ".\App\Models\Admin\Permission\AdminRoleUser::GetDBPrefix().\App\Models\Admin\Permission\AdminRoleUser::TABLE." comment '用户角色表'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\Models\Admin\Permission\AdminRoleUser::TABLE);
    }
}
