<?php
   
namespace App\Console\Commands;
   
use Illuminate\Console\Command;
use App\User;
use Carbon\Carbon;
   
class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    
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
        // \Log::info("Cron is working fine!");


        $today = Carbon::today();
        $user = User::where('mine_date', '<=', $today );
        $user->update([
            // 'no_of_login' => 0,
        ]);


        
    }
}

