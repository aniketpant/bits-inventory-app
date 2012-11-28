<?php

class User_Dashboard_Base_Controller extends Base_Controller {
    
        public $restful = true;
                
        /**
         * User/Dashboard
         * 
         * @return View
         */
        public function get_index() {
            
	    		$user = User_Master::with(array('details'))->where('user_name', '=', Session::get('username'))->first();
                return View::make('user.dashboard')->with('user', $user);
            
        }
    
}