<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Admin\AdminInterface;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Author\AuthorInterface;
use App\Repositories\Author\AuthorRepository;
use App\Repositories\Books\BooksInterface;
use App\Repositories\Books\BooksRepository;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AdminInterface::class, AdminRepository::class);
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(AuthorInterface::class, AuthorRepository::class);
        $this->app->bind(BooksInterface::class, BooksRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
     public function boot()
    {
        Paginator::useBootstrap();
    }
}
