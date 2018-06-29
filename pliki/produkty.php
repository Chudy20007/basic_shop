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
		
	<div id="container">
			<header id="he">
	 <img src="banner.jpg" class ="image" alt="Banner Image"/>
	
		</header>
	 <nav id="menu">
	 
	 <nav class="option">
	<a href="index.html" style="text-decoration: none;"> Strona główna</a>
	 </nav>
	 
	 	 <nav class="option">
	 <a href="index.html" style="text-decoration: none;">Kontakt</a>
	 </nav>
	 
	 	 <nav class="option">
	 <a href="index.html" style="text-decoration: none;">O nas</a>
	 </nav>
	 
	  <nav class="option">
	 <a href="produkty.php" style="text-decoration: none;">Produkty</a>
	 </nav>
	 
	 	 <nav class="option">
	<a href="index.html" style="text-decoration: none;"> Inne</a>
	 </nav>
	 
	 	 <nav class="option">
	 <a href="index.html" style="text-decoration: none;">Archiwum</a>
	 </nav>

	 </nav>	
		
			
		
			


<div id="center">
<form name="dane" method="post" action="produkty.php">
<section id="typ" style="margin:15px">
<br>
		Typ produktu 	
	
			<br><br>
			<select name="produkt" size="3">
			<option >Procesor</option>
			<option>RAM</option>
			<option>Karta</option>
			
			</select>
		
		
</section>	
<section id="typ" style="margin:15px">
Sortuj:
<br><br>
	<select name="sortuj" size="2">
			<option >rosnąco</option>
			<option>malejąco</option>	
			</select>	
			</section>
<p style="margin-left:15px;"><input type="submit" value="Wyślij" /></p style>
</form>
<?php
error_reporting(0);
ini_set('display_errors', 0);
$typ=$_POST['produkt'];
$i=0;
$licznik=0;
$sortowanie=$_POST['sortuj'];
$pojedyncza;
$dane = file("pliki/Procesory.txt");
 $ilosc_pozycji=count($dane);  

  ?>
  <?php
	 for ($i=0; $i<$ilosc_pozycji; $i++)
	{
		$linia=explode("|", $dane[$i]);	
		$listarekordow[$i]=
		 array('TYP'=>$linia[0],'MODEL'=>$linia[1],'CENA'=>$linia[2],'OBRAZ'=>$linia[3],'OPIS1'=>$linia[4],'OPIS2'=>$linia[5],'OPIS3'=>$linia[6],'OPIS4'=>$linia[7],'OPIS5'=>$linia[8],'OPIS6'=>$linia[9]);
	}	
$i=0;




	
if ($sortowanie=='rosnąco')
{
	foreach ($listarekordow as $klucz => $wiersz) 
	{
		$numer[$klucz]  = $wiersz['CENA'];
		$edycja[$klucz] = $wiersz['MODEL'];
	}
array_multisort($numer, SORT_ASC, $edycja, SORT_DESC, $listarekordow);
}

else
if ($sortowanie=='malejąco')
{
	foreach ($listarekordow as $klucz => $wiersz) 
	{
		$numer[$klucz]  = $wiersz['CENA'];
		$edycja[$klucz] = $wiersz['MODEL'];
	}
array_multisort($numer,SORT_DESC , $edycja ,SORT_ASC, $listarekordow);
}	


	do
	{
if ($listarekordow[$i]['TYP']==$typ)
{
	

	echo " <div style=\" height:400px ;width: 370px; background-color: white; float: left; margin:15px\">";	
			 foreach ($listarekordow[$i] as $klucz => $wartosc)  
			  { 
				echo"<span style='padding:15px;'>";		
				echo $wartosc; 	
				
				   if ($klucz=='CENA')
				   {
					   echo " PLN";
				   }
			   
				echo "<br>";  			   
				echo "</span>";   
			  } 
	echo"</div>";
	
}

else if ($typ==null)
{
	echo "<div style=\" height:400px ;width: 370px; background-color: white; float: left; margin:15px\">";	
			 foreach ($listarekordow[$i] as $klucz => $wartosc)  
			  { 
				echo"<span style='padding:15px;'>";		
				echo $wartosc; 	
				
				   if ($klucz=='CENA')
				   {
					   echo " PLN";
				   }
			   
				echo '<br>';  			   
				echo "</span>";   
			  } 
	echo"</div>";
}
$i++;
	} while ($listarekordow[$i]!=null);
	
echo "<br><br>";

?>

  





	</div>

	<footer id="foo">
	
Autor:<address> Adam Kowalski (a.kowalski@wwx.pl)</address>	
		</footer>	
	</div>

</body>
</html>