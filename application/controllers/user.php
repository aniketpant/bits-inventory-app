<?php

class User_Controller extends Base_Controller {
    
        public $restful = true;
    
        /**
         * user Page
         * 
         * @return View
         */
	public function get_index() {
		return View::make('user.index');
	}
        
        /**
         * Login Page
         * 
         * @return View 
         */
        public function get_login() {
                return View::make('user.login');
        }
        
        /**
         * Validation on post from user/login
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
                        return Redirect::to('user/login')->with_errors($validation)->with_input('only', 'username');
                }
                else {
                        $credentials = array('username' => Input::get('username'), 'password' => Input::get('password'));

                        if (Auth::attempt($credentials)) {
                                Session::put('username', $credentials['username']);
                                Session::put('user_type', 'user');
                                return Redirect::to('user/dashboard/base');
                        }
                        else {
                                return Redirect::to('user/login')->with_errors($validation)->with_input('only', 'username');
                        }
                }
        
        }
        
        /**
         * Logout
         * 
         * @return View
         */
        
        public function get_logout() {
                Auth::logout();
                Session::flush();
                return View::make('user.logged-out');
        }

}