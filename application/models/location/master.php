<?php

class Location_Master extends Eloquent {
    
        public static $table = 'location_master';
        public static $timestamps = false;
        
        public function details() {
                return $this->has_many_and_belongs_to('User_Role_Details', 'user_role_details');
        }
    
}