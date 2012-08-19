<?php

class Common_Controller extends Base_Controller {
    
        public $restful = true;
        
        /**
         * Common/Search
         * Function called via ajax call
         * 
         * @return View
         */
        
        public function post_search() {
                        
                $username = Input::get('username');
            
                $users = User_Master::with(array(
                    'details'))->where('user_name', 'like', '%' . $username . '%')->get();
                return View::make('common.search-results')->with(array('users' => $users));
        }
        
        /**
         * Common/Basic_Data
         * Function called via ajax call
         * 
         * @return View
         */
        
        public function post_basic_data() {
            
                $id = Input::get('id');
            
                $user_data = User_Details::with(array(
                    'location',
                    'role'))->find($id);
                $roles = $user_data->role;
                $locations = $user_data->location;

                return View::make('common.user-basic-data')->with(array(
                    'locations' => $locations,
                    'roles' => $roles));
            
        }
        
        /**
         * Common/User_Roles
         * Function called via ajax call
         * 
         * @return View
         */
        
        public function post_user_roles() {
            
                $id = Input::get('id');
                
                $roles = User_Role_Master::with(array(
                    'details' => function($query) use ($id) {
                        $query->where('user_details_id', '=', $id);}))->get();
                
                return View::make('common.user-roles-data')->with(array(
                    'roles' => $roles));
                
        }
        
        /**
         * Common/Alloted_Locations
         * Function called via ajax call
         * 
         * @return View
         */
        
        public function post_alloted_locations() {
                
                $user_type = Input::get('user_type');
                $user_details_id = Input::get('id');
            
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
                
                if ($user_type == 'admin') {
                    return View::make('common.admin-alloted-locations')->with(array(
                        'user' => $user,
                        'user_roles' => $user_roles,
                        'locations' => $locations,
                        'user_role_locations' => $user_role_locations));
                }
                elseif ($user_type == 'user') {
                    return View::make('common.user-alloted-locations')->with(array(
                        'user' => $user,
                        'user_roles' => $user_roles,
                        'locations' => $locations,
                        'user_role_locations' => $user_role_locations));
                }
        
        }
        
        /**
         * Common/Alloted_Inventory
         * Function to retrieve alloted inventory via ajax call
         *
         * @param int $user_details_id user_details_id
         * @param int $user_role_master_id user_role_master_id
         * @param int $user_role_details_id user_role_details_id
         * @return View
         */
                
        public function post_alloted_inventory($user_details_id, $user_role_master_id, $user_role_details_id) {
            
                $user_type = Input::get('user_type');
                
                $user_role_master = User_Role_Master::with(array(
                    'inventory_type'))->find($user_role_master_id);
                    
                $user_role_details = User_Role_Details::with(array(
                    'location'))->find($user_role_details_id);
                
                $user_locations = array();
                $user_inventory_types = array();
                $arr_location_details_id = array();

                // locations
                foreach ($user_role_details->location as $row) {
                    array_push($arr_location_details_id, $row->pivot->id);
                    array_push($user_locations, $row);
                }
                
                // inventory_types
                foreach ($user_role_master->inventory_type as $row) {
                    array_push($user_inventory_types, $row);
                }
                
                $inventory = array();
                
                if (array_count_values($arr_location_details_id)) {
                    $inventory_data = Inventory_Details::where_in('location_details_id', $arr_location_details_id)->get();
                
                    // inventory
                    foreach ($inventory_data as $row) {
                        $inventory[$row->location_details_id][$row->inventory_type_details_id] = $row->value;
                    }
                }
                
                if ($user_type == 'admin') {
                    return View::make('common.admin-alloted-inventory')->with(array(
                        'user_locations' => $user_locations,
                        'user_inventory_types' => $user_inventory_types,
                        'inventory' => $inventory));
                }
                elseif ($user_type == 'user') {
                    return View::make('common.user-alloted-inventory')->with(array(
                        'user_locations' => $user_locations,
                        'user_inventory_types' => $user_inventory_types,
                        'inventory' => $inventory));
                }
                
        }
    
}