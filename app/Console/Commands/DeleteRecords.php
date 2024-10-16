<?php

namespace App\Console\Commands;

use App\Models\RedeemDeal;
use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;

    class DeleteRecords extends Command
{
    protected $signature = 'DeleteRecords';

    public function handle()
    {
        RedeemDeal::where('created_at', '<=', Carbon::now())->delete();
    }
}

