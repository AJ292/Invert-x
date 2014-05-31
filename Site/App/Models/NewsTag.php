<?php

class NewsTag extends Model
{
    public $table = 'NewsTags';
    public $columns = array(
        'ID'          => 'ID',
        'NewsID'      => 'NewsID',
        'Tag'         => 'Tag'
    );
    public $primaryKey = 'ID';
    public $one = array(
        'News'  => array('NewsID' => 'ID')
    );
    public $many = array(
    );
    public $mappings = array(
    );
    public $validation = array(
        'NewsID' => array('required'),
        'Tag' => array('required')
    );
}

?>
