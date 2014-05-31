<?php

include 'App/Helpers/Vars.php';
include 'Phoenix/Phoenix.php';

Router::$default_controller = 'Home';
Router::$default_action = 'Index';
Templating::$master_page = 'Shared/Master';
Phoenix::$app_dir = realpath(dirname(__FILE__)).'/App';
Phoenix::$base_url = '/ix/';

Phoenix::$debug = true;
Phoenix::$debug_user = null;

// TODO: Deployment - change dirs
Vars::$banners_dir = 'C:\\xampp\\htdocs\\ix\\Content\\Banners\\';
Vars::$news_dir = 'C:\\xampp\\htdocs\\ix\\Content\\News\\';

// TODO: Deployment - change passwords
Database::$type = 'mysql';
Database::$host = 'localhost';
Database::$database = 'ix';
Database::$username = 'root';
Database::$password = '';
Database::Enable();

Authentication::$session_id = 'phoenix_login';
Authentication::$autologin = true;
Authentication::$useopenid = true;
Authentication::$openid_host = 'invert-x.com';
Authentication::$emailrequired = true;
Authentication::$emailconfirmation = false;

Authentication::$model = 'User';
Authentication::$field_id = 'ID';
Authentication::$field_username = 'Name';
Authentication::$field_password = 'Password';
Authentication::$field_email = 'Email';
Authentication::$field_openid = 'OpenID';
Authentication::$field_cookie = 'Cookie';
Authentication::$field_numlogins = null;
Authentication::$field_lastlogin = null;
Authentication::$field_lastaccess = null;
Authentication::$field_lastpage = null;
Authentication::$field_ip = null;
Authentication::$field_unlocker = null;

Authentication::$cookie_id = 'phoenix_username';
Authentication::$cookie_code = 'phoenix_code';
Authentication::$cookie_timeout = 30000000;

Authentication::$post_username = 'username';
Authentication::$post_password = 'password';
Authentication::$post_password_confirm = 'password_confirm';
Authentication::$post_remember = 'remember';
Authentication::$post_logout = 'logout';
Authentication::$post_email = 'email';
Authentication::$post_openid = 'openid';
Authentication::$post_register = 'register';

// TODO: Deployment - change salt values
// I have since found out that hard-coded salt like this is known as "pepper", and real salts are stored in the database
Authentication::RegisterPasswordHasher(new AlgorithmHasher('sha256', 'SALT_PREPEND', 'SALT_APPEND'));
//Authentication::Enable();

// TODO: Deployment - set authorisation method
//Authorisation::SetAuthorisationMethod(new LoggedInAuthorisation());

Router::MapRoute("{controller}/{action}/{*}");
Router::MapRegexRoute("%^([^/]{1,})/?$%", array('controller' => 'Home', 'action' => 'Article', 'params' => 1));
Router::MapRoute("{*controller}/{*action}/{*}", array('controller' => 'Home', 'action' => 'Index'));

Phoenix::Run();

?>
