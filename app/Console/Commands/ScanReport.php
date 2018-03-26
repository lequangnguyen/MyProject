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

class ScanReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scan-report';

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
        MFeed::whereRaw([
            'reports' => [
                '$exists' => true,
                '$ne' => [],
            ],
        ])->chunk(100, function ($feeds) {
            foreach ($feeds as $feed) {
                foreach ($feed->reports as $r) {
                    $report = new MICheckReport();
                    $report->type = 2;
                    $report->userId = $r['user'];
                    $report->content = $r['report_content'];
                    $report->status = 0;
                    $report->target = $feed->id;
                    $report->save();
                }

                $feed->reports = [];
                $feed->save();
            }
        });

        MProduct::whereRaw([
            'reports' => [
                '$exists' => true,
                '$ne' => [],
            ],
        ])->chunk(100, function ($feeds) {
            foreach ($feeds as $feed) {
                foreach ($feed->reports as $r) {
                    $report = new MICheckReport();
                    $report->type = 1;
                    $report->userId = $r['user'];
                    $report->content = @$r['report'];
                    $report->status = 0;
                    $report->target = $feed->gtin_code;
                    $report->save();
                }

                $feed->reports = [];
                $feed->save();
            }
        });

        MAccount::whereRaw([
            'reports' => [
                '$exists' => true,
                '$ne' => [],
            ],
        ])->chunk(100, function ($feeds) {
            foreach ($feeds as $feed) {
                foreach ($feed->reports as $r) {
                    $report = new MICheckReport();
                    $report->type = 3;
                    $report->userId = $r['user'];
                    $report->content = @$r['report_content'];
                    $report->status = 0;
                    $report->target = $feed->icheck_id;
                    $report->save();
                }

                $feed->reports = [];
                $feed->save();
            }
        });
    }
}
