<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User; 

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Slider::class => 'App\Policies\SliderPolicy',
        \App\Post::class => 'App\Policies\PostPolicy',
        \App\Infor::class => 'App\Policies\InforPolicy',
        \App\Subject::class => 'App\Policies\SubjectPolicy',
        \App\Lesson::class => 'App\Policies\LessonPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('admin', function(User $user){
            return $user->role->name === 'admin';
        });
    }
}
