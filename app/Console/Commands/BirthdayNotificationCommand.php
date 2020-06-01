<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Person;
use App\User;
use App\Notifications\BirthdayNotification;

class BirthdayNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check birthdays on the day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $today = Carbon::now();

        $people = Person::join('community_people','community_people.person_id', '=','people.id')
            ->join('communities', 'community_people.community_id', '=', 'communities.id')
            ->join('community_users', 'community_users.community_id', '=', 'communities.id')
            ->whereNull('community_people.group_id')
            ->whereNotNull('people.birth')
            ->distinct()
            ->get();

        foreach ($people as $person){
            if($today->isSameAs('m-d',$person->birth)){
        
                $user = User::findOrfail($person->user_id);

                if(is_null($user->parent_id))
                {
                    $user_parent = User::where('id', $person->user_id);
                    $users = User::where('parent_id', $person->user_id)->union($user_parent)->get();
                }else{
                    $user_parent = User::where('id', $user->parent_id);
                    $users = User::where('parent_id', $user->parent_id)->union($user_parent)->get();
                }

                foreach ($users as $us){
                    $user = User::findOrfail($us->id);
                    $user->notify(new BirthdayNotification($person));
                }                    
                
            }
        }       
        
    }
}
