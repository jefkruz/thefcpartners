<?php

namespace App\Console\Commands;

use App\Mail\VerifyMail;
use App\Models\RegistrationMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendVerifyRegistrationMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registration:mails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send verify registration mails';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = RegistrationMail::whereStatus('pending')->limit(5)->get();
        foreach($users as $user){
            Mail::to($user->email)
                ->send(new VerifyMail($user));
            $user->status = 'sent';
            $user->save();
        }
        return Command::SUCCESS;
    }
}
