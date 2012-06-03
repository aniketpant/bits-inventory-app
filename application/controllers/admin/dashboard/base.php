<?php

class Admin_Dashboard_Base_Controller extends Base_Controller {
    
        public $restful = true;
                
        public function get_index() {
            
                if (Auth::check()) {
                        IoC::resolve('init_assets');
                        return View::make('admin.dashboard');
                }
                else {
                        return Redirect::to('admin/login');
                }
            
        }
    
}