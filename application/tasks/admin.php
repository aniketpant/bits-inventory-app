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
                
                $login_master = Login_Master::create(array(
                    'user_name' => $credentials['user_name'],
                    'password' => $credentials['password'],
                    ));
                
                $login_master_idlogin_master = $login_master->id;
                
                if ($login_master_idlogin_master) {
                    
                        $user_details = User_Details::create(array('login_master_idlogin_master' => $login_master_idlogin_master));
                        $iduser_details = $user_details->id;
                        
                        if ($iduser_details) {
                            
                                $user_role_master = User_Role_Master::where('role_name', '=', $credentials['role_name'])->first();
                                $iduser_role_master = $user_role_master->id;
                                
                                $user_role_details = User_Role_Details::create(array(
                                    'user_details_iduser_details' => $iduser_details,
                                    'user_role_master_iduser_role_master' => $iduser_role_master,
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