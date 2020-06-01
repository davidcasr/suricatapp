<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\Person;
use App\User;
use App\Notifications\NonAttendanceNotification;

class NonAttendanceNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:nonAttendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Non-attendance at meetings';

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
        $people = Person::select('people.id', 'people.first_name', 'people.last_name', 'meetings.user_id',
            DB::raw('COUNT(assistants.confirmation) as nonattendance'))
            ->join('assistants', 'people.id', '=', 'assistants.person_id')
            ->join('meetings', 'assistants.meeting_id', '=', 'meetings.id')
            ->where('assistants.confirmation', 0)
            ->whereMonth('meetings.created_at', Carbon::now()->format('m'))
            ->distinct()
            ->groupBy('people.id')
            ->get();
        
        Log::info($people);

        foreach ($people as $person){
            if($person->nonattendance >= 3){

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
                    $user->notify(new NonAttendanceNotification($person));
                }                    
                
            }
        }  
    }
}
