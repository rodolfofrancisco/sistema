<?php
/**
 * @version $Revision$
 * @author $Author$
 * @since $Date$
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreatePerguntasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('perguntas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('descricao', 255);
            $table->integer('tipo')->unsigned();
            $table->integer('questionario_id')->unsigned();
            $table->index('questionario_id');
            $table->foreign('questionario_id')
                ->references('id')->on('questionarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('perguntas');
    }

}