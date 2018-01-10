<?php

$app->get('/clientes', 'auth', 'listClient');

$app->get('/cliente/id=:id', 'auth', 'detailClient');
$app->get('/cliente-getid/id=:id', 'auth', 'sessionClient');
$app->get('/cliente-database/id=:id', 'auth', 'databaseClient');

$app->group('/cadastrar',function() use ($app){
	$app->get('-cliente', 'auth', 'insertClient');
	$app->post('-cliente', 'auth', 'insertClient');
	$app->post('-boleto', 'auth', 'insertBillet');
	$app->get('-pagamento/:id', 'auth', 'findPortion');
	$app->get('-contato/client_id=:id', 'auth', 'insertContactClient');
	$app->post('-contato/client_id=:id', 'auth', 'insertContactClient');
	$app->get('-contrato', 'auth', 'insertContract');
	$app->post('-contrato', 'auth', 'insertContract');
	$app->get('-subdominio', 'auth', 'insertSubdomain');
	$app->post('-subdominio', 'auth', 'insertSubdomain');
	$app->get('-banco/:subdomain', 'auth', 'insertDatabase');
	$app->post('-banco/:subdomain', 'auth', 'insertDatabase');
});

$app->group('/editar',function() use ($app){
	$app->get('-cliente/id=:id', 'auth', 'editClient');
	$app->put('-cliente/id=:id', 'auth', 'editClient');
});

$app->get('/executar-sql', 'auth', 'execSql');
$app->post('/executar-sql', 'auth', 'execSql');

$app->get('/', 'auth', 'listClient');

$app->get('/login', 'loginUser');
$app->post('/login', 'loginUser');
$app->get('/logout', 'logoutUser');