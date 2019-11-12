<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\order_details;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderDetailsMail;
class dailyordersdetail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:detail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email of daily order details';

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
      
        $orderdetails = DB::table('order_details')
                  ->whereRaw('Date(created_at) = CURDATE()')
                  ->get();

        Mail::to('admin@gmail.com')->send(new OrderDetailsMail($orderdetails));
    
        //
    }
}
