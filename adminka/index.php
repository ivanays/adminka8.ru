<?php
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/magicquotes.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';

   $role_1 = '';
   $role_2 = '';
   $role_3 = '';
   
   $role_1 = 'superadmin';
   $role_2 = 'moderator';
   $role_3 = 'anonim';
   

if (!userIsLoggedIn())
{
	include '../index.php';
	exit();
}

if (userHasRole($role_1))
{
	include './superadmin.php';
	exit();
}

elseif (userHasRole($role_2))
{
	include './moderator.php';
	exit();
} else 

{
	include '../index.php';
	exit();	
}

?>