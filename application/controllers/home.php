<?php

class Home_Controller extends Base_Controller {
    
        /**
         * Initialise all required assets
         * includes all the css and js files
         */
        function init_assets()
        {
                Asset::add('bootstrap', 'css/bootstrap.min.css');
                Asset::add('stylesheet', 'css/style.css');
                Asset::add('bootstrap', 'js/bootstrap.min.js');
                Asset::add('prefixfree', 'js/prefixfree.min.js');
                Asset::add('jquery', 'js/jquery.js');
        }
    
        /**
         * Home Page
         * 
         * @return View
         */
	public function action_index()
	{
                $this->init_assets();
		return View::make('home.index');
	}
        
        /**
         * Login Page
         * 
         * @return View 
         */
        public function action_login()
        {
                $this->init_assets();
                Log::info('This is the login page.');
                return View::make('home.login');
        }

}