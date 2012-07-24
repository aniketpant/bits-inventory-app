<?php

class User_Dashboard_Base_Controller extends Base_Controller {
    
        public $restful = true;
                
        /**
         * User/Dashboard
         * 
         * @return View
         */
        public function get_index() {
            
                return View::make('user.dashboard');
            
        }
    
}