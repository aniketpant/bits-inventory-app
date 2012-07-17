<?php

class Admin_Controller extends Base_Controller {
    
        public $restful = true;
    
        /**
         * Admin Home Page
         * 
         * @return View
         */
	public function get_index() {
		return View::make('admin.index');
	}
        
        /**
         * Admin Login Page
         * 
         * @return View 
         */
        public function get_login() {
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
                        return Redirect::to('admin/login')->with_errors($validation)->with_input('only', 'username');
                }
                else {
                        $credentials = array('username' => Input::get('username'), 'password' => Input::get('password'));

                        if (Auth::attempt($credentials)) {
                                $user_master = User_Master::where('user_name', '=', $credentials['username'])->first();
                                $user_details = $user_master->details;
                                $user_role = $user_details->role()->first();
                                $role_name = $user_role->role_name;

                                if ($role_name == 'Administrator') {
                                        return Redirect::to('admin/dashboard/base');
                                }
                                else {
                                        Auth::logout();
                                        return Redirect::to('admin/login');
                                }
                        }
                }

        }
        
        public function get_logout() {
            
                Auth::logout();
                return View::make('admin.logged-out');
            
        }
        
}