<?php
require 'environment.php';
require 'vendor/autoload.php';

global $config;
global $db;

$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost:8080/proj.ajudavoluntaria/");		
	$config['dbname'] = 'ajuda_voluntaria';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	define("BASE_URL", "http://localhost:8080/proj.ajudavoluntaria/");		
	$config['dbname'] = 'ajuda_voluntaria';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
}

/* Parametro de Registros por Pagina para Uso no Paginador */
$config['qtde_registros_mostrar_por_pagina'] = 10;

/* Configurações para uso no PHPMailer na recuperação de Senha*/
$config['mail_email_remetente'] = 'seuemail@dominio.com.br';
$config['mail_senha_remetente'] = 'suasenha';
$config['mail_smtp_remetente'] = 'smtp.dominio.com.br';


$db = new PDO("mysql:dbname=".$config['dbname'].";charset=utf8;host=".$config['host'], $config['dbuser'], $config['dbpass']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>