<?php

use Illuminate\Database\Seeder;

class GenGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gen_groups')->insert([
        	['id'=>1,'group_cod'=>'sex','group_description'=>'Sexo','enabled'=>1],
			['id'=>2,'group_cod'=>'cap','group_description'=>'Capacidades','enabled'=>1],
        ]);
    }
}
