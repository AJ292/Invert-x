<?php

class NewsSection extends Model
{
    public $table = 'NewsSection';
    public $columns = array(
        'ID'          => 'ID',
        'Name'        => 'Name'
    );
    public $primaryKey = 'ID';
    public $one = array(
    );
    public $many = array(
        'News'     => array('SectionID' => 'ID')
    );
    public $mappings = array(
    );
    public $validation = array(
        'Name' => array('required')
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
