<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\NotifyInactiveUser;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:inactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inactive user email';

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
     * @return int
     */
    public function handle()
    {
        $limit = Carbon::now()->subDay(7);
        $inactiveUsers = User::whereDate('created_at', '<', $limit)->get();

        foreach ($inactiveUsers as $user){
            $user->notify(new NotifyInactiveUser());
            $this->info('your email sent is ' . $user->email);
        }
    }
}
