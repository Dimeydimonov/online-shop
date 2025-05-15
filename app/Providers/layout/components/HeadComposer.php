<?php

	namespace App\Providers\layout\components;

	use App\Repository\Races\RegularRacesRepository;
	use App\Repository\Site\ImageRepository;
	use App\Repository\Site\LanguagesRepository;
	use App\Service\DbRouter\Router;
	use App\Service\User;
	use Illuminate\Support\Facades\Route;
	use Illuminate\Support\Facades\Session;
	use Illuminate\View\View;
	use Illuminate\Support\Facades\Request;

	readonly class HeadComposer
	{
		public function __construct()
		{
		}

		public function compose(View $view): void
		{
			$title = 'market';

			$view->with('title', $title);
		}
	}
