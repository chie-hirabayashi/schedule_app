<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\Schedule;
use App\Models\User;

class SendMails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scheduled email sending';

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
        echo 'SendMail';

        $user = User::first();

        // テキストメールで短文の場合
        Mail::raw('本文です', function ($message) use ($user) {
            $message->to($user->email)
                ->subject('タイトルです');
        });
        // メール用クラスのMailableを利用する場合
        Mail::to($user->email)
            ->send(new Schedule($user));
    }
}
