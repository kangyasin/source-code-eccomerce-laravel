<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Mail\Confirmation;
use Mail;
//use App\TsHdTransaksi;

class SendingConfirmation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
     public function __construct($details)
     {
         $headertransaksi = TsHdTransaksi::find($details);
         $this->details = $headertransaksi;
     }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $email = new Confirmation($this->details);
      Mail::to($this->details->customertransaksi->email)->send($email);
    }
}
