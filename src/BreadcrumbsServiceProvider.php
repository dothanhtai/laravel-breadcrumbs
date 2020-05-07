<?php
namespace Dothanhtai\Breadcrumbs;

use Illuminate\Support\ServiceProvider;
use Blade;

class BreadcrumbsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    public function boot()
    {
        Blade::directive('breadcrumb', function () {
            return "<?php echo Breadcrumb::render(); ?>";
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('breadcrumbs', function ($app) {
            $breadcrumbs = new Breadcrumb();

            return $breadcrumbs;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['breadcrumbs'];
    }
}
