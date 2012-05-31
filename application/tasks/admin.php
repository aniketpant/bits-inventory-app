<?php

class Admin_Task {
    
        public function init_admin() {
            
                // Initialising new Admin Model
                $admin = new Admin();
                
                // Adding new user role
                $check = $admin->add_user_role('Administrator');
                
                if ($check) {
                        echo 'User Role added successfully!';
                        return TRUE;
                }
                else {
                        echo 'User Role adding failed.';
                        return FALSE;
                }
            
        }
    
        public function create_account() {

                // Initialising new User Model
                $user = new User();
                
                // Configuring credentials for admin account
                $credentials = array(
                    'user_name' =>  'admin',
                    'password'  =>  Hash::make('admin'),
                    'role_name' =>  'Administrator',
                );
                
                // Adding administrator account
                $check = $user->create_account($credentials);
                
                if ($check) {
                        echo 'Account successfully created!';
                        return TRUE;
                }
                else {
                        echo 'Account creation failed.';
                        return FALSE;
                }

        }
    
}