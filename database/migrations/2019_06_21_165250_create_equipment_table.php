<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('equipment_id')->comment('设备id');
            $table->string('asset_number')->comment('资产编号');
            $table->string('equipment_name')->comment('设备名称');
            $table->enum('equipment_type',['特种设备','普通设备'])->comment('设备类型');

            $table->bigInteger('laboratory_id')->unsigned()->comment('实验室id');
            $table->foreign('laboratory_id')->references('id')->on('laboratories');

            $table->bigInteger('build_id')->unsigned()->comment('设备创建人');
            $table->foreign('build_id')->references('id')->on('users');

            //单位id根据创建人的users表中的信息来获取
            $table->integer('unit_id')->comment('所属单位id');
            $table->enum('status',['正常','维修','报废'])->nullable()->comment('状态');

            $table->date('fix_time')->nullable()->comment('最近检修时间');
            $table->date('storage_time')->comment('入库时间');
            $table->date('scrap_time')->comment('预计报废时间');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment');
    }
}