<?php
/**
 * @version $Revision$
 * @author $Author$
 * @since $Date$
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlunosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('alunos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nome_completo', 255);
            $table->string('matricula', 255);
            $table->string('email', 255);
            $table->date('data_nacimento');
            $table->integer('sexo')->nullable();
            $table->string('cpf', 45);
            $table->string('telefone', 45)->nullable();
            $table->string('celular', 45)->nullable();
            $table->integer('grau_instrucao')->nullable();
            $table->string('cep', 45)->nullable();
            $table->integer('turmas_id')->unsigned();
            $table->string('logradouro', 255)->nullable();
            $table->integer('numero')->nullable();
            $table->string('complemento', 255)->nullable();
            $table->string('bairro', 100)->nullable();
            $table->string('cidade', 100)->nullable();
            $table->string('estado', 2)->nullable();
                        
            $table->index('turmas_id');
            $table->foreign('turmas_id')
                ->references('id')->on('turmas');
            
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('alunos');
    }

}
