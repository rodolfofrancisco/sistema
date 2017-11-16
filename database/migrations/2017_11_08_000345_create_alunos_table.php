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
            /*
             
             
            nome_completo varchar 255
            matricula varchar 255
            email varchar 255
            data_nacimento date
            cpf varchar 45
            telefone varchar 45
            celular varchar 45
            grau_instrucao int
            cep varchar 45
            logradouro varchar 255
            numero varchar 45
            complemento varchar 255
            bairro varchar 100
            cidade varchar 100
            estado varchar 2
            turmas_id int
            
            

*/
            $table->timestamps();
        });
    }

//    <option value="10">Sem escolaridade</option>
//    <option value="20">Ensino Fundamental 1 - 1ª a 5ª (incompleto)</option>
//    <option value="30">Ensino Fundamental 1 - 1ª a 5ª (completo)</option>
//    <option value="40">Ensino Fundamental 2 - 6ª a 9ª (incompleto)</option>
//    <option value="50">Ensino Fundamental 2 - 6ª a 9ª (completo)</option>
//    <option value="60">Ensino Médio - 1ª a 3ª ano do 2º grau (incompleto)</option>
//    <option value="70">Ensino Médio - 1ª a 3ª ano do 2º grau (completo)</option>
//    <option value="80">Nível técnico/Tecnológo (incompleto)</option>
//    <option value="90">Nível técnico/Tecnólogo (completo)</option>
//    <option value="100">Superior (incompleto)</option>
//    <option value="110">Superior (completo)</option>
//    <option value="120">Pós-graduação (Mestrado/Doutorado/Especialização) (incompleto)</option>
//    <option value="130">Pós-graduação (Mestrado/Doutorado/Especialização) (completo)</option>
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('alunos');
    }

}
