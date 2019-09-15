<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<link href="/style.css" rel="stylesheet" type="text/css" media="all">
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>Formularz</title>
	</head>

	<body>
    <h1>Formularz online</h1>
    
		<form method="POST">
      <div class="card">
        <div class="container">
          <fieldset>
            <legend>
            Szczegóły konta:
            </legend>
            <label>
              Imię: </br>
              <input type="text" name="first_name" size="30" maxlength="100">
            </label>
            <br/>
            <?php 
              if(isset($_SESSION['e_first_name']))
              {
                echo '<div class="error">'.$_SESSION['e_first_name'].'</div>';
                unset($_SESSION['e_first_name']);
              }
            ?>
            <label>
              Nazwisko: </br>
              <input type="text" name="last_name" size="30" maxlength="100">
            </label>
            </br>
            
            <?php 
              if(isset($_SESSION['e_last_name']))
              {
                echo '<div class="error">'.$_SESSION['e_last_name'].'</div>';
                unset($_SESSION['e_last_name']);
              }
            ?>
          
            <label>Adres e-mail:</br> <input type="text" name="email" size="30" maxlength="100" /></label>
            <br/>
            
            <?php 
            if(isset($_SESSION['e_email']))
            {
              echo '<div class="error">'.$_SESSION['e_email'].'</div>';
              unset($_SESSION['e_email']);
            }
            ?>
            <label>Adres zamieszkania:</br> 
            <label>Ulica <input type="text" name="street" ></label>
            <?php 
              if(isset($_SESSION['e_street']))
              {
                echo '<div class="error">'.$_SESSION['e_street'].'</div>';
                unset($_SESSION['e_street']);
              }
            ?>
            
            <label>Nr domu <input type="text" name="number1"></label>	
            <?php 
              if(isset($_SESSION['e_number1']))
              {
                echo '<div class="error">'.$_SESSION['e_number1'].'</div>';
                unset($_SESSION['e_number1']);
              }
            ?>
          
            <label>Nr mieszkania <input type="text" name="number2"></label></br>
            <?php 
              if(isset($_SESSION['e_number2']))
              {
                echo '<div class="error">'.$_SESSION['e_number2'].'</div>';
                unset($_SESSION['e_number2']);
              }
            ?>
            
            <label>Miasto <input type="text" name="city"></label>
            <?php 
              if(isset($_SESSION['e_city']))
              {
                echo '<div class="error">'.$_SESSION['e_city'].'</div>';
                unset($_SESSION['e_city']);
              }
            ?>
          
            <label>Kod pocztowy<input type="text" name="zip_code"></label>
            <br/>
            <?php 
              if(isset($_SESSION['e_zip_code']))
              {
                echo '<div class="error">'.$_SESSION['e_zip_code'].'</div>';
                unset($_SESSION['e_zip_code']);
              }
            ?>
          </fieldset>
        </div>
      </div>

      <div class="card">
        <div class="container">
          <fieldset>
            <legend>
            Login i hasło:
            </legend>
            <label for="login">Login:</label>
            <input type="text" name="login" size="30" maxlength="100" value=""/></br>
          
            <?php 
              if(isset($_SESSION['e_login']))
              {
                echo '<div class="error">'.$_SESSION['e_login'].'</div>';
                unset($_SESSION['e_login']);
              }
            ?>
          
            <label for="password">Hasło:</label>
            <input type="password" name="password" size="15" maxlength="30" value=""/></br>
            <?php 
              if(isset($_SESSION['e_password']))
              {
                echo '<div class="error">'.$_SESSION['e_password'].'</div>';
                unset($_SESSION['e_password']);
              }
            ?>
          </fieldset>
        </div>
      </div>

      <div class="card">
        <div class="container">
          <fieldset>
            <legend>
            O sobie:
            </legend>
            Wykształcenie:
              <input type="radio" name="education" value="wyzsze">
              <label>wyższe</label>
              <input type="radio" name="education" value="srednie">
              <label>średnie</label>
              <input type="radio" name="education" value="podstawowe">
              <label>podstawowe</label>
            <?php 
              if(isset($_SESSION['e_education']))
              {
                echo '<div class="error">'.$_SESSION['e_education'].'</div>';
                unset($_SESSION['e_education']);
              }
            ?>

            </br>
            </br>
            Zainteresowania: </br>
              <input type="checkbox" name="hobby" value="muzyka"/> Muzyka </br>
              <input type="checkbox" name="hobby" value="malarstwo"/> Malarstwo </br>
              <input type="checkbox" name="hobby" value="czytanie"/> Czytanie </br>
              <input type="checkbox" name="hobby" value="filmy"/> Filmy </br>
              <input type="checkbox" name="hobby" value="podróże"/> Podróże </br>
              <input type="checkbox" name="hobby" value="inne"/> Inne </br>
              
            <?php 
              if(isset($_SESSION['e_hobby']))
              {
                echo '<div class="error">'.$_SESSION['e_hobby'].'</div>';
                unset($_SESSION['e_hobby']);
              }
            ?>
          </fieldset>
        </div>
      </div>
      
			</br>
			<input type="submit" value="Zarejestruj się" />
		</form>
	</body>
</html>
