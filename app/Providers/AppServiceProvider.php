<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component(
            'filament.resources.quiz-resource.relation-managers.questions-relation-manager',
            \App\Filament\Resources\QuizResource\RelationManagers\QuestionsRelationManager::class
        );
    }
}
