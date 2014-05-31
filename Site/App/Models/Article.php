<?php

class Article extends Model
{
    public $table = 'Articles';
    public $columns = array(
        'ID'          => 'ID',
        'TopicID'     => 'TopicID',
        'UserID'      => 'UserID',
        'TagLine'     => 'TagLine',
        'Content'     => 'Content',
        'HtmlContent' => 'HtmlContent',
        'OrderIndex'  => 'OrderIndex',
        'Ready'       => 'Ready',
        'Created'     => 'Created',
        'Modified'    => 'Modified'
    );
    public $primaryKey = 'ID';
    public $one = array(
        'Topic' => array('TopicID' => 'ID'),
        'User'  => array('UserID' => 'ID')
    );
    public $many = array(
    );
    public $mappings = array(
        'Ready' => 'bool'
    );
    public $validation = array(
        'TopicID' => array('required'),
        'UserID' => array('required'),
        'Content' => array('required'),
        'Created' => array('required')
    );

    protected function BeforeInsert()
    {
        $this->Created = Date::Now();
        $this->Modified = Date::Now();
    }

    protected function BeforeUpdate()
    {
        $this->Modified = Date::Now();
    }
}

?>
