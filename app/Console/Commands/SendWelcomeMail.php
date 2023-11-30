<?php

namespace App\Console\Commands;

use App\Mail\WelcomeMail;
use App\Models\SuccessfulRegistration;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendWelcomeMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'welcome:mails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send welcome mails';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = SuccessfulRegistration::whereStatus('pending')->limit(5)->get();
        foreach($users as $user){
            Mail::to($user->email)
                ->send(new WelcomeMail($user));
            $user->status = 'sent';
            $user->save();
        }
        return Command::SUCCESS;
    }
}
