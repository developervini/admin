<?php

class ContractController
{
	public static function insertContract($data = array())
	{
		try {
			$Contract = new Contract();
			$Contract->client_id = $data['client_id'];
			$Contract->amount = $data['value'] * $data['month'];
			$Contract->month = $data['month'];
			$Contract->pay_day = $data['pay_day'];
			$Contract->start = $data['start'];
			$Contract->end = date('Y-m-d', strtotime("+".$data['month']." months", strtotime($data['start'])));
			$Contract->training = $data['training'];
			$Contract->amount_training = $data['amount_training'];
			$Contract->obs = $data['obs'];
			$Contract->save();

			for ($i=0; $i < $Contract->month; $i++) {
				PortionController::insertPortion(array('contract_id' => $Contract->id, 'month_year' => date('m/Y', strtotime("+".$i." months", strtotime($data['start']))), 'description' => ($i + 1) . 'ª Parcela', 'value' => $data['value']));
			}

			$data = array(
				'msg' => 'Cadastou o contrato com id ' . $Contract->id,
				'route' => '/clientes'
				);

			return $data;

		} catch (Exception $ex) {

			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => '/erro'
				);

			var_dump($data);
		}
	}

	// public static function editContract($data = array())
	// {
	// 	try {
	// 		$Contract = Contract::find($data['id']);
	// 		$Contract->Contract = $data['Contract'];
	// 		$Contract->color = $data['color'];
	// 		$Contract->active = $data['active'];
	// 		$Contract->save();

	// 		$data = array(
	// 			'msg' => 'Alterou o cargo ' . $Contract->Contract . ' com id ' . $Contract->id,
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

	public static function findContract($id = null)
	{
		try {	
			return Contract::where('client_id', $id)->first();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => '/erro'
				);

			return $data;
		}
	}


	// public static function deleteContract($id = null)
	// {
	// 	try {	
	// 		return Contract::find($id)->delete();
	// 	} catch (Exception $ex) {
	// 		$data = array(
	// 			'msg' => $ex->getMessage(), 
	// 			'route' => '/erro'
	// 			);

	// 		return $data;
	// 	}
	// }

	// public static function listContract()
	// {
	// 	try {	

	// 		return Contract::all();

	// 	} catch (Exception $ex) {
	// 		$data = array(
	// 			'msg' => $ex->getMessage(), 
	// 			'route' => '/erro'
	// 			);

	// 		return $data;
	// 	}
	// }
}