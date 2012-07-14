<?php

class User_Master extends Eloquent {
    
        public static $table = 'user_master';
        public static $hidden = array('password');
        public static $timestamps = true;
        
        public function details() {
                return $this->has_one('User_Details');
        }
    
}