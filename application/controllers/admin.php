<?php

class Admin_Controller extends Base_Controller {
    
        public $restful = true;
    
        /**
         * Admin Home Page
         * 
         * @return View
         */
	public function get_index() {
                IoC::resolve('init_asset');
		return View::make('admin.index');
	}
        
        /**
         * Admin Login Page
         * 
         * @return View 
         */
        public function get_login() {
                IoC::resolve('init_asset');
                Log::info('This is the administrator login page.');
                return View::make('admin.login');
        }
        
        /**
         * Validation on post from admin/login
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
                        $credentials = array('username' => Input::get('username'), 'password' => Input::get('password'));

                        if (Auth::attempt($credentials)) {
                                return Redirect::to('admin/dashboard');
                        }
                }

        }
        
}