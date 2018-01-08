<?php
use \Slim\Slim as Slim;

function execSql()
{
	$app = Slim::getInstance();
	if ($app->request->isPost()) {
		$return = AdminController::execSql($app->request()->params());
		//$app->redirect($return['route']);
	}
	$app->render('admin/sql.html', array('user' => $_SESSION['user']));
}