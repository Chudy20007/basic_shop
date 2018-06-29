<?php
error_reporting(0);
ini_set('display_errors', 0);
session_start();

$id_prod=stripslashes($_POST['nazwa_produktu']);
$nazwa=stripslashes($_POST['nazwa']);
$ilosc=stripslashes($_POST['ilosc']);
$cena=stripslashes($_POST['cena']);
$opis=stripslashes($_POST['opis']);
$typ=stripslashes($_POST['typ']);
$foto=$_FILES['plik']['tmp_name'];
$fotoname=addslashes (file_get_contents($_FILES['plik']['tmp_name']))

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


<h4>Dodaj produkt</h4>
		<?php
		$serwer = "localhost"; 
		$baza = "sklep"; 
		$log="root";
		$has = "";
		$polaczenie = mysqli_connect($serwer, $log, $has,$baza) or die ("Nie mozna sie 
		polaczyc z serwerem");   
		mysqli_set_charset($polaczenie, "utf8");
		
			if ($_POST['nazwa']!=NULL &&$_COOKIE['uprawnieniac']=='administrator')
				{
					$sprawdz="SELECT Nazwa_Produktu, Opis FROM produkty WHERE Nazwa_Produktu='$nazwa' && Opis='$opis'"; 
					$rekordy = mysqli_query($polaczenie,$sprawdz);
					if(mysqli_num_rows($rekordy)>0)
					{
					header("location:dodaj.php");
					}
					else
					{
			
					
					$sql = "INSERT INTO produkty VALUES ('','$id_prod','$nazwa','$ilosc','$cena','$opis','$typ');";//zapytanie sql
					mysqli_query($polaczenie,$sql);
					
					$sprawdz="SELECT * FROM produkty WHERE Nazwa_Produktu='$nazwa'"; 
					$rekordy = mysqli_query($polaczenie,$sprawdz);
					$dane= mysqli_fetch_assoc($rekordy); 
					$x=$dane['ID_Produktu'];
					$los=rand(999,99999);
					$nazwa=$dane['ID_Producenta']."_".$dane['ID_Produktu']."_".$los;
					$sql2 = "INSERT INTO zdjecia VALUES ('','$id_prod','$x','$fotoname','$nazwa');";//zapytanie sql
					mysqli_query($polaczenie,$sql2);//wykonanie zapytania			
					header("location:produkty.php");
					}
				}
				
		
		
				if ($polaczenie!=NULL &&$_POST['nazwa']==NULL)
		{
				$i=0;
				$sql = "SELECT * FROM producenci";
				$result=mysqli_query($polaczenie,$sql);//wynik
				$wynik=mysqli_num_rows($result);
				
				$dane= mysqli_fetch_assoc($result); 
				
			
		}
				?>
				<?php
				if ($_POST['nazwa']==NULL && $_COOKIE['uprawnieniac']=='administrator')
				{
				echo " <div style=\" height:400px ;width: 370px; background-color: #cddef7; float: left; margin:25px\">	
					
							<form  enctype='multipart/form-data' action='dodaj.php' method='POST'>
							<input type='hidden' name='MAX_FILE_SIZE' value='100000'>
							 Wyslij plik: <input name='plik' type='file'> 
							<br><br>
							Producent: <select name='nazwa_produktu'>
							";
							
							do
							{
								echo "<option value=".$dane['ID_Producenta'].">".$dane['Nazwa_Producenta']."</option>";
								
							} while ($dane = mysqli_fetch_assoc($result));
							
							echo"
							</select>
							
							<br><br>
						Nazwa:	<input type='text' name='nazwa' autofocus placeholder='produkt'/>
							<br><br>
						Ilość:	<input type='text' name='ilosc' autofocus placeholder='0'/>
							 <br>  <br>
							 
							 Cena:	<input type='text' name='cena' autofocus placeholder='0'/>
							<br><br>
						Opis:	<input type='text' name='opis' autofocus placeholder='opis'/>
							 <br>  <br>
							 
						Typ:	<input type='text' name='typ' autofocus placeholder='np. Procesor'/>
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