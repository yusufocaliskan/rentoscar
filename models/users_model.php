<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');


class users_model extends model
{

	/**
	 * Girilen bilgiler ile uyuşan kullanıcı var mı?
	 * @param array $data Kullanıcı bilgileri
	 * @return object / boolean
	 */
	public function userCtrlAndFetch($data)
	{

		extract($data);

		$select = $this->DB->prepare("
			SELECT
				*
			FROM
				users
			WHERE
				userEmail = ?
			AND
				userPass = MD5(?)
		");


		$select->execute(array($email,$password));

		if($select->rowCount() > 0)
		{
			return $select->fetch(PDO::FETCH_OBJ);
		}

		return false;

	}

	/**
	 * Id'ye göre kullanıcı listeler
	 * @param integer $userId Kullanıcı Id'si
	 * @return object / bolean
	 */
	public function fetchUserById($userId)
	{
		$select = $this->DB->prepare("
			SELECT
				userIp,
				userAgent
			FROM
				users
			WHERE
				userId = ?
		");

		$select->execute(array($userId));
		if($select->rowCount() > 0)
		{
			return $select->fetch(PDO::FETCH_OBJ);
		}

		return false;
	}

	/**
	 * Kullanıcı Ip'sini ve Browser'ini günceller
	 */
	public function updateUserIpAndAgent($userId)
	{
		$ip 	= helper::getIp();
		$agent 	= helper::getUserAgent();

		$update = $this->DB->prepare("
			UPDATE
				users
			SET
				userIp 		= md5(?),
				userAgent	= md5(?)
			WHERE
				userId 		= ?
		");

		$update->execute(array($ip, $agent,$userId));

		if($update->rowCount() > 0)
		{
			return true;
		}


		return false;
	}



} //Class