<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hotel_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('event_type');
            $table->text('event_info');
            $table->timestamp('datetime');
            $table->timestamps();

            $table->index('event_type');
            $table->index('datetime');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotel_events');
    }
}; 