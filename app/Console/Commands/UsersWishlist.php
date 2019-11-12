<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\UsersWishlistMail;
use DB;

class UsersWishlist extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:wishlist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'weekly email of users wishlist';

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
        //
        $user_wishlist = DB::table('user_wish_list')
                  ->whereRaw('Date(created_at) = CURDATE()- INTERVAL 7 DAY')
                  ->get();

        Mail::to('admin@gmail.com')->send(new UsersWishlistMail($user_wishlist));
    }
}
