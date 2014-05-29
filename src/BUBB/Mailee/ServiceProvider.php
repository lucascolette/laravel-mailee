<?php namespace BUBB\Mailee;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
  /**
   * Register the Mailee 
   *
   * @return void
   */
  public function register()
  {
    $this->app->singleton('mailee', function(){
      return new \BUBB\Mailee\Mailee();
    });
  }

  public function boot()
  {
    $this->package('bubb/mailee');
  }

}