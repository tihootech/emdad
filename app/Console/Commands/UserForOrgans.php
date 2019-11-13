<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Organ;
use App\User;

class UserForOrgans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'acc:organs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make User Account For All Organs With No Acc';

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
        $organs = Organ::all();
        foreach ($organs as $organ) {
            $phrase = rand(100000,999999);
            if (!$organ->user) {
                $user = User::create([
                    'owner_type' => Organ::class,
                    'owner_id' => $organ->id,
                    'username' => $phrase,
                    'password' => bcrypt($phrase),
                ]);
                $organ->user_id = $user->id;
                $organ->save();
            }else {
                $organ->user_id = $organ->user->id;
            }
        }
    }
}
