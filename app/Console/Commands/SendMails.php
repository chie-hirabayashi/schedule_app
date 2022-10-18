<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\Schedule;
use App\Models\User;
use Carbon\Carbon;

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

        // $user = User::first();

        // // テキストメールで短文の場合
        // Mail::raw('本文です', function ($message) use ($user) {
        //     $message->to($user->email)
        //         ->subject('タイトルです');
        // });
        // // メール用クラスのMailableを利用する場合
        // Mail::to($user->email)
        //     ->send(new Schedule($user));

        // 登録ユーザーにメール送信
        // $users = User::all();
        $users = User::whereHas('events', function ($query) {
            // 日付で絞り込み
            $tomorrow = Carbon::now()->addDay(1);
            $query->whereDate('start', $tomorrow);

            // 範囲指定の方法(翌日から1週間)
            // $from = Carbon::now()->addDay(1);
            // $to = Carbon::now()->addWeeK(1);
            // $query->whereDate('start', '>=', $from)
            //     ->whereDate('start', '<=', $to);
        })->with(['events' => function ($query) {
            // 日付で絞り込み
            $tomorrow = Carbon::now()->addDay(1);
            $query->whereDate('start', $tomorrow);
        }])->get();
        
        foreach ($users as $user) {
            Mail::to($user->email)
                ->send(new Schedule($user));
        }
    }
}
