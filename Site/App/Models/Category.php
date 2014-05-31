<?php

class Category extends Model
{
    public $table = 'Categories';
    public $columns = array(
        'ID'          => 'ID',
        'Class'       => 'Class',
        'Name'        => 'Name'
    );
    public $primaryKey = 'ID';
    public $one = array(
    );
    public $many = array(
        'News'  => array('ID' => 'CategoryID'),
        'Topic'  => array('ID' => 'CategoryID')
    );
    public $mappings = array(
    );
    public $validation = array(
        'Class' => array('required'),
        'Name' => array('required')
    );
}

?>
