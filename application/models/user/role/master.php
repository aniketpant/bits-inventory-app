<?php

class User_Role_Master extends Eloquent {
    
        public static $table = 'user_role_master';
        public static $timestamps = false;
        
        public function inventory() {
                return $this->has_many_and_belongs_to('Inventory_Type_Master', 'inventory_type_details');
        }
    
}