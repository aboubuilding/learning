<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeRepositoriesCommand extends Command
{
    protected $signature = 'make:repositories
                            {--model= : Nom du modèle spécifique (ex: User)}
                            {--force : Écraser les fichiers existants}
                            {--provider : Enregistrer automatiquement dans RepositoryServiceProvider}';

    protected $description = 'Génère les interfaces (Repositories/Interfaces) et les repositories (Repositories/Eloquent) pour tous les modèles';

    protected array $models = [];

    // Nouveaux chemins et namespaces
    protected string $interfaceNamespace = 'App\Repositories\Interfaces';
    protected string $eloquentNamespace = 'App\Repositories\Eloquent';
    protected string $modelNamespace = 'App\Models';

    public function handle(): int
    {
        $this->getModels();

        if (empty($this->models)) {
            $this->error('Aucun modèle trouvé dans ' . $this->modelNamespace);
            return self::FAILURE;
        }

        $force = $this->option('force');
        $withProvider = $this->option('provider');

        $this->ensureDirectories();

        $created = 0;
        $skipped = 0;

        foreach ($this->models as $modelName) {
            $this->line("Traitement du modèle : <info>$modelName</info>");

            $interfacePath = $this->generateInterface($modelName, $force);
            $repoPath = $this->generateRepository($modelName, $force);

            if ($interfacePath && $repoPath) {
                $created++;
            } else {
                $skipped++;
            }
        }

        $this->newLine();
        $this->info("✅ $created repository(s) et interface(s) générés.");

        if ($withProvider) {
            $this->registerInServiceProvider();
        }

        return self::SUCCESS;
    }

    protected function getModels(): void
    {
        $specific = $this->option('model');
        if ($specific) {
            $this->models = [Str::studly($specific)];
            return;
        }

        $modelsPath = app_path('Models');
        if (!File::isDirectory($modelsPath)) {
            return;
        }

        foreach (File::files($modelsPath) as $file) {
            $name = $file->getFilenameWithoutExtension();
            // Exclure les classes abstraites / traits
            if (strpos($name, 'Abstract') === false && strpos($name, 'Trait') === false) {
                $this->models[] = $name;
            }
        }
    }

    protected function ensureDirectories(): void
    {
        $dirs = [
            app_path('Repositories/Interfaces'),
            app_path('Repositories/Eloquent'),
        ];
        foreach ($dirs as $dir) {
            if (!File::isDirectory($dir)) {
                File::makeDirectory($dir, 0755, true);
                $this->line("Dossier créé : $dir");
            }
        }
    }

    protected function generateInterface(string $modelName, bool $force): ?string
    {
        $path = app_path("Repositories/Interfaces/{$modelName}RepositoryInterface.php");

        if (File::exists($path) && !$force) {
            $this->warn("  Interface déjà existante pour $modelName (ignorée)");
            return null;
        }

        $stub = $this->getInterfaceStub($modelName);
        File::put($path, $stub);
        $this->line("  Interface créée : $path");

        return $path;
    }

    protected function generateRepository(string $modelName, bool $force): ?string
    {
        $path = app_path("Repositories/Eloquent/{$modelName}Repository.php");

        if (File::exists($path) && !$force) {
            $this->warn("  Repository déjà existant pour $modelName (ignoré)");
            return null;
        }

        $stub = $this->getRepositoryStub($modelName);
        File::put($path, $stub);
        $this->line("  Repository créé : $path");

        return $path;
    }

    protected function getInterfaceStub(string $modelName): string
    {
        $modelClass = "{$this->modelNamespace}\\{$modelName}";

        return <<<PHP
<?php

namespace {$this->interfaceNamespace};

use {$modelClass};
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface {$modelName}RepositoryInterface
{
    /**
     * Récupère tous les enregistrements.
     *
     * @param array \$columns
     * @return Collection
     */
    public function all(array \$columns = ['*']): Collection;

    /**
     * Récupère un enregistrement par son ID.
     *
     * @param int \$id
     * @return {$modelName}|null
     */
    public function find(int \$id): ?{$modelName};

    /**
     * Crée un nouvel enregistrement.
     *
     * @param array \$data
     * @return {$modelName}
     */
    public function create(array \$data): {$modelName};

    /**
     * Met à jour un enregistrement.
     *
     * @param int \$id
     * @param array \$data
     * @return {$modelName}|null
     */
    public function update(int \$id, array \$data): ?{$modelName};

    /**
     * Supprime un enregistrement (soft delete ou physique).
     *
     * @param int \$id
     * @return bool
     */
    public function delete(int \$id): bool;

    /**
     * Récupère les enregistrements avec pagination.
     *
     * @param int \$perPage
     * @param array \$columns
     * @return LengthAwarePaginator
     */
    public function paginate(int \$perPage = 15, array \$columns = ['*']): LengthAwarePaginator;

    /**
     * Recherche des enregistrements selon des critères.
     *
     * @param array \$criteria
     * @param array \$columns
     * @return Collection
     */
    public function findBy(array \$criteria, array \$columns = ['*']): Collection;

    /**
     * Trouve un enregistrement selon des critères (unique).
     *
     * @param array \$criteria
     * @param array \$columns
     * @return {$modelName}|null
     */
    public function findOneBy(array \$criteria, array \$columns = ['*']): ?{$modelName};
}
PHP;
    }

    protected function getRepositoryStub(string $modelName): string
    {
        $modelClass = "{$this->modelNamespace}\\{$modelName}";
        $interfaceClass = "{$this->interfaceNamespace}\\{$modelName}RepositoryInterface";
        $var = Str::camel($modelName);

        return <<<PHP
<?php

namespace {$this->eloquentNamespace};

use {$modelClass};
use {$interfaceClass};
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class {$modelName}Repository implements {$modelName}RepositoryInterface
{
    protected \${$var};

    public function __construct({$modelClass} \${$var})
    {
        \$this->{$var} = \${$var};
    }

    public function all(array \$columns = ['*']): Collection
    {
        return \$this->{$var}->get(\$columns);
    }

    public function find(int \$id): ?{$modelName}
    {
        return \$this->{$var}->find(\$id);
    }

    public function create(array \$data): {$modelName}
    {
        return \$this->{$var}->create(\$data);
    }

    public function update(int \$id, array \$data): ?{$modelName}
    {
        \$model = \$this->find(\$id);
        if (!\$model) {
            return null;
        }
        \$model->update(\$data);
        return \$model->fresh();
    }

    public function delete(int \$id): bool
    {
        \$model = \$this->find(\$id);
        if (!\$model) {
            return false;
        }
        return \$model->delete();
    }

    public function paginate(int \$perPage = 15, array \$columns = ['*']): LengthAwarePaginator
    {
        return \$this->{$var}->paginate(\$perPage, \$columns);
    }

    public function findBy(array \$criteria, array \$columns = ['*']): Collection
    {
        \$query = \$this->{$var}->newQuery();

        foreach (\$criteria as \$key => \$value) {
            if (is_array(\$value)) {
                \$query->whereIn(\$key, \$value);
            } else {
                \$query->where(\$key, \$value);
            }
        }

        return \$query->get(\$columns);
    }

    public function findOneBy(array \$criteria, array \$columns = ['*']): ?{$modelName}
    {
        \$query = \$this->{$var}->newQuery();

        foreach (\$criteria as \$key => \$value) {
            if (is_array(\$value)) {
                \$query->whereIn(\$key, \$value);
            } else {
                \$query->where(\$key, \$value);
            }
        }

        return \$query->first(\$columns);
    }
}
PHP;
    }

    protected function registerInServiceProvider(): void
    {
        $providerPath = app_path('Providers/RepositoryServiceProvider.php');

        if (!File::exists($providerPath)) {
            $this->createServiceProvider();
        }

        $content = File::get($providerPath);
        $newBindings = '';

        foreach ($this->models as $modelName) {
            $interface = "{$this->interfaceNamespace}\\{$modelName}RepositoryInterface";
            $repository = "{$this->eloquentNamespace}\\{$modelName}Repository";
            $newBindings .= "        \$this->app->bind({$interface}::class, {$repository}::class);\n";
        }

        // Mettre à jour la méthode register()
        $pattern = '/public function register\(\)\s*\{([^}]*)\}/s';
        if (preg_match($pattern, $content, $matches)) {
            $newContent = str_replace($matches[0], "public function register()\n    {\n{$newBindings}\n    }", $content);
            File::put($providerPath, $newContent);
            $this->info('✅ RepositoryServiceProvider mis à jour.');
        } else {
            $this->warn('⚠️ Mise à jour manuelle nécessaire pour RepositoryServiceProvider.');
        }
    }

    protected function createServiceProvider(): void
    {
        $stub = <<<PHP
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Les liaisons seront ajoutées automatiquement par la commande make:repositories
    }

    public function boot(): void
    {
        //
    }
}
PHP;

        $path = app_path('Providers/RepositoryServiceProvider.php');
        File::put($path, $stub);
        $this->info("✅ RepositoryServiceProvider créé.");

        $this->registerProviderInConfig();
    }

    protected function registerProviderInConfig(): void
    {
        $configPath = config_path('app.php');
        $content = File::get($configPath);
        $provider = 'App\Providers\RepositoryServiceProvider::class';

        if (!str_contains($content, $provider)) {
            $pattern = '/\'providers\'\s*=>\s*\[([^\]]*)\]/s';
            if (preg_match($pattern, $content, $matches)) {
                $newProviders = $matches[1] . "        {$provider},\n";
                $newContent = str_replace($matches[0], "'providers' => [{$newProviders}]", $content);
                File::put($configPath, $newContent);
                $this->info("✅ RepositoryServiceProvider ajouté à config/app.php");
            }
        }
    }
}