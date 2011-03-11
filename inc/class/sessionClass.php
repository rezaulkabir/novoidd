<?php

class sessionClass
{
	public function __construct()
	{
		session_start();		
	}
	public function PutSessionValue($_POST)
	{
		$_SESSION['first_name']		=$_POST['first_name'];
		$_SESSION['last_name']		=$_POST['last_name'];		
		$_SESSION['address']		=$_POST['address'];
		$_SESSION['city']			=$_POST['city'];
		$_SESSION['state']			=$_POST['state'];
		$_SESSION['postcode']		=$_POST['postcode'];
		$_SESSION['country_id']		=$_POST['country_id'];	
		$_SESSION['phone']			=$_POST['phone'];
		$_SESSION['username']		=$_POST['username'];
		$_SESSION['password']		=$_POST['password'];
		$_SESSION['password2']		=$_POST['confirm_password'];
		$_SESSION['email']			=$_POST['email'];
		$_SESSION['device_type']	=$_POST['device_type'];
		$_SESSION['id']				=$_POST['id'];
		$_SESSION['coupon']			=$_POST['coupon'];	
	}
}
?>