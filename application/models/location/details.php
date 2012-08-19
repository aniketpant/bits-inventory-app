<?php

class Location_Details extends Eloquent {
    
        public static $table = 'location_details';
        public static $timestamps = false;
        
        public function master() {
                return $this->belongs_to('Location_Master', 'location_master');
        }
        
}