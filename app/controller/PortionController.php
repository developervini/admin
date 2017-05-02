<?php

class PortionController
{
	public static function insertPortion($data = array())
	{
		try {
			$Portion = new Portion();
			$Portion->contract_id = $data['contract_id'];
			$Portion->month_year = $data['month_year'];
			$Portion->description = $data['description'];
			$Portion->value = $data['value'];
			$Portion->save();

			$data = array(
				'msg' => 'Cadastou a parcela ' . $Portion->description . ' do contrato ' . $Portion->contract_id,
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

	public static function listPortion($id)
	{
		try {	
			return Portion::join('contract', 'contract.id', '=', 'contract_id')->join('client', 'client.id', '=', 'client_id')->where('client.id', $id)->where('portion.status', 0)->select('portion.*', 'contract.pay_day as pay_day')->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => '/erro'
				);

			var_dump($data);
		}
	}

	public static function findPortion($id)
	{
		try {	
			$Portion = Portion::find($id);
			$Portion->status = 1;
			$Portion->save();

			$Portion = Portion::join('contract', 'contract.id', '=', 'contract_id')->where('portion.id', $id)->first();

			$data = array(
				'msg' => 'Cadastou o pagamento da ' . $Portion->description,
				'route' => '/cliente/id=' . $Portion->client_id
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

	public static function listPortionBillet($data = array())
	{
		try {	
			return Portion::join('contract', 'contract.id', '=', 'contract_id')->join('client', 'client.id', '=', 'client_id')->where('contract.pay_day', $data['pay_day'])->where('month_year', $data['month'].'/'.date('Y'))->get();
		} catch (Exception $ex) {
			$data = array(
				'msg' => $ex->getMessage(), 
				'route' => '/erro'
				);

			var_dump($data);
		}
	}
}