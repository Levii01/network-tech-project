<?php
	session_start();
	
	if(isset($_POST['email']))
	{
		$is_valid=true; //validacja
		
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$street = $_POST['street'];
		$number1 = $_POST['number1'];
		$number2 = $_POST['number2'];
		$city = $_POST['city'];
		$zip_code = $_POST['zip_code'];
		$login = $_POST['login'];
		$email=$_POST['email'];
		$password=$_POST['password'];	
		$education=$_POST['education'];
		$hobby=$_POST['hobby'];

		//Validacja imienia
		if (empty($first_name)) {
			$is_valid= false;
			$_SESSION['e_first_name']="Podaj sowje imię.";
		} else if (strlen($first_name) < 3) {
			$is_valid= false;
			$_SESSION['e_first_name']="Imię musi posiadać co najmniej 3 litery.";
		} else if (!preg_match("/^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ ]+$/", $first_name)) {
			$is_valid= false;
			$_SESSION['e_first_name']="Imię może zawierać tylko litery alfabetu.";
		}
		
		//Validacja nazwiska
		if (empty($last_name)) {
			$is_valid= false;
			$_SESSION['e_last_name']="Podaj sowje nazwisko.";
		} else if (strlen($last_name) < 3) {
			$is_valid= false;
			$_SESSION['e_last_name']="Nazwisko musi posiadać co najmniej 3 litery.";
		} else if (!preg_match("/^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ ]+$/",$last_name)) {
			$is_valid= false;
			$_SESSION['e_last_name']="Nazwisko może zawierać tylko litery alfabetu.";
		}
		
		//Validacja ulicy
		if (empty($street)) {
			$is_valid= false;
			$_SESSION['e_street']="Podaj ulicę.";
		} else if (strlen($street) < 3) {
			$is_valid= false;
			$_SESSION['e_street']="Ulica musi posiadać co najmniej 3 litery.";
		} else if (!preg_match("/^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ ]+$/",$last_name)) {
			$is_valid= false;
			$_SESSION['e_street']="Ulica może zawierać tylko litery alfabetu.";
		}	
		
		//Validacja numeru domu
		if (empty($number1)) {
			$is_valid= false;
			$_SESSION['e_number1']="Podaj numer domu.";
		}	else if (!is_numeric($number1)) {
			$is_valid= false;
			$_SESSION['e_number1']="Dozwolone tylko cyfry.";
		}
		
		//Validacja numeru mieszkania
		if (!is_numeric($number2)) {
			$is_valid= false;
			$_SESSION['e_number2']="Dozwolone tylko cyfry.";
		}
		
		//Validacja miasta
		if (empty($city)) {
			$is_valid= false;
			$_SESSION['e_city']="Podaj miasto";
		} else if (strlen($city) < 3) {
			$is_valid= false;
			$_SESSION['e_city']="Miasto musi posiadać co najmniej 3 litery.";
		} else if (!preg_match("/^[a-zA-ZąćęłńóśżźĄĆĘŁŃÓŚŻŹ ]+$/",$city)) {
			$is_valid= false;
			$_SESSION['e_city']="Miasto może zawierać tylko litery alfabetu.";
		}
		
		//Validacja kodu pocztowego
		if (empty($zip_code)) {
			$is_valid= false;
			$_SESSION['e_zip_code']="Podaj kod pocztowy.";
		} else if (!is_numeric($zip_code)) {
			$is_valid= false;
			$_SESSION['e_zip_code']="Dozwolone tylko cyfry.";
		}
		
		//Validacja loginu
		if((strlen($login)<3) || (strlen($login)>15)) {
			$is_valid=false;
			$_SESSION['e_login']="Login musi posiasać od 3 do 15 znaków.";
		}
		if (ctype_alnum($login)==false) {
			$is_valid=false;
			$_SESSION['e_login']="Login może składać się tylko z liter i cyfr (bez polskich znaków).";
		}
		
		//Validacja adresu e-mail
		$emailS = filter_var($email, FILTER_SANITIZE_EMAIL);
		if((filter_var($emailS, FILTER_VALIDATE_EMAIL)==false) || ($emailS!=$email)) {
			$is_valid=false;
			$_SESSION['e_email']="Podaj poprawny adres email.";
		}
		
		//Validacja hasła
		if (empty($password)){
			$is_valid=false;
			$_SESSION['e_password']= "Podaj hasło.";
		} 
        
    if(strlen($password) < 6) {
			$is_valid=false;
			$_SESSION['e_password'] = "Hasło musi posiadać co najmniej 6 znaków.";
		} else { $password_hash = password_hash($password, PASSWORD_DEFAULT); }
		
		//Sprawdzenie pola wykształcenie
		if(!isset($_POST['education'])) { $_SESSION['e_education'] = "Zaznacz jedną odpowiedź"; }
		
		//Spr. pola zainteresowania
		if(!isset($_POST['hobby'])) { $_SESSION['e_hobby'] = "Zaznacz jedną odpowiedź"; }		
		
		//validacja unikalności loginu i emailu
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		try	{
			$connection = new mysqli($host, $db_user, $db_password , $db_name);
			if($connection->connect_errno!=0) {
				throw new Exception(mysqli_connect_errno());
			} else {
				//czy email już istnieje
				$rez = $connection->query("SELECT id FROM users WHERE email='$email'");
				if(!$rez) throw new Exception($connection-> error);
				
				if ($rez->num_rows > 0) {
					$is_valid=false;
					$_SESSION['e_email']="Ten email jest już w użyciu.";
				}
			
				//czy login już istnieje
				$rez = $connection->query("SELECT id FROM users WHERE login='$login'");
				if(!$rez) throw new Exception($connection-> error);
				if ($rez->num_rows > 0) {
					$is_valid=false;
					$_SESSION['e_login']="Login jest już w użyciu.";
				}
						
				if($is_valid==true) {
					if( $connection->query("INSERT INTO users (first_name, last_name, email, login, password, street, number1, number2, zip_code, city, education, hobby)
					VALUES ('$first_name', '$last_name', '$email', '$login', '$password_hash', '$street', '$number1', '$number2', '$zip_code', '$city', '$education', '$hobby')") )
					{
						$_SESSION['register_finish']=true;
						header('Location: user/create.php');
					} else {
						throw new Exception($connection-> error);
					}
				}
				$connection->close();
			}
		} catch(Exception $error) {
		 echo '<span style="color:red;">Błąd serwera</span>';
		 echo '<br />'.$error;		 
		}
	}
?>
