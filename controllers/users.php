<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class users extends controller
{

	public function home()
	{
		parent::__construct();
	}

	public function logout()
	{
		session::remove('USER');
		redirect::to('');
	}
}