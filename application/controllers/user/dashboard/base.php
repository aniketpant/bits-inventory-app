<?php

class User_Dashboard_Base_Controller extends Base_Controller {
    
        public $restful = true;
                
        public function get_index() {
            
                if (Auth::check()) {
                        IoC::resolve('init_assets');
                        return View::make('user.dashboard');
                }
                else {
                        return Redirect::to('home/login');
                }
            
        }
    
}