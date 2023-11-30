<?php

namespace App\Console\Commands;

use App\Mail\CommissionDisbursementMail;
use App\Models\CommissionDisbursement;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendCommissionDisbursementMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'disbursement:mails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send commission disbursement mails';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = CommissionDisbursement::whereStatus('pending')->limit(5)->get();
        foreach($users as $user){
            Mail::to($user->email)
                ->send(new CommissionDisbursementMail($user));
            $user->status = 'sent';
            $user->save();
        }
        return Command::SUCCESS;
    }
}
