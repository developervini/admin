<?php

class ContactClientController
{
	public static function insertContactClient($data = array())
	{
		try {
			$ContactClient = new ContactClient();
			$ContactClient->contact = $data['contact'];
			$ContactClient->sex = $data['sex'];
			$ContactClient->birth_contact = $data['birth_contact'];
			$ContactClient->phone_contact = $data['phone_contact'];
			$ContactClient->mail_contact = $data['mail_contact'];
			$ContactClient->office_contact_id = $data['office_contact_id'];
			$ContactClient->client_id = $data['client_id'];
			$ContactClient->save();

			$data = array(
				'msg' => 'Cadastou o contato ' . $ContactClient->contact . ' com id ' . $ContactClient->id,
				'route' => '/cliente/id=' . $ContactClient->client_id
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

	// public static function editContactClient($data = array())
	// {
	// 	try {
	// 		$ContactClient = ContactClient::find($data['id']);
	// 		$ContactClient->ContactClient = $data['ContactClient'];
	// 		$ContactClient->color = $data['color'];
	// 		$ContactClient->active = $data['active'];
	// 		$ContactClient->save();

	// 		$data = array(
	// 			'msg' => 'Alterou o cargo ' . $ContactClient->ContactClient . ' com id ' . $ContactClient->id,
	// 			'route' => '/funcionarios'
	// 			);

	// 		return $data;

	// 	} catch (Exception $ex) {
	// 		$data = array(
	// 			'msg' => $ex->getMessage(), 
	// 			'route' => '/erro'
	// 			);

	// 		return $data;
	// 	}
	// }

	public static function listContactClient($id = null)
	{
		try {	
			return ContactClient::join('office', 'office.id', '=', 'office_contact_id')->where('client_id', $id)->where('contact_client.active', 0)->orderBy('contact', 'ASC')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => '/erro'
				);

			var_dump($data);
		}
	}
}