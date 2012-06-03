<?php

class Admin_Task {
    
        public function init() {
            
                $check = User_Role_Master::create(array('role_name' => 'Administrator'));
                $check = $this->create_account();
                
                if ($check) {
                        echo 'Admin account successfully initialised!';
                        return TRUE;
                }
                else {
                        echo 'Initialisation failed.';
                        return FALSE;
                }
            
        }
    
        private function create_account() {
                
                // Configuring credentials for admin account
                $credentials = array(
                    'user_name' =>  'admin',
                    'password'  =>  Hash::make('admin'),
                    'role_name' =>  'Administrator',
                );
                
                $check = false;
                
                $user_master = User_Master::create(array(
                    'user_name' => $credentials['user_name'],
                    'password' => $credentials['password'],
                    ));
                
                $user_master_id = $user_master->id;
                
                if ($user_master_id) {
                    
                        $user_details = User_Details::create(array('user_master_id' => $user_master_id));
                        $user_details_id = $user_details->id;
                        
                        if ($user_details_id) {
                            
                                $user_role_master = User_Role_Master::where('role_name', '=', $credentials['role_name'])->first();
                                $user_role_master_id = $user_role_master->id;
                                
                                $user_role_details = User_Role_Details::create(array(
                                    'user_details_id' => $user_details_id,
                                    'user_role_master_id' => $user_role_master_id,
                                    ));
                                
                                $check = true;
                        }
                        
                }
                
                if ($check) {
                        return TRUE;
                }
                else {
                        return FALSE;
                }

        }
    
}