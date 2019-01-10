<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;
$tnsname = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 10.199.54.40)(PORT = 1521))
        (CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = stagepwkorcl.bpk.go.id)))';

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => $tnsname,
	'username' => 'sisdm_v2',
	'password' => 'winchester',
	'database' => 'sisdm_v2',
	'dbdriver' => 'oci8',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => TRUE,
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
