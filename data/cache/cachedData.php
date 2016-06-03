<?php

$cachedRoles=[];
$cachedPermissions=[];
$cachedPermissionsGroup=[];
$cachedRolesGroup=[];

require(__DIR__ . '/cachedRoles.php');
require(__DIR__ . '/cachedPermissions.php');
require(__DIR__ . '/cachedPermissionsGroup.php');
require(__DIR__ . '/cachedRolesGroup.php');

return [
	'cachedRoles'=>$cachedRoles,
	'cachedPermissions'=>$cachedPermissions,
	'cachedPermissionsGroup'=>$cachedPermissionsGroup,
	'cachedRolesGroup'=>$cachedRolesGroup,
];