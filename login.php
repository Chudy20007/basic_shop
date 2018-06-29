<?php
session_start();
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<link rel="stylesheet" type="text/css" href="style.css" />
	
	<title> Zaloguj</title>
	<script language="JavaScript" src="skrypty.js"> </script>
	<meta name="description" content="Produkty" />
	<meta name="keywords" content="" />
<?php
error_reporting(0);
ini_set('display_errors', 0);
$login=stripslashes($_POST['login']);
$haslo=stripslashes($_POST['haslo']);
$_SESSION['login'] = stripslashes($login);
$_SESSION['haslo'] = stripslashes($haslo);



?>



</head>

		<body>
	
	<div id="container">
			<header id="he">
	 <img src="banner.jpg" class ="image" alt="Banner Image"/>
	
		</header>
	 <nav id="menu">
	 
	 <nav class="option">
	<a href="index.php" style="text-decoration: none;"> Strona główna</a>
	 </nav>
	 
	 	 <nav class="option">
	 <a href="index.php" style="text-decoration: none;">Kontakt</a>
	 </nav>
	 
	 	 <nav class="option">
	 <a href="index.php" style="text-decoration: none;">O nas</a>
	 </nav>
	 
	  <nav class="option">
	 <a href="produkty.php" style="text-decoration: none;">Produkty</a>
	 </nav>
	 
	  <nav class="option">
	<a href="login.php" style="text-decoration: none;"> Zaloguj</a>
	 </nav>
	 
	 	 <nav class="option">
	 <a href="index.php" style="text-decoration: none;">Archiwum</a>
	 </nav>

	 </nav>	
	
			


<div id="center">
	<?php 
	if ($_SESSION['imie']==NULL)
	{
			echo " <div style=\" height:400px ;width: 370px; background-color: #cddef7; float: left; margin:55px\">	
			
					<form action='login.php' method='POST'>
					<br><br>
				Login:	<input type='text' name='login' autofocus placeholder='login'/>
					<br><br>
				Hasło:	<input type='password' name='haslo' autofocus placeholder='hasło'/>
					 <br>  <br>
					<input type='submit' value='Zaloguj' />";
			
			echo "<form/>";
			echo"</div>";
	}
	
		$serwer = "localhost"; 
		$baza = "sklep"; 
		$log="root";
		$has = "";
		$polaczenie = mysqli_connect($serwer, $log, $has,$baza) or die ("Nie mozna sie 
		polaczyc z serwerem");   
		mysqli_set_charset($polaczenie, "utf8");
		
		if ($polaczenie!=NULL)

			$sql = "SELECT * FROM uzytkownicy WHERE haslo='$haslo' AND LOGIN='$login'";//zapytanie sql
				$result=mysqli_query($polaczenie,$sql);//wynik
				
				
		
				if (mysqli_num_rows($result) == 1) //jesli jedna krotka to sukces :D
				{
					$row = $result->fetch_assoc();
					$_SESSION['login'] = $row['Login'];
					$_SESSION['imie'] = $row['Imie'];
					$_SESSION['nazwisko'] = $row['Nazwisko'];
					$_SESSION['uprawnienia'] = $row['Uprawnienia'];
					$cookieuprawnienia=$_SESSION['uprawnienia'];
					$cookieimie=$_SESSION['imie'];
					$cookienazwisko=$_SESSION['nazwisko'];
					setcookie("imiec", $cookieimie, time()+3600);
					setcookie("nazwiskoc", $cookienazwisko, time()+3600);
					setcookie("uprawnieniac", $cookieuprawnienia, time()+3600);
					header("location: login.php");
				
				} 
				
				
				mysqli_close($polaczenie); // Zamknięcie połączenia
	
	
	if ($_SESSION['imie']!=NULL)
	{
		 
		echo " <br> Zalogowany użytkownik: <h4>".$_SESSION['imie']."</h4>";
		
		echo " <div style=\"background-color: #cddef7; float: left; height:50px;\">	
			
					<form action='wyloguj.php' method='POST'>

					<input type='submit' value='Wyloguj' />";
			
			echo "<form/>";
			echo"</div>";
		
	}
	
	?>	
	

	</div>

	<footer id="foo">
	
Autor:<address> Adam Kowalski (a.kowalski@wwx.pl)</address>	
		</footer>	
	</div>

</body>
</html>