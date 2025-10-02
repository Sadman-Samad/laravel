<?php

namespace Modules\Shop\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected string $name = 'Shop';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     */
    public function map(): void
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     */
    protected function mapWebRoutes(): void
    {
        // Route::middleware('web')->group(module_path($this->name, '/routes/web.php'));

        // ✅ CHANGED: use safe helper instead of raw module_path()
        $path = $this->getModulePath('routes/web.php');
        if ($path && file_exists($path)) {
            Route::middleware('web')->group($path);
        }
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     */
    protected function mapApiRoutes(): void
    {
        // Route::middleware('api')->prefix('api')->name('api.')->group(module_path($this->name, '/routes/api.php'));
        // ✅ CHANGED: use safe helper instead of raw module_path()
        $path = $this->getModulePath('routes/api.php');
        if ($path && file_exists($path)) {
            Route::middleware('api')
                ->prefix('api')
                ->name('api.')
                ->group($path);
        }
    }


      /**
     * ✅ NEW: Safely get the module path without crashing Artisan.
     * Falls back to base_path() if module_path() isn’t ready.
     */
    protected function getModulePath(string $subPath): ?string
    {
        try {
            if (function_exists('module_path')) {
                return module_path($this->name, $subPath);
            }
        } catch (\Throwable $e) {
            // ✅ ADDED: swallow the error so artisan commands like module:list don’t break
        }

        // ✅ ADDED: fallback
        return base_path("Modules/{$this->name}/{$subPath}");
    }
}
