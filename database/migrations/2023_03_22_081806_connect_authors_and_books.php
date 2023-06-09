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
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {

            # Remove the field associated with the old way we were storing authors
            # Can do this here, or update the original migration that creates the `books` table
            # $table->dropColumn('author');

            # Add a new INT field called `author_id` that has to be unsigned (i.e. positive)
            $table->bigInteger('author_id')->unsigned();

            # This field `author_id` is a foreign key that connects to the `id` field in the `authors` table
            $table->foreign('author_id')->references('id')->on('authors');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {

            # ref: http://laravel.com/docs/migrations#dropping-indexes
            # combine tablename + fk field name + the word "foreign"
            $table->dropForeign('books_author_id_foreign');

            $table->dropColumn('author_id');
        });
    }
};
