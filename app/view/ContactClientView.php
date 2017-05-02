<?php
use \Slim\Slim as Slim;


function insertContactClient($id = null)
{
	$app = Slim::getInstance();
	if ($app->request->isPost()) {
		$return = ContactClientController::insertContactClient($app->request()->params());
		$app->redirect($return['route']);
	}
	$app->render('contact_client/new.html', array('client' => $id, 'offices' => OfficeController::listOffice(), 'user' => $_SESSION['user']));
}