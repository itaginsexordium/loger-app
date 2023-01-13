<?php

namespace App\Console\Commands;

use App\Models\AccessLogs;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class UpdateAccessInTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logging:update_access_in_table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновляет лог доступа  из файла  access.json который ложиться по следующему пути  storage/app/access.json';

    /**
     * Execute the console command.
     *
     * @return int
     */

    private function getFileContext()
    {
        $file = Storage::get('access.json');
        
        return json_decode("[" . $file . "{}]", true);
    }

    public function handle()
    {
        $logs = $this->getFileContext();

        if ($logs) {
            foreach ($logs as $item) {
                if (!empty($item)) {
                    if ($item['status_b'] !== true) {
                        $name = str_replace(
                            ['/', '.txt'],
                            '',
                            explode(' ', $item['request'])[1]
                        );

                        if (preg_match('[room]', $name)) {
                            $logDb = AccessLogs::firstOrCreate(['name' => $name], [
                                'ip' => $item['remote_addr'],
                                'path' => '',
                                'a_time' => $item['time_local']
                            ]);

                            if ($logDb->a_time < (int)$item['time_local']) {
                                $logDb->a_time = $item['time_local'];
                            }

                            $logDb->save();
                        }
                    }
                }
            }
        }
        return Command::SUCCESS;
    }
}
