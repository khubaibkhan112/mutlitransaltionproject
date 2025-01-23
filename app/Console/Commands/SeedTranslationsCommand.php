<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SeedTranslationsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-translations-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle() {
        $count = $this->ask('How many records do you want to generate?', 100000);
    
        $this->info("Seeding {$count} records...");
        \App\Models\Translation::factory()->count($count)->create();
    
        $this->info('Seeding completed successfully.');
    }
    
}
