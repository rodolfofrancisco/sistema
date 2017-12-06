<?php
/**
 * @version $Revision$
 * @author $Author$
 * @since $Date$
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateRespostasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('respostas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('descricao', 255);
            $table->integer('pergunta_id')->unsigned();
            $table->index('pergunta_id');
            $table->foreign('pergunta_id')
                ->references('id')->on('perguntas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('respostas');
    }

}
