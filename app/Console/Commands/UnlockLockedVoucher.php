<?php

namespace App\Console\Commands;

use App\Models\Voucher;
use Illuminate\Console\Command;

class UnlockLockedVoucher extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:unlock-locked-voucher';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Unlock locked voucher when the voucher has expired';

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
        Voucher::lockedVoucher()
               ->update([
                    'status'            => 0,
                    'customer_id'       => null,
                    'expired_at'        => null,
               ]);

        $this->info('some locked voucher has been unlock');
    }
}
