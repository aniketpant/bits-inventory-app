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
                            'unique'    => 'The :attribute you entered already exists!',
                        );

                        $validation = Validator::make($input, $rules, $messages);

                        if ($validation->fails()) {
                                return Redirect::to('admin/dashboard/controls/manage_user_roles')->with_errors($validation)->with_input('only', 'user_role_name');
                        }
                        else {
                                $user_role_name = $input['user_role_name'];
                                User_Role_Master::create(array('role_name' => $user_role_name));
                                
                                return Redirect::to('admin/dashboard/controls/manage_user_roles');
                        }
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
        
        public function get_manage_locations() {
            
                if (Auth::check()) {
                        $locations = Location_Master::get();
                        
                        IoC::resolve('init_assets');        
                        return View::make('admin.manage-locations')->with(array('locations' => $locations));
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
        
        public function post_manage_locations() {
            
                if (Auth::check()) {
                        // Gathering all submitted inputs
                        $input = Input::all();

                        // Setting rules for the validation
                        $rules = array(
                            'location_name'    =>  'required|unique:location_master,location_name'
                        );

                        $messages = array(
                            'required'  => 'We need you to fill the :attribute field.',
                            'unique'    => 'The :attribute you entered already exists!',
                        );

                        $validation = Validator::make($input, $rules, $messages);

                        if ($validation->fails()) {
                                return Redirect::to('admin/dashboard/controls/manage_locations')->with_errors($validation)->with_input('only', 'user_role_name');
                        }
                        else {
                                $location_name = $input['location_name'];
                                Location_Master::create(array('location_name' => $location_name));
                                
                                return Redirect::to('admin/dashboard/controls/manage_locations');
                        }
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
        
        
        public function get_manage_users() {
            
                if (Auth::check()) {
                        $users = User_Master::with(array('details', 'details.role'))->get();
                        
                        $user_roles_master = User_Role_Master::get('role_name');
                        $user_roles = array();                        
                        foreach ($user_roles_master as $user_role) {
                            $user_roles[$user_role->role_name] = $user_role->role_name;
                        }
                        
                        IoC::resolve('init_assets');        
                        return View::make('admin.manage-users')->with(array('users' => $users, 'user_roles' => $user_roles));
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
        
        public function post_manage_users() {
            
                if (Auth::check()) {
                        // Gathering all submitted inputs
                        $input = Input::all();

                        // Setting rules for the validation
                        $rules = array(
                            'user_name' =>  'required|unique:user_master,user_name',
                            'psrn'      =>  'unique:user_details,psrn'
                        );

                        $messages = array(
                            'required'  => 'We need you to fill the :attribute field.',
                            'unique'    => 'The :attribute you entered already exists!',
                        );

                        $validation = Validator::make($input, $rules, $messages);
                        
                        $users = User_Master::with('details')->get();

                        if ($validation->fails()) {
                                return Redirect::to('admin/dashboard/controls/manage_users')->with_errors($validation)->with_input();
                        }
                        else {
                                $user_name = $input['user_name'];
                                $psrn = $input['psrn'];
                                $role_name = $input['user_role'];
                
                                // Credentials for user
                                $credentials = array(
                                    'user_name' =>  $user_name,
                                    'password'  =>  Hash::make($user_name),
                                    'role_name' =>  $role_name,
                                    'psrn'      =>  $psrn,
                                );
                                
                                $user = User_Master::create(array(
                                    'user_name' =>  $credentials['user_name'],
                                    'password'  =>  $credentials['password'],
                                    ));
                                
                                $data_user_details = new User_Details(array('psrn' => $credentials['psrn']));

                                $user_details = $user->details()->insert($data_user_details);

                                $user_role_master = User_Role_Master::where('role_name', '=', $credentials['role_name'])->first();

                                $user_role_details = User_Role_Details::create(array(
                                    'user_details_id'       =>  $user_details->id,
                                    'user_role_master_id'   =>  $user_role_master->id,
                                    ));
                                
                                return Redirect::to('admin/dashboard/controls/manage_users');
                        }
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
        
        
        
        public function get_manage_inventory_types() {
            
                if (Auth::check()) {
                        $inventory_types = Inventory_Type_Master::get();
                        
                        IoC::resolve('init_assets');        
                        return View::make('admin.manage-inventory-types')->with(array('inventory_types' => $inventory_types));
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
        
        public function post_manage_inventory_types() {
            
                if (Auth::check()) {
                        // Gathering all submitted inputs
                        $input = Input::all();

                        // Setting rules for the validation
                        $rules = array(
                            'inventory_type_name'    =>  'required|unique:inventory_type_master,inventory_type_name'
                        );

                        $messages = array(
                            'required'  => 'We need you to fill the :attribute field.',
                            'unique'    => 'The :attribute you entered already exists!',
                        );

                        $validation = Validator::make($input, $rules, $messages);

                        if ($validation->fails()) {
                                return Redirect::to('admin/dashboard/controls/manage_inventory_types')->with_errors($validation)->with_input('only', 'inventory_type_name');
                        }
                        else {
                                $inventory_type_name = $input['inventory_type_name'];
                                Inventory_Type_Master::create(array('inventory_type_name' => $inventory_type_name));
                                
                                return Redirect::to('admin/dashboard/controls/manage_inventory_types');
                        }
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
        
        public function get_manage_alloted_locations() {
            
                if (Auth::check()) {
                        $data_locations = Location_Master::get();
                        $users = User_Master::with('details')->get();
                    
                        foreach ($data_locations as $data_location) {
                            $locations[$data_location->location_name] = $data_location->location_name;
                        }
                        
                        IoC::resolve('init_assets');        
                        return View::make('admin.manage-alloted-locations')->with(array('locations' => $locations, 'users' => $users));
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
        
        public function post_manage_alloted_locations() {
            
                if (Auth::check()) {
                        // Gathering all submitted inputs
                        $input = Input::all();

                        // Setting rules for the validation
                        $rules = array(
                        );

                        $messages = array(
                        );

                        $validation = Validator::make($input, $rules, $messages);

                        if ($validation->fails()) {
                                return Redirect::to('admin/dashboard/controls/manage_alloted_locations')->with_errors($validation)->with_input('only', 'inventory_type_name');
                        }
                        else {
                                print_r($input);
                                
                                //return Redirect::to('admin/dashboard/controls/manage_alloted_locations');
                        }
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
    
}