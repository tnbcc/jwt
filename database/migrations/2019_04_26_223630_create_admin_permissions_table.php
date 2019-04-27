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
            $table->string('route',255)->nullable()->comment('权限路由');
            $table->tinyInteger('parent_id')->default(0)->unsigned()->index()->comment('上级权限');
            $table->string('description', 100)->default('')->comment('描述');
            $table->tinyInteger('sort')->default(255)->unsigned()->comment('排序');
            $table->string('fonts',128)->nullable()->comment('菜单fonts图标');
            $table->boolean('is_hidden')->default(false)->comment('是否隐藏 true-隐藏 false-不隐藏');
            $table->boolean('status')->default(true)->comment('状态 true-正常 false-禁止');
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
