<?php

class Admin_Dashboard_Controls_Controller extends Base_Controller {
    
        public $restful = true;
        
        /**
         * get_index
         * Returns the controls page if Authentication successful
         */
        
        public function get_index() {
            
                return View::make('admin.controls');
            
        }
        
        /**
         * get_manage_user_roles
         * Returns the manage-user-roles page if Authentication successful
         */
        
        public function get_manage_user_roles() {
            
                $user_roles = User_Role_Master::get();

                return View::make('admin.manage-user-roles')->with(array('user_roles' => $user_roles));
                
        }
        
        /**
         * post_manage_user_roles
         * Stores the input user_role in the database
         */
        
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
        
        /**
         * get_manage_locations
         * Returns the manage-locations page if Authentication successful
         */
        
        public function get_manage_locations() {
            
                if (Auth::check()) {
                        $locations = Location_Master::get();
                        
                        return View::make('admin.manage-locations')->with(array('locations' => $locations));
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
        
        /**
         * post_manage_locations
         * Stores the input location in the database
         */
        
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
        
        /**
         * get_manage_users
         * Returns the manage-users page if Authentication successful
         */
        
        public function get_manage_users() {
            
                if (Auth::check()) {
                        $users = User_Master::with(array('details', 'details.role'))->get();
                        
                        $user_roles_master = User_Role_Master::get('role_name');
                        $user_roles = array();                        
                        foreach ($user_roles_master as $user_role) {
                            $user_roles[$user_role->role_name] = $user_role->role_name;
                        }
                        
                        return View::make('admin.manage-users')->with(array('users' => $users, 'user_roles' => $user_roles));
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
        
        /**
         * post_manage_users
         * Stores the input user data in the database
         */
        
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
        
        /**
         * get_manage_inventory_types
         * Returns the manage-inventory-types page if Authentication successful
         */
        
        public function get_manage_inventory_types() {
            
                if (Auth::check()) {
                        $inventory_types = Inventory_Type_Master::get();
                        
                        return View::make('admin.manage-inventory-types')->with(array('inventory_types' => $inventory_types));
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
        
        
        /**
         * post_manage_inventory_types
         * Stores the input inventory_type in the database
         */
        
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
        
        /**
         * get_manage_alloted_locations
         * Returns the manage-alloted-locations page if Authentication successful
         */
        
        public function get_manage_alloted_locations() {
            
                if (Auth::check()) {
                        $data_locations = Location_Master::get();
                        $users = User_Master::with(array('details', 'details.location'))->get();
                    
                        foreach ($data_locations as $data_location) {
                            $locations[$data_location->location_name] = $data_location->location_name;
                        }
                        
                        $user_location = array();
                        
                        foreach ($users as $user) {
                            $location_name = array();
                            foreach ($user->details->location as $row) {
                                array_push($location_name, $row->location_name);
                            }
                            
                            $user_location[$user->user_name] = $location_name;
                            
                        }
                        
                        return View::make('admin.manage-alloted-locations')->with(array('locations' => $locations, 'users' => $users, 'user_location' => $user_location));
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
        
        /**
         * post_manage_alloted_location
         * Stores the input related data for user and location in the database
         */
        
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
                                $keys = array_keys($input);
                                $data_location_details = array();
                                foreach ($keys as $key) {
                                    $user = User_Master::with(array('details'))->where('user_name', '=', $key)->first();
                                    foreach ($input[$key] as $row) {
                                        $location = Location_Master::where('location_name', '=', $row)->first();
                                        
                                        $data = array(
                                           'location_master_id'     => $location->id,
                                            'user_details_id'       => $user->details->id,
                                        );
                                        
                                        array_push($data_location_details, $data);
                                    }
                                }
                                Location_Details::insert($data_location_details);
                                
                                return Redirect::to('admin/dashboard/controls/manage_alloted_locations');
                        }
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
        
        /**
         * get_manage_alloted_inventory_types
         * Returns the manage-alloted-inventory-types page if Authentication successful
         */
        
        public function get_manage_alloted_inventory_types() {
            
                if (Auth::check()) {
                        $data_inventory_types = Inventory_Type_Master::get();
                        $user_roles = User_Role_Master::with(array('inventory'))->get();
                    
                        foreach ($data_inventory_types as $data_inventory_type) {
                            $inventory_types[$data_inventory_type->inventory_type_name] = $data_inventory_type->inventory_type_name;
                        }
                        
                        $user_role_inventory_types = array();
                        
                        foreach ($user_roles as $user_role) {
                            $user_role_inventory_type = array();
                            foreach ($user_role->inventory as $row) {
                                array_push($user_role_inventory_type, $row->inventory_type_name);
                            }
                            
                            $user_role_inventory_types[$user_role->role_name] = $user_role_inventory_type;
                            
                        }
                        
                        return View::make('admin.manage-alloted-inventory-types')->with(array('user_roles' => $user_roles, 'inventory_types' => $inventory_types, 'user_role_inventory_types' => $user_role_inventory_types));
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
        
        /**
         * post_manage_alloted_inventory_types
         * Stores the input related data for user_role and inventory_type in the database
         */
        
        public function post_manage_alloted_inventory_types() {
            
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
                                return Redirect::to('admin/dashboard/controls/manage_alloted_inventory_types')->with_errors($validation)->with_input('only', 'inventory_type_name');
                        }
                        else {
                                $keys = array_keys($input);
                                $data_inventory_type_details = array();
                                
                                foreach ($keys as $key) {
                                    $user_role = User_Role_Master::where('role_name', '=', str_replace('_', ' ', $key))->first();
                                    
                                    foreach ($input[$key] as $row) {
                                        $inventory_type = Inventory_Type_Master::where('inventory_type_name', '=', $row)->first();
                                        
                                        $data = array(
                                            'inventory_type_master_id'  => $inventory_type->id,
                                            'user_role_master_id'       => $user_role->id,
                                        );
                                        
                                        array_push($data_inventory_type_details, $data);
                                    }
                                }
                                Inventory_Type_Details::insert($data_inventory_type_details);
                                
                                return Redirect::to('admin/dashboard/controls/manage_alloted_inventory_types');
                        }
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
        
        /**
         * get_manage_alloted_inventory
         * Returns the manage-alloted-inventory page if Authentication successful
         */
        
        public function get_manage_alloted_inventory() {
            
                if (Auth::check()) {
                        $users = User_Master::with('details')->get();
                    
                        return View::make('admin.manage-alloted-inventory')->with(array('users' => $users));
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
        
        /**
         * post_manage_alloted_inventory
         * Stores the input related data for users and alloted inventory in the database
         */
        
        public function post_manage_alloted_inventory() {
            
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
                                return Redirect::to('admin/dashboard/controls/manage_alloted_inventory')->with_errors($validation)->with_input('only', 'inventory_type_name');
                        }
                        else {
                                return Redirect::to('admin/dashboard/controls/manage_alloted_inventory');
                        }
                }
                else {
                        return Redirect::to('admin/login');
                }
                
        }
        
        public function get_user_locations($id) {
            
                echo $id;
                return;
            
        }
    
}