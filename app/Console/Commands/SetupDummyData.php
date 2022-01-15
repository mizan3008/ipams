<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SetupDummyData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:dummy-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will help to generate dummy data';

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
        $user = User::whereEmail('admin@example.com')->first();

        if(is_null($user)){
            $user = new User();
            $user->name = 'Admin';
            $user->email = 'admin@example.com';
            $user->email_verified_at = now();
            $user->password = 'password';
            $user->remember_token = Str::random(10);
            $user->save();
        }

        $this->info('Done!');
        return 0;
    }
}
