<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ApplicationProfileMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:profile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new application profile class (XHC)';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Application Profile';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/application-profile.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\ApplicationProfiles';
    }

    /**
     * Determine if the class already exists.
     *
     * @param  string  $rawName
     * @return bool
     */
    protected function alreadyExists($rawName)
    {
        return class_exists($rawName);
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $identifier = $this->option('identifier');

        $stub = parent::replaceClass($stub, $name);
        $stub = static::replaceApplicationProfileIdentifierName($stub, $identifier);

        return str_replace('dummy_identifier', $identifier, $stub);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the application profile.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['identifier', null, InputOption::VALUE_OPTIONAL, 'The unique identifier that should be assigned.', 'dummy_identifier'],
        ];
    }

    /**
     * Replace the name of the unique identifier for the given application profile stub.
     *
     * @param  string $stub
     * @param  string  $identifier
     * @return string
     */
    protected function replaceApplicationProfileIdentifierName(string $stub, string $identifier): string
    {
        // Replace default option value, because I don't like it.
        $identifier = ($identifier == 'dummy_identifier' ? 'Dummy Identifier Name' : $identifier);

        $identifier = str_replace('_', ' ', $identifier);
        $identifier = title_case($identifier);

        return str_replace('Dummy Identifier Name', $identifier, $stub);
    }
}
