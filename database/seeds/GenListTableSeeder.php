<?php

use Illuminate\Database\Seeder;

class GenListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gen_lists')->insert([
        	['id'=>1,'group_id'=>1,'item_id'=>1,'item_description'=>'Masculino','item_cod'=>'M','enabled'=>1],
            ['id'=>2,'group_id'=>1,'item_id'=>2,'item_description'=>'Femenino','item_cod'=>'F','enabled'=>1],
            ['id'=>3,'group_id'=>2,'item_id'=>1,'item_description'=>'report','item_cod'=>'','enabled'=>1],
            ['id'=>4,'group_id'=>2,'item_id'=>2,'item_description'=>'meeting','item_cod'=>'','enabled'=>1],
            ['id'=>5,'group_id'=>2,'item_id'=>3,'item_description'=>'assistant','item_cod'=>'','enabled'=>1],
        ]);
    }
}
