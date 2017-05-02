<?php

use BoletoSimples\BankBillet;

class ClientController
{
	public static function insertClient($data = array())
	{
		try {
			$Client = new Client();
			$Client->client = $data['client'];
			//$Client->photo = $data['photo'];
			$Client->birth_client = $data['birth_client'];
			$Client->sex = $data['sex'];
			$Client->cpf = $data['cpf'];
			$Client->rg = $data['rg'];	
			$Client->phone_client = $data['phone_client'];
			$Client->mail_client = $data['mail_client'];
			$Client->phone_client = $data['phone_client'];
			$Client->subdomain = $data['subdomain'];
			$Client->zipcode = $data['zipcode'];
			$Client->address = $data['address'];
			$Client->number = $data['number'];
			$Client->comp = $data['comp'];
			$Client->district = $data['district'];
			$Client->city = $data['city'];
			$Client->uf = $data['uf'];
			$Client->office_client_id = $data['office_client_id'];
			$Client->obs = $data['obs'];
			$Client->database = $data['database'];
			$Client->root = $data['root'];
			$Client->password = $data['password'];
			$Client->active = 0;
			$Client->save();

			$data = array(
				'msg' => 'Cadastou o cliente ' . $Client->client . ' com id ' . $Client->id,
				'route' => '/clientes'
				);

			return $data;

		} catch (Exception $ex) {

			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => '/erro'
				);

			return $data;
		}
	}

	public static function editClient($data = array())
	{
		try {
			$Client = Client::find($data['id']);
			$Client->client = $data['client'];
			//$Client->photo = $data['photo'];
			$Client->birth_client = $data['birth_client'];
			$Client->sex = $data['sex'];
			$Client->cpf = $data['cpf'];
			$Client->rg = $data['rg'];
			$Client->phone_client = $data['phone_client'];
			$Client->mail_client = $data['mail_client'];
			$Client->phone_client = $data['phone_client'];
			$Client->subdomain = $data['subdomain'];
			$Client->zipcode = $data['zipcode'];
			$Client->address = $data['address'];
			$Client->number = $data['number'];
			$Client->comp = $data['comp'];
			$Client->district = $data['district'];
			$Client->city = $data['city'];
			$Client->uf = $data['uf'];
			$Client->office_client_id = $data['office_client_id'];
			$Client->obs = $data['obs'];
			$Client->database = $data['database'];
			$Client->root = $data['root'];
			$Client->password = $data['password'];
			$Client->active = $data['active'];
			$Client->save();

			$data = array(
				'msg' => 'Alterou o cliente ' . $Client->client . ' com id ' . $Client->id,
				'route' => '/clientes'
				);

			return $data;

		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => '/erro'
				);

			return $data;
		}
	}

	public static function findClientFull($id = null)
	{
		try {	
			return Client::join('office', 'office.id', '=', 'office_client_id')->where('client.id', $id)->select('client.*','office.office as office')->first();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => '/erro'
				);

			return $data;
		}
	}

	public static function findClient($id = null)
	{
		try {	
			return Client::find($id);
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => '/erro'
				);

			return $data;
		}
	}


	public static function deleteClient($id = null)
	{
		try {	
			return Client::find($id)->delete();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => '/erro'
				);

			return $data;
		}
	}

	public static function listClient()
	{
		try {	

			return Client::all();

		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => '/erro'
				);

			return $data;
		}
	}
}