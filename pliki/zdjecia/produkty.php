<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<link rel="stylesheet" type="text/css" href="style.css" />
	
	<title> Produkty</title>
	
	<meta name="description" content="Produkty" />
	<meta name="keywords" content="" />
	




</head>

		<body>
		<?php
error_reporting(0);
ini_set('display_errors', 0);
$typ=$_POST['produkt'];
$i=0;
$licznik=0;
$sortowanie=$_POST['sortuj'];
$pojedyncza;
$dane = file("pliki/Procesory.txt");
$dane_kategorie = file("pliki/Kategorie.txt");
$ilosc_kategorii = count ($dane_kategorie);
$ilosc_pozycji=count($dane);  
$cena_przedmiotow=0;

  ?>
  
  
		<?php
 for ($i=0; $i<$ilosc_kategorii; $i++)
	{
		$linia2=explode("|", $dane_kategorie[$i]);	
		$listarekordow2[$i]=$linia2[$i];
		
	}	
	?>
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
<form name="dane" method="post" action="produkty.php">
<section id="typ" style="margin:15px">
<br>
		Typ produktu 	
	
			<br><br>
			<select name="produkt">
				<?php
				
				
		$l=explode(".",$listarekordow2[0]);
	 for ($i=0; $i<count($l); $i++)
	{
		$l[$i] = strtolower($l[$i]);
		$l[$i][0] = strtoupper($l[$i][0]);			
	  echo"<option >".$l[$i]."</option>";	
	}
		
			
			
			?>
			
			</select>
		
		
</section>	
<section id="typ" style="margin:15px">
Sortuj:
<br><br>
	<select name="sortuj">
<option>rosnąco</option>
<option>malejąco</option>

			</select>
			</section>
<p style="margin-left:15px;"><input type="submit" value="Wyślij" /></p style>
</form>

  <?php
		$serwer = "localhost"; 
		$baza = "sklep"; 
		$log="root";
		$has = "";
		$polaczenie = mysqli_connect($serwer, $log, $has,$baza) or die ("Nie mozna sie 
		polaczyc z serwerem");   
		mysqli_set_charset($polaczenie, "utf8");
		
		if ($polaczenie!=NULL)
		{
			$i=0;
			
			if (isset($sortowanie))
			{
				switch ($sortowanie)
				{
				case "malejąco":
					{
						$s="DESC";
						break;
					}
					
						case "rosnąco":
					{
						$s="ASC";
						break;
					
					}
				}
					
					$sql = "SELECT * FROM produkty LEFT JOIN zdjecia ON produkty.ID_Produktu=zdjecia.ID_Produktu'ORDER BY produkty.Cena ".$s;
								
			}
			
				
			
			if (isset($sortowanie) && isset($typ))
			{
				switch($sortowanie)
				{
					case "malejąco":
					{
						$s="DESC";
						break;
					}
					
						case "rosnąco":
					{
						$s="ASC";
						break;
					
					}
				}
				$sql = "SELECT DISTINCT * FROM produkty LEFT JOIN zdjecia ON produkty.ID_Produktu=zdjecia.ID_Produktu WHERE produkty.Typ ='".$typ."' GROUP BY produkty.ID_Produktu ORDER BY produkty.Cena ".$s;
			}
			
			if (!(isset($sortowanie)) && !(isset($typ)))
			{
			 $sql = " SELECT DISTINCT * FROM produkty LEFT JOIN zdjecia ON produkty.ID_Produktu=zdjecia.ID_Produktu";
			}
				$result=mysqli_query($polaczenie,$sql);//wynik
				$wynik=mysqli_num_rows($result);
				
				$dane= mysqli_fetch_assoc($result);
				$i=0;	
				do
				{
					if ($dane==NULL)
						break;
					$i+=1;
					echo " <div style=\" height:450px ;width: 370px; background-color: white; float: left; margin:15px\">";	
					echo "<form  action='edytuj_produkt.php' method='POST'>";
					
					echo "<input type='hidden' name='edycja' value=".$dane['ID_Produktu'].">";
					echo"<span style='padding:15px;'/>";	
					
					echo '<img src="data:image/jpeg;base64,'.base64_encode($dane['Zdjecie'] ).'" style="width:100px; height:100px; margin:10px;"/>'."";
					echo"<br/><br/>";
					
					echo"<span style='padding:15px;'/>";	
					echo stripslashes($dane['Typ']." ");
					echo"<span style='padding:15px;'>";	
					echo stripslashes($dane['Nazwa_Produktu']);
					echo"<br/><br/>";
					echo"<span style='padding:15px;'/>";	
					echo stripslashes("Cena: ".$dane['Cena']); echo " PLN";
					echo"<br/><br/>";
					echo"<span style='padding:15px;'/>";
					
					
					echo "<details style='margin-left:10px;'>";			

					
					echo " <div style=\"background-color: white; text-align:left; margin:15px\">";	
					echo stripslashes("Ilość sztuk: ".$dane['Ilosc']."<br/>");
					echo stripslashes($dane['Opis']);
					
					echo"</div>";
					echo"<span style='padding:15px;'/>";

					echo"<input type='submit' value='Edytuj' />";
					echo "<form/>";
					echo"</details>";
					echo"</div>";
					
				} while ($dane = mysqli_fetch_assoc($result));
		
					
				
				
				mysqli_close($polaczenie); // Zamknięcie połączenia
		
			
		}

		

	

?>

  





	</div>

	<footer id="foo">
	
Autor:<address> Adam Kowalski (a.kowalski@wwx.pl)</address>	
		</footer>	
	</div>

</body>
</html>