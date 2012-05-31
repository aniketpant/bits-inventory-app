<?php

class Create_Item_Type_Master {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
                Schema::create('item_type_master', function($table){
                        
                        // auto incremental id(PK)
                        $table->increments('id');
                        
                        // varchar 32
                        $table->string('item_name', '32');
                });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
                Schema::drop('item_type_master');
	}

}