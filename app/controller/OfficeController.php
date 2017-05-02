<?php

class OfficeController
{
	public static function insertOffice($data = array())
	{
		try {
			$Office = new Office();
			$Office->office = $data['office'];
			$Office->color = $data['color'];
			$Office->active = $data['active'];
			$Office->save();

			$data = array(
				'msg' => 'Cadastou o cargo ' . $Office->office . ' com id ' . $Office->id,
				'route' => '/funcionarios'
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

	public static function editOffice($data = array())
	{
		try {
			$Office = Office::find($data['id']);
			$Office->office = $data['office'];
			$Office->color = $data['color'];
			$Office->active = $data['active'];
			$Office->save();

			$data = array(
				'msg' => 'Alterou o cargo ' . $Office->office . ' com id ' . $Office->id,
				'route' => '/funcionarios'
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

	public static function findOffice($id = null)
	{
		try {	
			return Office::find($id);
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => '/erro'
				);

			return $data;
		}
	}


	public static function deleteOffice($id = null)
	{
		try {	
			return Office::find($id)->delete();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => '/erro'
				);

			return $data;
		}
	}

	public static function listOffice()
	{
		try {	

			return Office::orderBy('office', 'ASC')->get();

		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => '/erro'
				);

			return $data;
		}
	}
}