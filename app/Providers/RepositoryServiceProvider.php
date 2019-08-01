<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\CourseRepository::class, \App\Repositories\CourseRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\RoomRepository::class, \App\Repositories\RoomRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\MenuRepository::class, \App\Repositories\MenuRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProgramStudyRepository::class, \App\Repositories\ProgramStudyRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AccountUserRepository::class, \App\Repositories\AccountUserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\LectureRepository::class, \App\Repositories\LectureRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\StudentRepository::class, \App\Repositories\StudentRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ClassRepository::class, \App\Repositories\ClassRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ScheduleRepository::class, \App\Repositories\ScheduleRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\SchedulingStudentRepository::class, \App\Repositories\SchedulingStudentRepositoryEloquent::class);
        //:end-bindings:
    }
}
