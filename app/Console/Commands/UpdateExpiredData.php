<?php

namespace App\Console\Commands;

use App\Models\ApartmentSponsor;
use Illuminate\Console\Command;

class UpdateExpiredData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:expired-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update expired data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $expiredRecords = ApartmentSponsor::where('expire_date', '<', now())->get();

        foreach ($expiredRecords as $record) {
            $record->update(['valid' => false]);
        }

        $this->info('Expired records updated successfully.');
    }
}
