<?php
/**
 * @version $Revision$
 * @author $Author$
 * @since $Date$
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateQuestionariosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('questionarios', function(Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('questionarios');
    }

}
