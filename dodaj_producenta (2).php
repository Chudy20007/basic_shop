<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();

$nazwa=stripslashes($_POST['nazwa']);

?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<link rel="stylesheet" type="text/css" href="style.css" />
	
	<title> Sklep</title>
	
	<meta name="description" content="Wizytówka" />
	<meta name="keywords" content="" />

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


<h4>Dodaj producenta</h4>
		<?php
			$serwer = "localhost"; 
		$baza = "sklep"; 
		$log="root";
		$has = "";
		$polaczenie = mysqli_connect($serwer, $log, $has,$baza) or die ("Nie mozna sie 
		polaczyc z serwerem");   
		mysqli_set_charset($polaczenie, "utf8");
		
			if ($_POST['nazwa']!=NULL && $_COOKIE['uprawnieniac']=='administrator')
				{
					$sprawdz="SELECT Nazwa_Producenta FROM producenci WHERE Nazwa_Producenta='$nazwa'"; 
					$rekordy = mysqli_query($polaczenie,$sprawdz);
					if(mysqli_num_rows($rekordy)>0)
					{
					$_POST['nazwa']=NULL;
					header("location:dodaj_producenta.php");
					}
					else
					{
					$sql = "INSERT INTO producenci VALUES ('','$nazwa');";//zapytanie sql
					mysqli_query($polaczenie,$sql);
					header("location:index.php");
					}
				}
				
		
		
			
				?>
				<?php
				if ($_POST['nazwa']==NULL && $_COOKIE['uprawnieniac']=='administrator')
				{
				echo " <div style=\" height:400px ;width: 370px; background-color: #cddef7; float: left; margin:25px\">	
					
							<form action='dodaj_producenta.php' method='POST'>
							<br><br>

						Nazwa:	<input type='text' name='nazwa' autofocus placeholder='produkt'/>
							<br><br>
				
					
						
							<input type='submit' value='Dodaj' />";
					
					echo "<form/>";
					echo"</div>";
				}
				
				
				
	mysqli_close($polaczenie); // Zamknięcie połączenia
		?>
		
	</div>

	<footer id="foo">
	
Autor:<address> Adam Kowalski (a.kowalski@wwx.pl)</address>	
		</footer>	
	</div>

</body>
</html>