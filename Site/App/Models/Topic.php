<?php

class Topic extends Model
{
    public $table = 'Topics';
    public $columns = array(
        'ID'              => 'ID',
        'Title'           => 'Title',
        'TagLine'         => 'TagLine',
        'CategoryID'      => 'CategoryID',
        'Url'             => 'Url',
        'Type'            => 'Type',
        'Date'            => 'Date',
        'BannerImage'     => 'BannerImage',
        'ArchivesImage'   => 'ArchivesImage',
        'NewsText'        => 'NewsText',
        'HtmlNewsText'    => 'HtmlNewsText',
        'ClosingText'     => 'ClosingText',
        'HtmlClosingText' => 'HtmlClosingText',
        'UseDarkTheme'    => 'UseDarkTheme',
        'Published'       => 'Published',
        'Created'         => 'Created',
        'Modified'        => 'Modified'
    );
    public $primaryKey = 'ID';
    public $one = array(
        'Category' => array('CategoryID' => 'ID')
    );
    public $many = array(
        'Article' => array('ID' => 'TopicID', ':Order' => 'OrderIndex')
    );
    public $validation = array(
        'Title' => array('required'),
        'CategoryID' => array('required'),
        'Url' => array('db-unique', 'required', 'urlsafe'),
        'Type' => array('required', 'oneof' => array('values' => array('Dual', 'Single'))),
        'Date' => array('required', 'datatype' => array('type' => 'date'))
    );
    public $mappings = array(
        'Published' => 'bool',
        'UseDarkTheme' => 'bool'
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
