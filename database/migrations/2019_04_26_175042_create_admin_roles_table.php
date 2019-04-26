<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\Models\Admin\AdminRole::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->default('')->comment('角色名称');
            $table->string('description', 100)->default('')->comment('角色名称');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
        DB::statement("ALTER TABLE ".\App\Models\Admin\AdminRole::GetDBPrefix().\App\Models\Admin\AdminRole::TABLE." comment '角色表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\Models\Admin\AdminRole::TABLE);
    }
}
