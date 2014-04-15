<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class dashboard extends controller
{

	public function __construct()
	{
		parent::__construct();

        #Login Control et.
        auth::loginControl();


	}

	public function home()
	{
		$this->theme('admin/dashboard/home','Admin Paneli',true);
	}

    public function sendBots()
    {
       redirect::to('Cars/cronJobs');

    }

}