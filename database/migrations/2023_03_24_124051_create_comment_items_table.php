<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comment_id')->constrained('comments');
            $table->foreignId('question_id')->constrained('questions');
            $table->foreignId('answer_id')->constrained('answers');
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
        Schema::dropIfExists('comment_items');
    }
}
