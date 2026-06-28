<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use ReflectionClass;
use Illuminate\Contracts\Foundation\Application;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->bindRepositories();

        // Vous pouvez ajouter ici des liaisons personnalisées si nécessaire
        $this->registerCustomBindings();
    }

    /**
     * Lie automatiquement toutes les interfaces du dossier Interfaces
     * vers les repositories du dossier Eloquent.
     *
     * Conventions :
     * - Interface : App\Repositories\Interfaces\{Nom}RepositoryInterface
     * - Repository : App\Repositories\Eloquent\{Nom}Repository
     */
    protected function bindRepositories(): void
    {
        $interfacePath = app_path('Repositories/Interfaces');

        if (!is_dir($interfacePath)) {
            return;
        }

        // Récupère tous les fichiers PHP dans le dossier Interfaces
        $files = glob($interfacePath . '/*.php');

        foreach ($files as $file) {
            $interfaceName = pathinfo($file, PATHINFO_FILENAME);
            $interfaceClass = "App\\Repositories\\Interfaces\\{$interfaceName}";

            if (!interface_exists($interfaceClass)) {
                continue;
            }

            // Génère le nom du repository en supprimant le suffixe "Interface"
            // Exemple : UserRepositoryInterface -> UserRepository
            $repositoryName = str_replace('Interface', '', $interfaceName);
            $repositoryClass = "App\\Repositories\\Eloquent\\{$repositoryName}";

            if (!class_exists($repositoryClass)) {
                continue;
            }

            // Lie l'interface au repository
            $this->app->bind($interfaceClass, $repositoryClass);
        }
    }

    /**
     * Permet d'ajouter des liaisons personnalisées (cas particuliers).
     * Vous pouvez surcharger cette méthode dans un enfant ou la modifier directement.
     */
    protected function registerCustomBindings(): void
    {
        // Exemple de liaison personnalisée :
        // $this->app->bind(
        //     \App\Repositories\Interfaces\SpecialRepositoryInterface::class,
        //     \App\Repositories\SpecialRepository::class
        // );
    }

    public function boot(): void
    {
        //
    }
}