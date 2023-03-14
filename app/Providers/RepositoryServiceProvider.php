<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\TopicInterface;
use App\Repositories\TopicRepository;

class RepositoryServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->app->bind(
      TopicInterface::class,
      TopicRepository::class
    );
  }
}
