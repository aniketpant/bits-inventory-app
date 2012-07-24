<?php

class Admin_Dashboard_Controls_Controller extends Base_Controller {
    
        public $restful = true;
        
        /**
         * Admin/Dashoard/Controls
         * Returns the controls page if Authentication successful
         * 
         * @return View
         */
        
        public function get_index() {
            
                return View::make('admin.controls');
            
        }
        
        /**
         * Admin/Dashoard/Controls/Manage_User_Roles
         * Returns the manage-user-roles page if Authentication successful
         * 
         * @return View
         */
        
        public function get_manage_user_roles() {
            
                $user_roles = User_Role_Master::get();

                return View::make('admin.manage-user-roles')->with(array(
                    'user_roles' => $user_roles));
                
        }
        
        /**
         * Admin/Dashoard/Controls/Manage_User_Roles
         * Stores the input user_role in the database
         * 
         * @return View
         */
        
        public function post_manage_user_roles() {
            
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
        
        /**
         * Admin/Dashoard/Controls/Manage_Locations
         * Returns the manage-locations page if Authentication successful
         * 
         * @return View
         */
        
        public function get_manage_locations() {
            
                $locations = Location_Master::get();

                return View::make('admin.manage-locations')->with(array(
                    'locations' => $locations));
                
        }
        
        /**
         * Admin/Dashoard/Controls/Manage_Locations
         * Stores the input location in the database
         * 
         * @return View
         */
        
        public function post_manage_locations() {
            
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
        
        /**
         * Admin/Dashoard/Controls/Manage_Users
         * Returns the manage-users page if Authentication successful
         * 
         * @return View
         */
        
        public function get_manage_users() {
            
                $users = User_Master::with(array('details', 'details.role'))->get();

                $user_roles_master = User_Role_Master::get('role_name');
                $user_roles = array();                        
                foreach ($user_roles_master as $user_role) {
                    $user_roles[$user_role->role_name] = $user_role->role_name;
                }

                return View::make('admin.manage-users')->with(array(
                    'users' => $users,
                    'user_roles' => $user_roles));
                
        }
        
        /**
         * Admin/Dashoard/Controls/Manage_Users
         * Stores the input user data in the database
         * 
         * @return View
         */
        
        public function post_manage_users() {
            
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
        
        /**
         * Admin/Dashoard/Controls/Manage_Inventgory_Types
         * Returns the manage-inventory-types page if Authentication successful
         * 
         * @return View
         */
        
        public function get_manage_inventory_types() {
            
                $inventory_types = Inventory_Type_Master::get();

                return View::make('admin.manage-inventory-types')->with(array(
                    'inventory_types' => $inventory_types));
                
        }
        
        /**
         * Admin/Dashoard/Controls/Manage_Inventgory_Types
         * Stores the input inventory_type in the database
         * 
         * @return View
         */
        
        public function post_manage_inventory_types() {
            
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
        
        /**
         * Admin/Dashoard/Controls/Manage_Alloted_Locations
         * Returns the manage-alloted-locations page if Authentication successful
         * 
         * @return View
         */
        
        public function get_manage_alloted_locations() {
            
                return View::make('admin.manage-alloted-locations');
                
        }
        
        /**
         * Admin/Dashoard/Controls/Manage_Alloted_Locations
         * Stores the input related data for user and location in the database
         * 
         * @return View
         */
        
        public function post_manage_alloted_locations() {
            
                // Gathering all submitted inputs
                $input = Input::except('user_details_id');

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
                        $user_details_id = Input::get('user_details_id');
                        $keys = array_keys($input);
                        
                        $data_location_details = array();
                        foreach ($keys as $key) {
                            $user = User_Details::with(array('role' => function($query) {
                                $query->where('role_name', '=', $key);
                            }))->find($user_details_id);
                            
                            foreach ($input[$key] as $row) {
                                $location = Location_Master::where('location_name', '=', $row)->first();

                                $data = array(
                                    'location_master_id'     => $location->id,
                                    'user_role_details_id'   => $user->role[0]->pivot->id,
                                );

                                array_push($data_location_details, $data);
                            }
                        }
                        
                        print_r($data_location_details);
                        
                        Location_Details::insert($data_location_details);

                        return Redirect::to('admin/dashboard/controls/manage_alloted_locations');
                }
                
        }
        
        /**
         * Admin/Dashoard/Controls/Manage_Alloted_Inventory_Types
         * Returns the manage-alloted-inventory-types page if Authentication successful
         * 
         * @return View
         */
        
        public function get_manage_alloted_inventory_types() {
            
                $data_inventory_types = Inventory_Type_Master::get();
                $user_roles = User_Role_Master::with(array('inventory_type'))->get();

                foreach ($data_inventory_types as $data_inventory_type) {
                    $inventory_types[$data_inventory_type->inventory_type_name] = $data_inventory_type->inventory_type_name;
                }

                $user_role_inventory_types = array();

                foreach ($user_roles as $user_role) {
                    $user_role_inventory_type = array();
                    foreach ($user_role->inventory_type as $row) {
                        array_push($user_role_inventory_type, $row->inventory_type_name);
                    }

                    $user_role_inventory_types[$user_role->role_name] = $user_role_inventory_type;

                }

                return View::make('admin.manage-alloted-inventory-types')->with(array('user_roles' => $user_roles, 'inventory_types' => $inventory_types, 'user_role_inventory_types' => $user_role_inventory_types));
                
        }
        
        /**
         * Admin/Dashoard/Controls/Manage_Alloted_Inventory_Types
         * Stores the input related data for user_role and inventory_type in the database
         * 
         * @return View
         */
        
        public function post_manage_alloted_inventory_types() {
            
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
        
        /**
         * Admin/Dashoard/Controls/Manage_Alloted_Inventory
         * Returns the manage-alloted-inventory page if Authentication successful
         * 
         * @return View
         */
        
        public function get_manage_alloted_inventory() {
            
                return View::make('admin.manage-alloted-inventory');
            
        }
        
        /**
         * Admin/Dashoard/Controls/Manage_Alloted_Inventory
         * Stores the input related data for users and alloted inventory in the database
         * 
         * @return View
         */
        
        public function post_manage_alloted_inventory() {
            
                // Gathering all submitted inputs
                $input = Input::get('inventory_data');

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
                        $keys1 = array_keys($input);
                        $arr_data = array();
                        $arr_row = array();
                        foreach ($keys1 as $key1) {
                            $keys2 = array_keys($input[$key1]);
                            foreach ($keys2 as $key2) {
                                $arr_row['location_details_id'] = $key1;
                                $arr_row['inventory_type_details_id'] = $key2;
                                $arr_row['value'] = $input[$key1][$key2];
                                array_push($arr_data, $arr_row);
                            }
                        }
                        
                        Inventory_Details::insert($arr_data);
                        
                        return Redirect::to('admin/dashboard/controls/manage_alloted_inventory');
                }
                
        }
        
        public function get_search($username) {
            
                $users = User_Master::with(array(
                    'details'))->where('user_name', 'like', '%' . $username . '%')->get();
                return View::make('admin.search-results')->with(array('users' => $users));
        }
        
        public function get_basic_data($id) {
            
                $user_data = User_Details::with(array(
                    'location',
                    'role'))->find($id);
                $roles = $user_data->role;
                $locations = $user_data->location;

                return View::make('admin.user-basic-data')->with(array(
                    'locations' => $locations,
                    'roles' => $roles));
            
        }
        
        public function get_user_roles($id) {
                
                $roles = User_Role_Master::with(array(
                    'details' => function($query) use ($id) {
                        $query->where('user_details_id', '=', $id);}))->get();
                
                return View::make('admin.user-roles-data')->with(array(
                    'roles' => $roles));
                
        }
        
        public function get_alloted_locations($user_details_id) {
            
                $data_locations = Location_Master::get();
                
                $user = User_Details::with(array(
                    'role',
                    'role.location'))->find($user_details_id);

                foreach ($data_locations as $data_location) {
                    $locations[$data_location->location_name] = $data_location->location_name;
                }

                $user_role_details = User_Role_Details::with(array(
                    'master',
                    'location'))->where('user_details_id', '=', $user->id)->get();

                $user_roles = array();
                $user_role_locations = array();
                $data_user_role_locations = array();

                foreach ($user_role_details as $user_role_detail) {
                    $user_role = User_Role_Master::find($user_role_detail->user_role_master_id);
                    foreach ($user_role_detail->location as $location) {
                        array_push($data_user_role_locations, $location->location_name);
                    }
                    $user_role_locations[$user_role->role_name] = $data_user_role_locations;
                }

                foreach ($user->role as $row) {
                    array_push($user_roles, $row->role_name);
                }

                return View::make('admin.user-alloted-locations')->with(array(
                    'user' => $user,
                    'user_roles' => $user_roles,
                    'locations' => $locations,
                    'user_role_locations' => $user_role_locations));
        
        }
                
        public function get_alloted_inventory($user_details_id, $user_role_master_id, $user_role_details_id) {
            
                $user_role_master = User_Role_Master::with(array(
                    'inventory_type'))->find($user_role_master_id);
                    
                $user_role_details = User_Role_Details::with(array(
                    'location'))->find($user_role_details_id);
                
                $user_locations = array();
                $user_inventory_types = array();
                $arr_location_details_id = array();

                // Printing locations
                foreach ($user_role_details->location as $row) {
                    array_push($arr_location_details_id, $row->id);
                    array_push($user_locations, $row);
                }
                
                echo '<br/>';
                
                // Printing inventory_types
                foreach ($user_role_master->inventory_type as $row) {
                    array_push($user_inventory_types, $row);
                }
                
                $inventory_data = Inventory_Details::where_in('location_details_id', $arr_location_details_id)->get();
                
                $inventory = array();
                
                foreach ($inventory_data as $row) {
                    $inventory[$row->location_details_id][$row->inventory_type_details_id] = $row->value;
                }
                
                return View::make('admin.user-alloted-inventory')->with(array(
                    'user_locations' => $user_locations,
                    'user_inventory_types' => $user_inventory_types,
                    'inventory' => $inventory));
                
        }
    
}