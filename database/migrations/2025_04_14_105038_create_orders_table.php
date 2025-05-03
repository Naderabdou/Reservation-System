<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['pending','completed', 'canceled'])->default('pending');
            $table->enum('canceled_type', ['user', 'admin'])->nullable();
            $table->string('order_number')->unique();
            $table->foreignId('service_id')->nullable()->references('id')->on('services')->nullOnDelete();
            $table->string('service_name')->nullable();
            $table->decimal('service_price', 10, 2);
            //reservation_date
            $table->timestamp('reservation_date')->nullable();



            $table->foreignId('user_id')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->string('name');
            $table->string('email');
            $table->string('phone');

            $table->timestamps();



        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
