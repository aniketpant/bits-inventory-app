<?php

class Inventory_Type_Details extends Eloquent {
    
        public static $table = 'inventory_type_details';
        public static $timestamps = false;
        
        public function role() {
                return $this->has_many_and_belongs_to('User_Role_Master', 'user_role_master');
        }
        
}