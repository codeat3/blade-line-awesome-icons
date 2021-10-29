<?php

declare(strict_types=1);

namespace Codeat3\BladeLineAwesomeIcons;

use BladeUI\Icons\Factory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

final class BladeLineAwesomeIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-line-awesome-icons', []);

            $factory->add('line-awesome-icons', array_merge(['path' => __DIR__.'/../resources/svg'], $config));
        });
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/blade-line-awesome-icons.php', 'blade-line-awesome-icons');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-line-awesome-icons'),
            ], 'blade-line-awesome-icons');

            $this->publishes([
                __DIR__.'/../config/blade-line-awesome-icons.php' => $this->app->configPath('blade-line-awesome-icons.php'),
            ], 'blade-line-awesome-icons-config');
        }
    }
}
