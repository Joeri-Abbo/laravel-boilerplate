<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePermissions();
        $this->registerJetstreamComponents();

        Jetstream::deleteUsersUsing(DeleteUser::class);
    }

    protected function registerJetstreamComponents()
    {
        $components = [
            'action-message', 'action-section', 'application-logo', 'application-mark',
            'authentication-card', 'authentication-card-logo', 'banner', 'button',
            'checkbox', 'confirmation-modal', 'confirms-password', 'danger-button',
            'dialog-modal', 'dropdown', 'dropdown-link', 'form-section', 'input',
            'input-error', 'label', 'modal', 'nav-link', 'responsive-nav-link',
            'secondary-button', 'section-border', 'section-title', 'switchable-team',
            'validation-errors', 'welcome',
        ];

        foreach ($components as $component) {
            Blade::component("components.jet.{$component}", "jet-{$component}");
        }
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
