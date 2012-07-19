<?php

class User_Role_Details extends Eloquent {
    
        public static $table = 'user_role_details';
        public static $timestamps = false;
    
        public function master() {
                return $this->belongs_to('User_Role_Master', 'user_role_master');
        }
        
        public function location() {
                return $this->has_many_and_belongs_to('Location_Master', 'location_details');
        }
    
}