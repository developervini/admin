<?php
use \Slim\Slim as Slim;

function insertSubdomain()
{
	$app = Slim::getInstance();
	if ($app->request->isPost()) {
		$data = $app->request()->params();
		$return = SubdomainController::insertSubdomain($app->request()->params());
		if($return){
			$app->redirect('/cadastrar-banco/' . $data['subdomain']);
		}
	}else{
		$app->render('subdomain/new.html', array('user' => $_SESSION['user']));
	}
}


function insertDatabase($subdomain)
{
	$app = Slim::getInstance();
	if ($app->request->isPost()) {
		$return = SubdomainController::create_base($app->request()->params());
		//$app->redirect($return['route']);
	}else{
		$app->render('subdomain/newBase.html', array('subdomain' => $subdomain, 'user' => $_SESSION['user']));
	}
}
