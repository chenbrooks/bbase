<?php


include_once $_SERVER['DOCUMENT_ROOT'].'/models/BaseModel.php';
/**
 *
 */
class ReviewModel extends BaseModel
{
    
    function __construct()
    {
        $this->_DB_TABLE_NAME = 'review';
        $this->_MODEL = array('id','title','type','content','authorid','authorname','created_at','updated_at');
        parent::__construct();
      # code...
    }
    
	
}

?>