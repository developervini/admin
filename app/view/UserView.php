<?php
use \Slim\Slim as Slim;

function insertUser()
{
	$app = Slim::getInstance();

	if($_SESSION['user']->manager == 1){

		if ($app->request->isPost()) {
			$return = UserController::insertUser($app->request()->params());
			$app->redirect($return['route']);
		}

		$app->render('user/new.html', array('user' => $_SESSION['user']));
	}else{
		$app->redirect('/acesso-negado');
	}
}

function editUser($id)
{
	$app = Slim::getInstance();
	if ($app->request->isPut()) {

		$return = UserController::editUser($app->request()->params());

		if($return['id'] == $_SESSION['user']->id)
			$app->redirect('/logout');

		$app->redirect($return['route']);
	}

	$app->render('user/edit.html', array('userof' => UserController::findUser($id), 'user' => $_SESSION['user']));
}

function listUser()
{
	$app = Slim::getInstance();
	$app->render('user/list.html', array('users' => UserController::listUser(), 'user' => $_SESSION['user']));
}

function deleteUser($id)
{
	$app = Slim::getInstance();
	$UserController = new UserController();

	if ($app->request->isDelete()) {
		$return = $UserController->deleteUser($id);
		$app->redirect('/usuarios');
	}

	$user = $UserController->findUser($id);
	echo $app->view->render('user/delete.html', array('userof' => $user, 'user' => $_SESSION['user']));
}

function detailUser($id)
{
	$app = Slim::getInstance();
	$app->render('user/detail.html', array('userof' => UserController::findUser($id), 'logs' => LogUserController::listLogUser($id), 'user' => $_SESSION['user']));
}


function listLog()
{
	$app = Slim::getInstance();
	$app->render('user/logs.html', array('logs' => LogUserController::listLog(), 'user' => $_SESSION['user']));
}


function loginUser()
{
	$app = Slim::getInstance();

	$_SESSION['other'];

	if($app->request->isPost()){
		$return = UserController::loginUser($app->request()->params());
		
		if (!empty($return)) {

			$_SESSION['user'] = $return;
			$app->redirect('/clientes');

		}else {
			$app->redirect('/login');
		}
	}
	
	$app->render('login.html');
}

function logoutUser()
{
	$app = Slim::getInstance();
	session_destroy();
	$app->redirect('/login');
}

function auth()
{
	$app = Slim::getInstance();

	if(!isset($_SESSION['user']))	
			$app->redirect('/login');

}