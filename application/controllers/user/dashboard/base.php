<?php

class User_Dashboard_Base_Controller extends Base_Controller {
    
        public $restful = true;
                
        public function get_index() {
            
                return View::make('user.dashboard');
            
        }
    
}