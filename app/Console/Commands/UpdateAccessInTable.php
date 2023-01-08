<?php

namespace App\Console\Commands;

use App\Models\AccessLogs;
use Illuminate\Console\Command;

class UpdateAccessInTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logging:update_access_in_table {file} {ip}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновляет лог доступа  при запросе на apache';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $root  = $this->argument('file');
        $ip = $this->argument('ip');

        AccessLogs::updateOrCreate([ 'name'=> $root], [
            'ip'=> $ip,
            'path'=> '',
            'a_time'=> time()
        ]);

        return Command::SUCCESS;
    }
}
