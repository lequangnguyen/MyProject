<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Social\Vendor;
use App\Models\Social\MRealtime;
use App\Models\Social\MProduct;
use App\Models\Social\MFeed;
use App\Models\Social\MAccount;
use App\Models\Enterprise\MICheckReport;
use Carbon\Carbon;
use App\Jobs\ExportHCMJob;

class ReportHCM extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report-hcm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        dispatch(new ExportHCMJob());
    }
}
