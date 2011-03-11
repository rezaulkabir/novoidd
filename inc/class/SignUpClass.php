<?php session_start();

include"connClass.php";

	class signup{

		public function __construct()

		{

				$conn= new mysqlconnect();

				$conn->connect();

		}

	public function signup($postVal)

	{

		$first_name		=$postVal['first_name'];

		$last_name		=$postVal['last_name'];

		$address		=$postVal['address'];

		$city			=$postVal['city'];

		$state			=$postVal['state'];

		$postcode		=$postVal['postcode'];

		$country_id		=$postVal['country_id'];

		$phone			=$postVal['phone'];

		$username		=$postVal['username'];

		$password		=$postVal['password'];

		$email			=$postVal['email'];

		$device_type	=$postVal['device_type'];	

		$coupon			=$postVal['coupon'];

/*			$username='user14222';

			$coupon='123456789asdfghj2';	*/

	if(!$this->checkLoginNameIsExist($username)){							

		if($coupon!="")

		{

			if($this-> checkCouponIsUsed($coupon))

			{

				$_SESSION['error']="Invalid Coupon";

			//	header('Location: signup.php');

				return FALSE;						

				}else

			{			

				

				$_SESSION['error']="";

				$sql= "INSERT INTO users (userid, first_name, last_name, address, city, state, postcode, country_id, phone, username, password, email, device_type

				)VALUES (NULL , '$first_name', '$last_name', '$address', '$city', '$state', '$postcode', '$country_id', '$phone', '$username', '$password', '$email', '$device_type')";

				

				$couponSql="INSERT INTO usedcoupon (id ,couponid ,loginid)VALUES (NULL , '$coupon', '$username')";

				$this->begin(); // transaction begins

				$CuponQuery= @mysql_query($couponSql);

				$signupQuery=@mysql_query($sql);

				

				if((!$CuponQuery ) || (!$signupQuery))

				{

				$this->rollback();

				}else

				{

				$this->commit();	

				}

				return TRUE;

			}

			

		}		

		else

		{

			$_SESSION['error']="";

			$sql= "INSERT INTO users (userid, first_name, last_name, address, city, state, postcode, country_id, phone, username, password, email, device_type

			)VALUES (NULL , '$first_name', '$last_name', '$address', '$city', '$state', '$postcode', '$country_id', '$phone', '$username', '$password', '$email', '$device_type')";

			@mysql_query($sql);

			return TRUE;

		}

		}else

		{

		

			return FALSE;

		}		

	}

	private function checkCouponIsUsed($couponNumber)

		{		

		//$username='user14';

		//$couponNumber='123456789asdfghj';

		$sql="SELECT * FROM usedcoupon WHERE couponid = '$couponNumber'";

		$res =mysql_fetch_row(mysql_query($sql));

		if($res!=NULL){		

			return TRUE;

			}else{

			

			return FALSE;

			}		

	}

	

	public function checkLoginNameIsUsed($loginname)

		{		

	 	$sql=mysql_query("SELECT username, phone FROM users WHERE username='$loginname'");		

		//die($sql);

		$results = array();

		while($row = mysql_fetch_array($sql))

		{

		   $results[] = array(

		      'username' => $row['username'],

		      'phone' => $row['phone']		      

		   );

		}

		return  json_encode($results);		

	}

	public function checkLoginNameIsExist($loginname)

	{

		$sql="SELECT username, phone FROM users WHERE username='$loginname'";

		$res =mysql_fetch_row(mysql_query($sql));

		if($res!=NULL){	

		$_SESSION['error']="User Name already exists";	

			return TRUE;

			}else{

			

			return FALSE;

			}		

	}	

	private function begin()

	{

		@mysql_query("BEGIN");

	}

	private function commit()

	{

		@mysql_query("COMMIT");

	}

	private function rollback()

	{

		@mysql_query("ROLLBACK");

	}

	}

?>