<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('medical_services', function (Blueprint $table) {
        $table->decimal('insurance_price', 10, 2)->nullable()->change();
    });
}

public function down()
{
    Schema::table('medical_services', function (Blueprint $table) {
        $table->decimal('insurance_price', 10, 2)->default(0)->change(); // hoặc NOT NULL tuỳ cấu trúc cũ
    });
}

};
