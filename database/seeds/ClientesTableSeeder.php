<?php

use Illuminate\Database\Seeder;

class ClientesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            'nome' => 'André',
            'cpf' => 56237845126
        ]);
        DB::table('clientes')->insert([
            'nome' => 'Clauber',
            'cpf' => 69836579523
        ]);
        DB::table('clientes')->insert([
            'nome' => 'Claudete',
            'cpf' => 10236008756
        ]);
        DB::table('clientes')->insert([
            'nome' => 'Naomi',
            'cpf' => 51023069845
        ]);
    }
}
