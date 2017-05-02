<?php
use \Slim\Slim as Slim;

function listClient()
{
	$app = Slim::getInstance();
	$app->render('client/list.html', array('clients' => ClientController::listClient(), 'user' => $_SESSION['user']));
}

function sessionClient($id = null)
{
	$app = Slim::getInstance();
	$_SESSION['other'] = ClientController::findClient($id);
	$app->redirect('/cliente-database/id=' . $id);
}

function databaseClient($id = null)
{
	$app = Slim::getInstance();
	$app->render('client/database.html', array('client' => $_SESSION['other'], 'peoples' => People::on('other')->get(), 'schools' => School::on('other')->get(),'requests' =>  Request::on('other')->get(),'events' => Event::on('other')->get(), 'users' => User::on('other')->get(), 'logs' => LogUser::on('other')->join('user', 'user_id', '=', 'user.id')->limit(10)->orderBy('id', 'DESC')->select('log_user.*', 'user.name as user_id')->get(), 'teams' => Team::on('other')->get(), 'user' => $_SESSION['user']));
}


function detailClient($id = null)
{
	$app = Slim::getInstance();
	$app->render('client/detail.html', array('client' => ClientController::findClientFull($id), 'contract' => ContractController::findContract($id), 'contacts' => ContactClientController::listContactClient($id), 'portions' => PortionController::listPortion($id), 'user' => $_SESSION['user']));
}

function insertClient()
{
	$app = Slim::getInstance();
	if ($app->request->isPost()) {
		$return = ClientController::insertClient($app->request()->params());
		$app->redirect($return['route']);
	}
	$app->render('client/new.html', array('offices' => OfficeController::listOffice(), 'user' => $_SESSION['user']));
}

function editClient($id)
{
	$app = Slim::getInstance();
	if ($app->request->isPut()) {
		$return = ClientController::editClient($app->request()->params());
		$app->redirect($return['route']);
	}
	$app->render('client/edit.html', array('client' => ClientController::findClient($id), 'offices' => OfficeController::listOffice(), 'user' => $_SESSION['user']));
}

function findPortion($id)
{
	$app = Slim::getInstance();
	$return = PortionController::findPortion($id);
	$app->redirect($return['route']);
}