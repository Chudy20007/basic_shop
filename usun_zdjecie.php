<?php
error_reporting(0);
ini_set('display_errors', 0);
$wybrany_produkt=stripslashes($_POST['nazwa_produktu']);
session_start();
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

<h4>Witaj na stronie!</h4></br>
<?php

		$serwer = "localhost"; 
		$baza = "sklep"; 
		$log="root";
		$has = "";
		$polaczenie = mysqli_connect($serwer, $log, $has,$baza) or die ("Nie mozna sie 
		polaczyc z serwerem");   
		mysqli_set_charset($polaczenie, "utf8");
		$count = count($wybrany_produkt);

		
		echo$count;
		if ($count>0)
		$opcja=1;
		
	
				if ($_COOKIE['uprawnieniac']=='administrator')
				{
					
							echo "<form  enctype='multipart/form-data' action='usun_zdjecie.php' method='POST'>";
					
							
							switch($opcja)
							{
							
							case 0:
							{	
								$sprawdz="SELECT Nazwa_Produktu, ID_Produktu FROM produkty"; 
								$rekordy = mysqli_query($polaczenie,$sprawdz);
								$dane = mysqli_fetch_assoc($rekordy);			

								echo "Producent: <select name='nazwa_produktu'>
										";								
							do
							{
				
								echo "<option value=".$dane['ID_Produktu'].">".$dane['Nazwa_Produktu']."</option>";
								
							} while ($dane = mysqli_fetch_assoc($rekordy));
							break;
							}
							
							case 1:
							{
								$sprawdz="SELECT * FROM zdjecia WHERE ID_Produktu='$wybrany_produkt'"; 
								$rekordy = mysqli_query($polaczenie,$sprawdz);
								$dane = mysqli_fetch_assoc($rekordy);	
								
							
								
								for($i=0;  $i < $count;$i++)
								{
								echo "Weszlo do fora  $wybrany_produkt";	
								$sprawdz1="DELETE FROM zdjecia WHERE ID_Produktu='$wybrany_produkt'"; 
								$rekordy1 = mysqli_query($polaczenie,$sprawdz1);
								
								
								}
									
								
								echo " Wybierz zdjęcia do usunięcia: <br/><br/>";								
								echo "<select name='nazwa_produktu[]' multiple>
										";		
								do
							{
				
								echo "<option value=".$dane['ID_Zdjecia'].">".$dane['Nazwa_Zdjecia']."</option>";
								
							} while ($dane = mysqli_fetch_assoc($rekordy));
								break;
							}
							
							}

							echo "<input type='submit' value='Usuń' />";
					echo "<br/><br/><br/><br/><br/><br/>";
					echo "<form/>";
					
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