<?php

namespace App\Console\Commands;

use App\Mail\PayoutMail;
use App\Models\SuccessfulPayout;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendPayoutMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payout:mails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = SuccessfulPayout::whereStatus('pending')->limit(5)->get();
        foreach($users as $user){
            Mail::to($user->email)
                ->send(new PayoutMail($user));
            $user->status = 'sent';
            $user->save();
        }
        return Command::SUCCESS;
    }
}
