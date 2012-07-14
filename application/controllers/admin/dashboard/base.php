<?php

class Admin_Dashboard_Base_Controller extends Base_Controller {
    
        public $restful = true;
                
        public function get_index() {
            
                if (Auth::check()) {
                        $stats['users'] = User_Master::count();
                        $stats['locations'] = Location_Master::count();
                        $stats['inventory_types'] = Inventory_Type_Master::count();
                    
                        IoC::resolve('init_assets');
                        return View::make('admin.dashboard')->with('stats', $stats);
                }
                else {
                        return Redirect::to('admin/login');
                }
            
        }
    
}