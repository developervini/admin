<?php
use \Slim\Slim as Slim;

function insertContract()
{
	$app = Slim::getInstance();
	if ($app->request->isPost()) {
		$return = ContractController::insertContract($app->request()->params());
		$app->redirect($return['route']);
	}
	$app->render('contract/new.html', array('clients' => ClientController::listClient(), 'user' => $_SESSION['user']));
}
