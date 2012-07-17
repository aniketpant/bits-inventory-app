<?php

class Home_Controller extends Base_Controller {
    
        public $restful = true;
    
        /**
         * Home Page
         * 
         * @return View
         */
	public function get_index() {
		return View::make('home.index');
	}
        
        /**
         * Login Page
         * 
         * @return View 
         */
        public function get_login() {
                Log::info('This is the login page.');
                return View::make('home.login');
        }
        
        /**
         * Validation on post from home/login
         * 
         * @return View
         */
        public function post_login() {

                // Gathering all submitted inputs
                $input = Input::all();

                // Setting rules for the validation
                $rules = array(
                    'username'  =>  'required',
                    'password'  =>  'required'
                );

                $messages = array(
                    'required'  => 'We need you to fill the :attribute field.',
                );

                $validation = Validator::make($input, $rules, $messages);

                if ($validation->fails()) {
                        return Redirect::to('home/login')->with_errors($validation);
                }
                else {
                        return Redirect::to('user/dashboard')->with_errors($validation);
                }
        
        }

}