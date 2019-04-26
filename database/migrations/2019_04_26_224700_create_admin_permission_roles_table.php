<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminPermissionRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\Models\Admin\Permission\AdminPermissionRole::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('permission_id');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
        DB::statement("ALTER TABLE ".\App\Models\Admin\Permission\AdminPermissionRole::GetDBPrefix().\App\Models\Admin\Permission\AdminPermissionRole::TABLE." comment '权限角色表'");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\Models\Admin\Permission\AdminPermissionRole::TABLE);
    }
}
