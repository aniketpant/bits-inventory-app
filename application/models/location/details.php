<?php

class Location_Details extends Eloquent {
    
        public static $table = 'location_details';
        public static $timestamps = false;
        
        public function user() {
                return $this->has_many_and_belongs_to('User_Role_Details', 'user_role_details');
        }
        
}