<?php

	namespace App\Providers;

	use Illuminate\Support\ServiceProvider;

	class AppServiceProvider extends ServiceProvider
	{

		public function register(): void
		{
			//
		}


		public function boot()
		{
			$this->app['router']->aliasMiddleware('admin', \App\Http\Middleware\AdminMiddleware::class);
		}

	}
