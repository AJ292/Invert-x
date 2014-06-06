<?php

class News extends Model
{
    public $table = 'News';
    public $columns = array(
        'ID'          => 'ID',
        'UserID'      => 'UserID',
        'CategoryID'  => 'CategoryID',
        'SectionID'   => 'SectionID',
        'Heading'     => 'Heading',
        'Image'       => 'Image',
        'Summary'     => 'Summary',
        'HtmlSummary' => 'HtmlSummary',
        'Content'     => 'Content',
        'HtmlContent' => 'HtmlContent',
        'Created'     => 'Created',
        'Modified'    => 'Modified'
    );
    public $primaryKey = 'ID';
    public $one = array(
        'User'     => array('UserID' => 'ID'),
        'Category' => array('CategoryID' => 'ID')
    );
    public $many = array(
    );
    public $mappings = array(
    );
    public $validation = array(
        //'UserID' => array('required'),
        'CategoryID' => array('required'),
        'SectionID' => array('required'),
        'Heading' => array('required'),
        'Image' => array('required'),
        'Summary' => array('required'),
        'Content' => array('required')
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
