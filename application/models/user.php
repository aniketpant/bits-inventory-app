<?php

class User extends Eloquent {
    
        /**
         * Checks if user exists in login_master
         * 
         * @param string $user_name User Name
         * @return bool
         */
    
        public function check_user_exists($user_name) {
            
                $check = DB::table('login_master')->where('user_name', '=', $user_name);
                if ($check) {
                        return TRUE;
                }
                else {
                        return FALSE;
                }
            
        }
    
        /**
         * Creates account for user
         * 
         * @param array $credentials User Credentials
         * @return bool 
         */
    
        public function create_account($credentials) {
            
                $check = $this->check_user_exists($credentials['user_name']);
                
                if ($check) {
                    
                        // Adding data to login_master
                        DB::table('login_master')->insert(array(
                            'user_name' =>  $credentials['user_name'],
                            'password'  =>  $credentials['password'],
                            ));
                            
                        // Retrieving idlogin_master
                        $idlogin_master = $this->get_idlogin_master($credentials['user_name']);
                        
                        // Adding data to user_details
                        $this->add_user_details(array('login_master_idlogin_master' => $idlogin_master));

                        // Retrieving iduser_details
                        $iduser_details = $this->get_iduser_details($credentials['user_name']);

                        // Retrieving id_user_role_master
                        $iduser_role_master = $this->get_iduser_role_master($credentials['role_name']);
                        
                        // Adding data to user_role_details
                        $this->add_user_role_details($iduser_details, $iduser_role_master);
                        
                }
                
                return $check;
            
        }
        
        /**
         * Returns idlogin_master
         * 
         * @param string $user_name User Name
         */
        
        public function get_idlogin_master($user_name) {
            
                $idlogin_master = DB::table('login_master')->where('user_name', '=', $user_name)->only('idlogin_master');
                return $idlogin_master;
            
        }
        
        /**
         * Returns iduser_details
         * 
         * @param string $user_name User Name
         * @return int
         */
        
        public function get_iduser_details($user_name) {
            
                $idlogin_master = $this->get_idlogin_master($user_name);
                $iduser_details = DB::table('user_details')->where('login_master_idlogin_master', '=', $idlogin_master);
                return $iduser_details;
                
        }
        
        /**
         * Returns iduser_role_master
         * 
         * @param string $role_name Role Name
         * @return int
         */
        
        public function get_iduser_role_master($role_name) {
            
                $iduser_role_master = DB::table('roles_master')->where('role_name', '=', $role_name);
                return $iduser_role_master;                
            
        }
        
        /**
         * Adds user role details
         * 
         * @param int $id_user_details ID User Details
         * @param int $id_user_role_master ID User Roles Master
         * @return int
         */
        
        public function add_user_role_details($id_user_details, $id_user_role_master) {
            
                $iduser_role_details = DB::table('user_role_details')->insert_get_id(array(
                    'user_details_iduser_details'           =>  $id_user_details,
                    'user_role_master_iduser_role_master'   =>  $id_user_role_master,
                    ));
                return $iduser_role_details;
            
        }
        
        /**
         * Adds user details
         * @param array $arr Details of user
         * @return int 
         */
        
        public function add_user_details($arr) {
            
                $check = DB::table('user_details')->insert_get_id($arr);
                return $check;
            
        }
    
}