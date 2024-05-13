<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use InvalidArgumentException;
use ReflectionClass;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Str;

use function Laravel\Prompts\confirm;

class GenerateRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name : The name of the repository} {--model= : The target model directory (e.g., User, Post, Comment, Company/Product, Cart/Product/Price)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class and interface';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $model = $this->option('model');

        if (empty($model)) {
            $this->error('Invalid model using --model option.');
            return;
        }

        // Convert class string to fully qualified class name
        $modelClassName = '\\App\\Models\\' . str_replace("/", "\\", $model);

        if (class_exists($modelClassName)) {
            // Get reflection of the class
            $reflectionClass = new ReflectionClass($modelClassName);

            // Get the namespace of the class
            $modelNamespace = $reflectionClass->getNamespaceName() . "\\" . str_replace("/", "\\", $model);
        } else {
            $this->error("Class $modelClassName does not exist.");
            return;
        }

        // Use basename function to get the class name
        $modelClassNameOnly = basename(str_replace('\\', '/', $modelNamespace));

        $targetPath = "Repositories";

        $explodedName = explode("/", $name);
        $className = array_pop($explodedName);
        $subDir = implode("/", $explodedName);
        $namespace = implode("\\", explode("/", 'App/' . $targetPath . '/' . $subDir));

        $fileName = $className . '.php';
        $appDir = app_path($targetPath . '/' . $subDir);
        $appPath = app_path($targetPath . '/' . $subDir . '/' . $fileName);

        if (file_exists($appPath)) {
            $this->error("Repository $appPath already exists!");
            return;
        }

        $stub = file_get_contents(__DIR__.'/stubs/repository.stub');
        $stub = str_replace('{{ CLASS_NAME }}', $className, $stub);
        $stub = str_replace('{{ NAMESPACE }}', $namespace, $stub);
        $stub = str_replace('{{ IMPLEMENTED_INTERFACE }}', $className . "Interface", $stub);
        $stub = str_replace('{{ USE_INTERFACE }}', $namespace . '\\Contracts\\' . $className . "Interface", $stub);
        $stub = str_replace('{{ MODEL_CLASS_NAME }}', $modelClassNameOnly, $stub);
        $stub = str_replace('{{ MODEL_NAMESPACE }}', $modelNamespace, $stub);

        if (!is_dir($appDir)) {
            mkdir($appDir, 0777, true);
            mkdir(app_path($targetPath . '/' . $subDir . "/Contracts"), 0777, true);
        }

        file_put_contents($appPath, $stub);

        $appInterfacePath = app_path($targetPath . '/' . $subDir . '/Contracts/' . $className . 'Interface.php');
        $interfaceName = $className . "Interface";
        $stubInterface = file_get_contents(__DIR__.'/stubs/interface.stub');
        $stubInterface = str_replace('{{ INTERFACE_NAME }}', $interfaceName, $stubInterface);
        $stubInterface = str_replace('{{ NAMESPACE }}', $namespace . "\\Contracts", $stubInterface);

        file_put_contents($appInterfacePath, $stubInterface);

        $appBaseRepositoryDir = app_path("Repositories/BaseRepository.php");

        if (!file_exists($appBaseRepositoryDir)) {
            $stubBaseRepository = file_get_contents(__DIR__.'/stubs/base-repository.stub');
            file_put_contents($appBaseRepositoryDir, $stubBaseRepository);
        }

        $appBaseRepositoryInterfaceDir = app_path("Repositories/Contracts/RepositoryInterface.php");

        if (!file_exists($appBaseRepositoryInterfaceDir)) {
            $stubBaseRepositoryInterface = file_get_contents(__DIR__.'/stubs/base-repository-interface.stub');
            file_put_contents($appBaseRepositoryInterfaceDir, $stubBaseRepositoryInterface);
        }

        $appBasePaginateRepoInterfaceDir = app_path("Repositories/Contracts/PaginateRepositoryInterface.php");

        if (!file_exists($appBasePaginateRepoInterfaceDir)) {
            $stubBasePaginateRepoInterface = file_get_contents(__DIR__.'/stubs/base-repository-paginate-interface.stub');
            file_put_contents($appBasePaginateRepoInterfaceDir, $stubBasePaginateRepoInterface);
        }

        $this->info("Repository [app/$targetPath/$subDir/$className.php] created successfully");
    }

}
