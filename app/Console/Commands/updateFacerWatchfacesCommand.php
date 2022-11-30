<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Browsershot\Browsershot;

class updateFacerWatchfacesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'facer:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get watches from Facer';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $html = Browsershot::url('https://facer.io')
            ->setChromePath('/usr/bin/chromium-browser')
            ->addChromiumArguments(['no-sandbox', 'disable-setuid-sandbox'])
            ->bodyHtml();

        echo $html;

        return Command::SUCCESS;
    }
}
