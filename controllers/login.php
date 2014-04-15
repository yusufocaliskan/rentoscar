<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class login extends controller
{

	/**
	 * Login modülü
	 * @var object
	 */
	public $model;

	/**
	 * Construct!
	 */
    public function __construct()
    {
		parent::__construct();

		#Login modelini çek.
		$this->model = registry::get('model')->loadModel('users');




	}

	/**
	 * Login ana sayfası
	 */
	public function home()
	{

		//debug::pre($_POST);

		input::set(array(
			'email'		=>'email',
			'password'	=> '',
			'recaptcha_challenge_field' =>'',
			'recaptcha_response_field'	=> '',
			'token'=>''
		));

		#post'u al
		extract($post = input::pushInArray(array('email','password','recaptcha_challenge_field','recaptcha_response_field','token')));

		#reCaptcha'i çağır
		require ROOTPATH.'libs/recaptcha/recaptchalib.php';

		if(helper::isPOST())
		{

			//CSRF için! Önemli!
			if(!helper::isValidToken())
			{
				redirect::to('');
			}

			#Post işlemi 10'u geçti mi?
			else if(helper::postCount(10))
			{
				error::flash('error','Sakin ol yaşlı kurt!');
			}

			#boş alan var mı
			else if(helper::isEmpty($email) OR helper::isEmpty($password) OR helper::isEmpty($recaptcha_challenge_field) OR helper::isEmpty($recaptcha_response_field))
			{
				error::notice('warning','Boş alan bıraktınız');
			}

			else if(!helper::reCaptcha())
			{
				error::notice('warning','Güvenlik kodu yanlış');
			}

			#email geçerli mi?
			else if(!helper::isEmail($email))
			{
				error::notice('error',' - '. htmlentities($email) . ' - Geçerli email değil.');
			}

			#Hiç hata yok ise
			else if(!error::issetError())
			{


				#kullancı kontrolü yap
				$userCtrl = $this->model->userCtrlAndFetch($post);

				//debug::pre($userCtrl);

				#Database böyle bir kullanıc var mı?
				if($userCtrl)
				{
					//debug::pre($userCtrl);
					session::set('USER', array(
						'userId'	=>	$userCtrl->userId,
						'userName'	=>  $userCtrl->userName,
						'userEmail'	=>	$userCtrl->userEmail,
						'userPass' 	=>	$userCtrl->userPass,
						'userIp'	=>  $userCtrl->userIp,
						'userAgent' => 	$userCtrl->userAgent,

						#Bu bir admin mi? Important!
						'isAdmin'   =>  $userCtrl->userLevel == 1 ? true : false,

						#Giriş yaptı mı? Important!
						'loggedIn'	=> true

					));


					#Kullanıcı Ip'sini ve Browser'ini güncele.
					$this->model->updateUserIpAndAgent($userCtrl->userId);

					#Form Count'ı sıfırla
					$_SESSION['SESSION_FROM_POST_COUNT'] = 0;
					//debug::pre($_SESSION);

				}
				else{
					error::notice('error', 'Email veya Password yanlış.');
				}

			}
		}


		#Session açıksa burayı gösterme ki
		#Bir daha session açması.
		//echo '--------- LOGIN ---------';
		//debug::pre($_SESSION);
		if( auth::isLoggedIn( $this->model ) )
		{
			redirect::to('');
		}


		#Theme
		parent::theme("login/home",'Admin Login','',true);
	}



}