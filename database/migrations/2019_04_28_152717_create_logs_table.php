<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(\App\Models\Admin\Log\Log::TABLE, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admin_id')->nullable()->index()->comment('管理员id');
            $table->text('data')->comment('操作内容');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
        DB::statement("ALTER TABLE ".\App\Models\Admin\Log\Log::GetDBPrefix().\App\Models\Admin\Log\Log::TABLE." comment '系统日志表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(\App\Models\Admin\Log\Log::TABLE);
    }
}
