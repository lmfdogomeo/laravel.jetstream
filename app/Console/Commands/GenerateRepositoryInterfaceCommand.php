<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateRepositoryInterfaceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:interface {name : The name of the interface} {--target= : The target directory (e.g., repository, controllers, services, requests)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new interface';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $target = $this->option('target');

        if ($target !== null && !in_array($target, ['repository', 'controllers', 'services', 'requests'])) {
            $this->error('Invalid target using --target option.');
            return;
        }

        $targets = [
            'repository' => 'Repositories',
            'controllers' => 'Http/Controllers',
            'services' => 'Services',
            'requests' => 'Http/Requests',
        ];

        $targetPath = isset($targets[$target]) ? $targets[$target] : "Interfaces";

        $explodedName = explode("/", $name);
        $interfaceName = array_pop($explodedName);
        $subDir = implode("/", $explodedName);
        $namespace = implode("\\", explode("/", 'App/' . $targetPath . '/' . $subDir));

        $fileName = $interfaceName . '.php';
        $appDir = app_path($targetPath . '/' . $subDir);
        $appPath = app_path($targetPath . '/' . $subDir . '/' . $fileName);

        if (file_exists($appPath)) {
            $this->error("Interface file $appPath already exists!");
            return;
        }

        $stub = file_get_contents(__DIR__.'/stubs/interface.stub');
        $stub = str_replace('{{ INTERFACE_NAME }}', $interfaceName, $stub);
        $stub = str_replace('{{ NAMESPACE }}', $namespace, $stub);

        if (!is_dir($appDir)) {
            mkdir($appDir, 0777, true);
        }

        file_put_contents($appPath, $stub);

        $this->info("Interface [app/$targetPath/$subDir/$interfaceName.php] created successfully");
    }
}
