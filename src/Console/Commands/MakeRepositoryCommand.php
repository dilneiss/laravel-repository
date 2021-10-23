<?php

namespace JetBox\Repositories\Console\Commands;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use JetBox\Repositories\Eloquent\AbstractRepository;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class MakeRepositoryCommand extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model repository class';

    /**
     * @var string
     */
    protected $namespace = 'App\\Repositories';

    /**
     * @var string
     */
    protected $type = 'Repository';

    /**
     * @var string
     */
    protected $abstractNamespace = AbstractRepository::class;

    /**
     * Create a new command instance.
     *
     * @param Filesystem $filesystem
     */
    public function __construct(Filesystem $filesystem)
    {
        parent::__construct($filesystem);
    }

    /**
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $this->namespace;
    }

    /**
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__ . '/../../../stubs/repository.stub';
    }

    /**
     * @param string $name
     * @return string|string[]
     * @throws FileNotFoundException
     */
    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);

        $this->makeAbstractRepository();

        return $this->checkRepositoryName($stub);
    }

    /**
     * @param $stub
     * @return array|string|string[]|void
     */
    protected function checkRepositoryName($stub)
    {
        $repository = Str::endsWith($this->getNameInput(), $this->type);

        if ($repository) {
            //            $modelNamespace = $this->qualifyModel($modelName);
            $modelName = Str::replaceLast($this->type, '', $this->getNameInput());
            $modelName = Str::singular($modelName);
            $modelNamespace = config('repository.path') . '\\' . $modelName;

            $stub = str_replace('DummyModelNamespace', $modelNamespace, $stub);
            $stub = str_replace('DummyModelClass', $modelName, $stub);

            return $stub;
        }

        $this->error('Error Repository must finish the name of the Repository Example {Model}{Repository}');
    }

    /**
     * @return void
     */
    protected function makeAbstractRepository(): void
    {
        if (!file_exists(app_path('Repositories/AbstractRepository.php'))) {
            $this->call('make:abstract-repository', [
                'name' => 'AbstractRepository'
            ]);
        }
    }

    /**
     * @return array[]
     */
    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the repository class'],
        ];
    }
}
