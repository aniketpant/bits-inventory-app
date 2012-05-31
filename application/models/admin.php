<?php

class Admin extends Eloquent {
    
        /**
         * Insert user role type to user_role_master
         * 
         * @param string $role_name Role Name
         * @return bool
         */
    
        public function add_user_role($role_name) {
            
                $check = DB::table('user_role_master')->insert(array('role_name' => $role_name));
                return $check;
            
        }
    
}