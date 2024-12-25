<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class RunDevelop extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Laravel development server, npm dev server, and queue worker in separate terminals within the same VSCode window';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Laravel development server...');

        // Start Laravel server in the current terminal
        $artisanServe = new Process(['php', 'artisan', 'serve']);
        $artisanServe->setTimeout(null);
        $artisanServe->start();

        $this->info('Laravel development server is running.');

        $this->info('Chào mừng đến với bình nguyên vô tận!');
        $this->startNewTerminalAndRunNpm();

        $this->info('Mình xin phép ăn miếng to nhé!');
        $this->startNewTerminalAndRunQueueWorker();

        $this->info('VICTORY');

        // Keep Laravel server output visible in this terminal
        $artisanServe->wait(function ($type, $buffer) {
            $this->output->write($buffer);
        });
    }

    // Run npm in a new terminal : npm run dev
    private function startNewTerminalAndRunNpm()
    {
        if (PHP_OS_FAMILY === 'Windows') {
            $command = 'start cmd.exe /K "npm run dev"';
            Process::fromShellCommandline($command)->run();
        }
        elseif (PHP_OS_FAMILY === 'Darwin') {
            $command = 'osascript -e \'tell app "Terminal" to do script "cd ' . base_path() . ' && npm run dev"\'';
            Process::fromShellCommandline($command)->run();
        }
        elseif (PHP_OS_FAMILY === 'Linux') {
            $command = 'gnome-terminal -- bash -c "npm run dev; exec bash"';
            Process::fromShellCommandline($command)->run();
        }
    }

    // Run the queue worker in a new terminal
    private function startNewTerminalAndRunQueueWorker()
    {
        if (PHP_OS_FAMILY === 'Windows') {
            $command = 'start cmd.exe /K "php artisan queue:work --sleep=0"';
            Process::fromShellCommandline($command)->run();
        }
        elseif (PHP_OS_FAMILY === 'Darwin') {
            $command = 'osascript -e \'tell app "Terminal" to do script "cd ' . base_path() . ' && php artisan queue:work --sleep=0"\'';
            Process::fromShellCommandline($command)->run();
        }
        elseif (PHP_OS_FAMILY === 'Linux') {
            $command = 'gnome-terminal -- bash -c "php artisan queue:work --sleep=0; exec bash"';
            Process::fromShellCommandline($command)->run();
        }
    }
}
