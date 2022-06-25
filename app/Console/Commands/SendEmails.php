<?php

namespace App\Console\Commands;

use App\Mail\EmailReminder;
use App\Models\Organizer;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '1 hour email reminder';

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

        /* Take organizers to reminder */
        $organizers = Organizer::where('reminder', '<=', Carbon::now())->where('notification', 1)->get();

        /* Each organizers send mail */
        foreach ($organizers as $organizer) {
            $email = $organizer->user->email;
            Mail::to($email)->send(new EmailReminder($organizer));

            /* Set notification to false */
            $data['notification'] = 0;

            $organizer->update($data);
        }
    }
}
