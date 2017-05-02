<?php
use \Slim\Slim as Slim;

function insertBillet()
{
	$app = Slim::getInstance();
	if ($app->request->isPost()) {
		$data = $app->request()->params();
		$_SESSION['other'] = ClientController::findClient($data['client']);
		$filext = explode(".", $_FILES['file']['name']);
		$ext = end($filext);
		$doc = 'Boleto ' . date("d-m-Y-H-i-s") .'.' . $ext;
		$dir = realpath(dirname(ROOT)) . DS . explode('.', $_SESSION['other']->subdomain)[0] . DS . 'public' . DS . 'billet' . 	DS ;
		if(move_uploaded_file($_FILES['file']['tmp_name'], $dir . $doc)){
			$Billet = new Billet();
			$Billet->setConnection('other');
			$Billet->billet = $data['billet'];
			$Billet->billet_address = 'billet' . DS . $doc;
			$Billet->save();
		}

		$app->redirect('/clientes');
	}
}