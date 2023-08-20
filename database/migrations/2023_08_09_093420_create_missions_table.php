<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("object");
            $table->string("description");
            $table->string("place");
            $table->date('date');
            $table->date('start_date');
            $table->date('end_date');
            $table->string("companion");
            $table->decimal("budget");
            $table->enum('state', ['incomplete', 'complete', 'approved'])->default('incomplete');
            $table->string('comment')->nullable();
            $table->decimal('total_reimbursement')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('missions');
    }
};
