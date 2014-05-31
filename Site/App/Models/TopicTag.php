<?php

class TopicTag extends Model
{
    public $table = 'TopicTags';
    public $columns = array(
        'ID'          => 'ID',
        'TopicID'      => 'TopicID',
        'Tag'         => 'Tag'
    );
    public $primaryKey = 'ID';
    public $one = array(
        'Topic'  => array('TopicID' => 'ID')
    );
    public $many = array(
    );
    public $mappings = array(
    );
    public $validation = array(
        'TopicID' => array('required'),
        'Tag' => array('required')
    );
}

?>
