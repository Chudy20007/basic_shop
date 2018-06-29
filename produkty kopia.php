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
<p style="margin-left:15px;"><input type="submit" value="Wyślij" /></p style>
</form>
<?php
error_reporting(0);
ini_set('display_errors', 0);
$typ=$_POST['produkt'];
$i=0;
$dane = file("pliki/Procesory.txt");
 $ilosc_pozycji=count($dane);  
  $linia = explode( "|", $dane[$i]); 
	?>




<?php
if ($ilosc_pozycji==0) 
 { 
   echo "Brak"; 
   exit; 
 } 
  
   ?>

   

<?php 
 $dane = file("pliki/Procesory.txt"); 
 $ilosc_pozycji=count($dane);  
if ($ilosc_pozycji==0) 
 { 
   echo "Brak"; 
   exit; 
 } 


 for ($i=0; $i<$ilosc_pozycji; $i++) 
{

$linia = explode("|", $dane[$i]); 

?>

<?php

if (isset ($typ) &&($typ == $linia[0])) 
	{	
		echo " <div style=\" height:400px ;width: 370px; background-color: white; float: left; margin:15px\">" ;
	}
$x=0;
	do
	{ 
		if ( isset ($typ) &&($typ == $linia[0]))
		{
			echo"<span style='padding:15px;'>";
			print_r ($linia[$x]);
			echo "</span>";
			echo"</br>";
		}
	$x++;
	} while ($x<10);
if ( isset ($typ) &&($typ == $linia[0]))
{
   echo "</div>"; 
}




else if ($typ == null)
{
echo " <div style=\" height:400px ;width: 370px; background-color: white; float: left; margin:15px\">" ;
	
$x=0;
	do
	{ 
		
			echo"<span style='padding:15px;'>";
			print_r ($linia[$x]);
			echo "</span>";
			echo"</br>";
		
	$x++;
	} while ($x<10);

   echo "</div>"; 

}
}
 ?> 

  


   





	</div>

	<footer id="foo">
	
Autor:<address> Adam Kowalski (a.kowalski@wwx.pl)</address>	
		</footer>	
	</div>

</body>
</html>