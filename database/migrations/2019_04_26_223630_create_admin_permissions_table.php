<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\Models\Admin\Permission\AdminPermission::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->default('')->comment('权限名称');
            $table->string('description', 100)->default('')->comment('描述');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
        DB::statement("ALTER TABLE ".\App\Models\Admin\Permission\AdminPermission::GetDBPrefix().\App\Models\Admin\Permission\AdminPermission::TABLE." comment '权限表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\Models\Admin\Permission\AdminPermission::TABLE);
    }
}
