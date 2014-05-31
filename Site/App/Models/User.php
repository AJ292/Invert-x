<?php

class User extends Model
{
    public $table = 'Users';
    public $columns = array(
        'ID'         => 'ID',
        'Name'       => 'Name',
        'Password'   => 'Password',
        'OpenID'     => 'OpenID',
        'Cookie'     => 'Cookie',
        'AvatarImage'=> 'AvatarImage',
        'NumLogins'  => 'NumLogins',
        'LastLogin'  => 'LastLogin',
        'LastAccess' => 'LastAccess',
        'LastPage'   => 'LastPage',
        'IP'         => 'IP',
        'Created'    => 'Created',
        'Modified'   => 'Modified'
    );
    public $primaryKey = 'ID';
    public $one = array(
        'UserRole' => array('RoleID' => 'ID')
    );
    public $many = array(
        'Blog' => array('ID' => 'UserID')
    );
    public $validation = array(
        'Name' => array(
            'required',
            'db-unique'
        ),
        'Password' => array('required'),
        'Created' => array('required')
    );

    protected function BeforeInsert()
    {
        $this->Created = Date::Now();
        $this->Modified = Date::Now();
    }

    protected function BeforeUpdate()
    {
    }
}

?>
