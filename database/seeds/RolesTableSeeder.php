<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Bouncer configuration
    	// Bouncer::allow('role')->to('ability');
        
        Bouncer::allow('super')->to('super_all');
        Bouncer::allow('admin')->to('admin_all');
        Bouncer::allow('supervisor')->to('supervisor_all');
        Bouncer::allow('mobile')->to('mobile_all');
    }
}
