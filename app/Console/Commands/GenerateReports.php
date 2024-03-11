<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Report;
use Carbon\Carbon;

class GenerateReports extends Command
{
    protected $signature = 'reports:generate';

    protected $description = 'Generate reports and save to files';

    public function handle()
    {
        // Query data from the database (replace with your own logic)
        $reportsData = Report::whereDate('created_at', Carbon::yesterday())->get();

        // Process the data and generate the report content
        $reportContent = '';

        foreach ($reportsData as $report) {
            $reportContent .= $report->title . ', ' . $report->description . "\n";
        }

        // Generate the report file
        $fileName = 'report_' . Carbon::yesterday()->format('Y-m-d') . '.txt';
        $filePath = storage_path('app/reports/' . $fileName);

        file_put_contents($filePath, $reportContent);

        $this->info('Reports generated successfully: ' . $filePath);
    }
}
