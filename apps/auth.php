<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');


class auth
{

	/**
	 * Admin mi diye kontrol der
	 * @return boolean
	 */
	public static function isAdmin()
	{
		return $_SESSION['USER']['isAdmin'];
	}

	/**
	 * Giriş yapmış mı diye kontrol eder
	 * @return boolean
	 */
	public static function isLoggedIn($userModel = false)
	{

		#Current Ip and User Agent
		$currentIp 			= md5( helper::getIp() );
		$currentAgent		= md5( helper::getUserAgent() );


		#Control et ve fetch et.
		$userInfo = self::fetchUserById($_SESSION['USER']['userId']);


		#Kullanıcı IP'si ve Browser'i database'deki ile uyuşmuyorsa kaldır gitsin!
		if($currentIp != $userInfo->userIp OR $currentAgent != $userInfo->userAgent)
		{
			//Sessionu kaladır.
			session::remove('',true);

			#Giriş yapılmamış adına false gönder
			return false;
		}

		else{
			return  $_SESSION['USER']['loggedIn'];
		}

	}

	/**
	 * Id'ye göre kullanıcı listeler
	 * @param integer $userId Kullanıcı Id'si
	 * @return object / bolean
	 */
	private static function fetchUserById($userId)
	{
		$select = registry::get('database')->prepare("
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


	public static function loginControl()
	{
		  #Admin değil se ve griş yapmamış ise..
        if(!auth::isLoggedIn() OR !auth::isAdmin())
        {
            session::remove('USER');
            redirect::to('');
            exit;
        }
	}


}