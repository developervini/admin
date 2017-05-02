<?php

class UserController
{
	public static function insertUser($data = array())
	{
		try {
			$User = new User();
			$User->name_user = $data['name_user'];
			$User->mail_user = $data['mail_user'];
			$User->username_user = $data['username_user'];
			$User->password_user = $data['password_user'];
			$User->save();

			$data = array(
				'msg' => 'Cadastou o usuário ' . $User->name_user . ' com id ' . $User->id_user,
				'route' => '/usuarios'
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

	public static function editUser($data = array())
	{
		try {
			$User = User::find($data['id_user']);
			$User->name_user = $data['name_user'];
			$User->mail_user = $data['mail_user'];
			$User->username_user = $data['username_user'];
			$User->password_user = $data['password_user'];
			$User->save();

			$data = array(
				'msg' => 'Alterou o usuário ' . $User->name_user . ' com id ' . $User->id_user,
				'route' => '/usuarios'
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

	public static function findUser($id_user = null)
	{
		try {	
			return User::find($id_user);
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => '/erro'
				);

			return $data;
		}
	}


	public static function deleteUser($id_user = null)
	{
		try {	
			return User::find($id_user)->delete();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => '/erro'
				);

			return $data;
		}
	}

	public static function listUser()
	{
		try {	

			return User::all();

		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => '/erro'
				);

			return $data;
		}
	}

	public static function loginUser($data = array())
	{
		try {	

			return User::find($data['pass']);			

		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => ''
			);

			return $data;
		}
	}
}