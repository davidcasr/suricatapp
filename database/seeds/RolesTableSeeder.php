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
        Bouncer::allow('super')->to('account');
        
        Bouncer::allow('admin')->to('dashboard');
        Bouncer::allow('admin')->to('communities');
        Bouncer::allow('admin')->to('people');
        Bouncer::allow('admin')->to('groups');
        Bouncer::allow('admin')->to('features');
        Bouncer::allow('admin')->to('profiles');
        Bouncer::allow('admin')->to('meetings');
        Bouncer::allow('admin')->to('meeting_reports');
        Bouncer::allow('admin')->to('assistants');
        Bouncer::allow('admin')->to('account');
        Bouncer::allow('admin')->to('associated_users');
        Bouncer::allow('admin')->to('guests');
        Bouncer::allow('admin')->to('notifications');

        Bouncer::allow('supervisor')->to('dashboard');
        Bouncer::allow('supervisor')->to('communities');
        Bouncer::allow('supervisor')->to('people');
        Bouncer::allow('supervisor')->to('groups');
        Bouncer::allow('supervisor')->to('features');
        Bouncer::allow('supervisor')->to('profiles');
        Bouncer::allow('supervisor')->to('meetings');
        Bouncer::allow('supervisor')->to('meeting_reports');
        Bouncer::allow('supervisor')->to('assistants');
        Bouncer::allow('supervisor')->to('account');
        Bouncer::allow('supervisor')->to('associated_users');
        Bouncer::allow('supervisor')->to('guests');
        Bouncer::allow('supervisor')->to('notifications');

        Bouncer::allow('group_leader')->to('dashboard');
        Bouncer::allow('group_leader')->to('meetings');
        Bouncer::allow('group_leader')->to('meeting_reports');
        Bouncer::allow('group_leader')->to('account');
        Bouncer::allow('group_leader')->to('guests');
        Bouncer::allow('group_leader')->to('assistants');
        Bouncer::allow('group_leader')->to('notifications');        

        Bouncer::allow('mobile')->to('mobile_all');
    }
}
