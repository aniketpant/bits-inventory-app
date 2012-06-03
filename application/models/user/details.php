<?php

class User_Details extends Eloquent {
    
        public static $table = 'user_details';
        public static $timestamps = false;
        
        public function user_role() {
                return $this->has_many_and_belongs_to('User_Role_Master', 'user_role_details');
        }
    
}