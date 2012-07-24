<?php

class Admin_Dashboard_Base_Controller extends Base_Controller {
    
        public $restful = true;
        
        /**
         * Admin/Dashboard
         * 
         * @return View
         */
                
        public function get_index() {
            
                $stats['users'] = User_Master::count();
                $stats['locations'] = Location_Master::count();
                $stats['inventory_types'] = Inventory_Type_Master::count();

                return View::make('admin.dashboard')->with('stats', $stats);
            
        }
    
}