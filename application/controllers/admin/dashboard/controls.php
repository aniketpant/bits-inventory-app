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

                return View::make('admin.manage-user-roles');
                
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

                return View::make('admin.manage-locations');
                
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

                $user_roles_master = User_Role_Master::get('role_name');
                $user_roles = array();                        
                foreach ($user_roles_master as $user_role) {
                    $user_roles[$user_role->role_name] = $user_role->role_name;
                }

                return View::make('admin.manage-users')->with(array(
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
                        $user_roles = $input['user_roles'];

                        // Credentials for the new user
                        $credentials = array(
                            'user_name'     =>  $user_name,
                            'password'      =>  Hash::make($user_name),
                            'user_roles'    =>  $user_roles,
                            'psrn'          =>  $psrn,
                        );

                        $user = User_Master::create(array(
                            'user_name' =>  $credentials['user_name'],
                            'password'  =>  $credentials['password'],
                            ));

                        $data_user_details = new User_Details(array('psrn' => $credentials['psrn']));
                        
                        $user_details = $user->details()->insert($data_user_details);
                        
                        $user_role_master = User_Role_Master::where_in('role_name', $user_roles)->get();

                        foreach ($user_role_master as $row) {
                            $user_role_details = User_Role_Details::create(array(
                                'user_details_id'       =>  $user_details->id,
                                'user_role_master_id'   =>  $row->id,
                                ));
                        }

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

                return View::make('admin.manage-inventory-types');
                
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
                            
                            $curr_user_role_details_id = $user->role[0]->pivot->id;
                            
                            $curr_user_locs = User_Role_Details::with(array(
                                'location'))->find($curr_user_role_details_id);
                            
                            $existing_locs = array();
                            $new_locs = $input[$key];
                                
                            foreach ($curr_user_locs->location as $curr_user_loc) {
                                array_push($existing_locs, $curr_user_loc->location_name);
                            }
                            
                            $locs_add = array();
                            $locs_del = array();
                            
                            $locs_add = array_diff($new_locs, $existing_locs);
                            $locs_del = array_diff($existing_locs, $new_locs);
                            
                            // Adding new locations
                            if (array_count_values($locs_add)) {
                                foreach ($locs_add as $row) {
                                    $location = Location_Master::where('location_name', '=', $row)->first();

                                    $data = array(
                                        'location_master_id'     => $location->id,
                                        'user_role_details_id'   => $curr_user_role_details_id,
                                    );

                                    array_push($data_location_details, $data);
                                }
                            }
                            
                            // Checking if inventory alloted in that location
                            if (array_count_values($locs_del)) {
                                foreach ($locs_del as $loc_del) {
                                    $location_master = Location_Master::where('location_name', '=', $loc_del)->first();
                                    $location = Location_Details::where('user_role_details_id', '=', $curr_user_role_details_id)->where('location_master_id', '=', $location_master->id)->first();

                                    $check = Inventory_Details::where('location_details_id', '=', $location->id)->count();

                                    if (!$check) {
                                        $location->delete(); // removing location if not alloted
                                    }
                                }
                            }
                        }
                        
                        if (!empty($data_location_details)) {
                            Location_Details::insert($data_location_details);
                        }

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
                            $user_role = User_Role_Master::with(array('inventory_type'))->where('role_name', '=', str_replace('_', ' ', $key))->first();
                            
                            $curr_inventory_types = array();
                            foreach ($user_role->inventory_type as $row) {
                                array_push($curr_inventory_types, $row->inventory_type_name);
                            }
                            
                            $new_inventory_types = $input[$key];
                            
                            $inv_type_add = array();
                            $inv_type_del = array();
                            
                            $inv_type_add = array_diff($new_inventory_types, $curr_inventory_types);
                            $inv_type_del = array_diff($curr_inventory_types, $new_inventory_types);

                            // Adding new inventory types
                            if (array_count_values($inv_type_add)) {
                                foreach ($inv_type_add as $row) {
                                    $inventory_type = Inventory_Type_Master::where('inventory_type_name', '=', $row)->first();

                                    $data = array(
                                        'inventory_type_master_id'  => $inventory_type->id,
                                        'user_role_master_id'       => $user_role->id,
                                    );

                                    array_push($data_inventory_type_details, $data);
                                }
                            }

                            // Deleting inventory types                            
                            if (array_count_values($inv_type_del)) {
                                foreach ($inv_type_del as $row) {
                                    $inventory_type = Inventory_Type_Master::where('inventory_type_name', '=', $row)->first();
                                    $inventory_type_id = $inventory_type->id;
                                    
                                    $inventory_type_details = Inventory_Type_Details::where('user_role_master_id', '=', $user_role->id)->where('inventory_type_master_id', '=', $inventory_type_id)->first();
                                    $inventory_type_details_id = $inventory_type_details->id;
                                    
                                    $check = Inventory_Details::where('inventory_type_details_id', '=', $inventory_type_details_id)->count();
                                    
                                    if (!$check) {
                                        $inventory_type_details->delete(); // removing inventory type if not alloted
                                    }
                                }
                            }
                            
                        }
                        
                        if ($data_inventory_type_details) {
                            Inventory_Type_Details::insert($data_inventory_type_details);
                        }

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
        
        /**
         * Admin/Dashboard/Controls/User_Role_Master
         * Function to get roles of a user via ajax call
         * 
         * @return View
         */
        
        public function get_user_role_master() {
            
                $user_roles = User_Role_Master::get();

                return View::make('admin.get-user-role-master')->with(array(
                    'user_roles' => $user_roles));
                
        }
        
        /**
         * Admin/Dashboard/Controls/Location_Master
         * Function to get locations alloted to a user via ajax call
         * 
         * @return View
         */
        
        public function get_location_master() {
            
                $locations = Location_Master::get();

                return View::make('admin.get-location-master')->with(array(
                    'locations' => $locations));
                
        }
        
        /**
         * Admin/Dashboard/Controls/Inventory_Type_Master
         * Function to get inventory types alloted to a user via ajax call
         * 
         * @return View
         */
        
        public function get_inventory_type_master() {
            
                $inventory_types = Inventory_Type_Master::get();

                return View::make('admin.get-inventory-type-master')->with(array(
                    'inventory_types' => $inventory_types));
                
        }
        
        /**
         * Admin/Dashboard/Controls/User_Master
         * Function to get all users data via ajax call
         * 
         * @return View
         */
        
        public function get_user_master() {
            
                $users = User_Master::with(array('details', 'details.role'))->get();
                $user_roles_master = User_Role_Master::get('role_name');
                
                $user_roles = array();                        
                foreach ($user_roles_master as $user_role) {
                    $user_roles[$user_role->role_name] = $user_role->role_name;
                }
                
                return View::make('admin.get-user-master')->with(array(
                    'users' => $users,
                    'user_roles' => $user_roles));
            
        }
        
        /**
         * Admin/Dashboard/Controls/Update_Master
         * Function to update master records via ajax call
         * 
         * @param string $table Table Name
         */
        
        public function post_update_master() {
            
                $table = Input::get('table');
                $id = Input::get('id');
                $value = Input::get('value');

                switch ($table) {                
                    case 'user_role_master':
                        $user_role_master = User_Role_Master::find($id);
                        $user_role_master->role_name = $value;

                        $check = $user_role_master->save();
                        break;

                    case 'location_master':
                        $location_master = Location_Master::find($id);
                        $location_master->location_name = $value;

                        $check = $location_master->save();

                        break;

                    case 'inventory_type_master':
                        $inventory_type_master = Inventory_Type_Master::find($id);
                        $inventory_type_master->inventory_type_name = $value;

                        $check = $inventory_type_master->save();
                        break;

                    default:
                        break;
                }
                
                if ($check) {
                    return TRUE;
                }
                else {
                    return FALSE;
                }
            
        }
        
        /**
         * Admin/Dashboard/Controls/Upadate_User
         * Function to update user details via ajax call
         * 
         * @return bool
         */
        
        public function post_update_user() {
            
                $id = Input::get('id');
                $user_name = Input::get('user_name');
                $psrn = Input::get('psrn');

                $user = User_Details::find($id);
                $user->psrn = $psrn;
                
                $check = $user->save();
                
                if ($check) {
                    return TRUE;
                }
                else {
                    return FALSE;
                }
            
        }
        
        /**
         * Admin/Dashboard/Controls/Update_Field
         * Function to update specific field via ajax call
         * 
         * @return View
         */
        
        public function post_update_field() {
            
                $field = Input::get('field');
                $message = '';
                    
                if ($field == 'user_role') {
                    $id = Input::get('id');
                    $user_roles = Input::get('user_roles');
                    
                    if (!is_array($user_roles)) {
                        $user_roles = array();
                    }
                    
                    $user = User_Details::with(array(
                        'role'
                        ))->find($id);

                    $roles = array();
                    
                    foreach ($user->role as $role) {
                        array_push($roles, $role->role_name);
                        $location_count[$role->role_name] = Location_Details::where('user_role_details_id', '=', $role->pivot->id)->count();
                    }
                    
                    $arr_add = array();
                    $arr_del = array();
                    $del = null;
                    
                    $arr_add = array_diff($user_roles, $roles);
                    $arr_del = array_diff($roles, $user_roles);
                    
                    foreach ($arr_del as $del) {
                        if (!$location_count[$del]) {
                        }
                        else {
                            $message = $del . ' cannot be deleted.';
                        }
                    }
                    
                }
                
                return View::make('admin.messages')->with(array(
                        'id'        => $id,
                        'message'   => $message,
                        'deleted'   => $del));
                
        }
    
}