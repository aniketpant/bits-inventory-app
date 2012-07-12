<?php

class Admin_Dashboard_Controls_Controller extends Base_Controller {
    
        public $restful = true;
        
        public function get_index() {
            
                if (Auth::check()) {
                        IoC::resolve('init_assets');
                        return View::make('admin.controls');
                }
                else {
                        return Redirect::to('admin/login');
                }
            
        }
        
        public function get_manage_user_roles() {
            
                if (Auth::check()) {
                        $user_roles = User_Role_Master::get();
                        
                        IoC::resolve('init_assets');        
                        return View::make('admin.manage-user-roles')->with(array('user_roles' => $user_roles));
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
        
        public function post_manage_user_roles() {
            
                if (Auth::check()) {

                        // Gathering all submitted inputs
                        $input = Input::all();

                        // Setting rules for the validation
                        $rules = array(
                            'user_role_name'    =>  'required|unique:user_role_master,role_name'
                        );

                        $messages = array(
                            'required'  => 'We need you to fill the :attribute field.',
                            'unique'    => 'The value you entered already exists!',
                        );

                        $validation = Validator::make($input, $rules, $messages);
                        
                        $user_roles = User_Role_Master::get();

                        if ($validation->fails()) {
                                return Redirect::to('admin/dashboard/controls/manage_user_roles')->with_errors($validation)->with_input('only', 'user_role_name');
                        }
                        else {
                                IoC::resolve('init_assets');                   
                                return View::make('admin.manage-user-roles')->with(array('user_roles' => $user_roles));
                        }
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
    
}