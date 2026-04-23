<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class DatabaseBackupCommand extends Command
{
    protected $signature = 'db:backup';
    protected $description = 'Genera un backup de la base de datos y lo guarda en storage';

    public function handle()
    {
        $dbConfig = Config::get('database.connections.mysql');
        $filename = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
        $path = storage_path("app/{$filename}");
        $authFile = storage_path("app/db_auth.cnf");

        $authContent = "[client]\nuser=\"{$dbConfig['username']}\"\npassword=\"{$dbConfig['password']}\"\nhost=\"{$dbConfig['host']}\"";
        file_put_contents($authFile, $authContent);

        try {
            $command = sprintf(
                'mysqldump --defaults-extra-file="%s" --set-gtid-purged=OFF --single-transaction %s > "%s" 2>&1',
                $authFile,
                $dbConfig['database'],
                $path
            );

            system($command);
            if (file_exists($authFile)) unlink($authFile);

            if (file_exists($path) && filesize($path) > 0) {
                $this->info("Backup generado con éxito: {$filename}");
                return 0;
            }

            $this->error("Error al generar el backup.");
            return 1;
        } catch (\Exception $e) {
            if (file_exists($authFile)) unlink($authFile);
            $this->error("Excepción: " . $e->getMessage());
            return 1;
        }
    }
}