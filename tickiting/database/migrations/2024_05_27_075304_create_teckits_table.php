<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teckits', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('solution')->nullable();
            $table->string('rejectReason')->nullable();
            $table->string('status')->default('pinding');
            $table->date('current_date')->default(DB::raw('CURRENT_DATE'));
            $table->time('current_time')->default(DB::raw('CURRENT_TIME'));
            $table->unsignedBigInteger('user_id')->nullable(); //nullable for allowing guests to subscribe
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');
                
            $table->string('tecknetion_id')->nullable();


            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teckits', function (Blueprint $table) {
            $table->dropColumn('type_ids');
        });    }
};
