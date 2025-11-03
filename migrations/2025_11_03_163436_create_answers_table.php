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
        Schema::create('answers', function (Blueprint $table) {
$table->id();
$table->foreignId('response_id')->constrained()->cascadeOnDelete();
$table->foreignId('question_id')->constrained()->cascadeOnDelete();
$table->foreignId('option_id')->nullable()->constrained('options')->nullOnDelete();
$table->text('text')->nullable();
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
        Schema::dropIfExists('answers');
    }
};
