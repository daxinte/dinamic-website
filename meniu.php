<?php
$id_domeniu=isset($_POST['id_domeniu'])?$_POST['id_domeniu']:null;
?>
<td valign="top" width="125">

<div>
<b>Alege domeniul</b>	
<?php
	//$sql = "SELECT * FROM domenii ORDER BY nume_domeniu ASC";
	
	//$sql = "SELECT domenii.id_domeniu, domenii.nume_domeniu, COUNT(id_carte) as nr_carti from domenii, carti where carti.id_domeniu = domenii.id_domeniu GROUP BY domenii.id_domeniu";
	$sql = "SELECT d.id_domeniu, d.nume_domeniu, COUNT(c.id_carte) as nr_carti FROM domenii d LEFT JOIN carti c ON c.id_domeniu = d.id_domeniu GROUP BY d.id_domeniu";

	$resursa = mysql_query($sql) or die(mysql_error());
	while($row = mysql_fetch_array($resursa)) {
		// echo "<pre>";
		// print_r($row);
		print'<a href="domeniu.php?id_domeniu='.$row['id_domeniu'].'">'.$row['nume_domeniu'].' ('.$row['nr_carti'].')</a><br>';
	}

?>

</div>
<br>
<div>
	<form action="cautare.php" method="GET">
	<b>Cautare</b><br>
	<INPUT type="text" name="cuvant" size="12"><br>
	<INPUT type="submit" value="Cauta">	


	</form>
	


</div>
<br>
<div style="width:120px; background-color:#F9F1E7; padding:4px; border:solid #632415 1px">
<b>Cos</b><br>


<?php

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
// echo $nrCarti = !isset($_SESSION['nr_buc']) ? 0 : $_SESSION['nr_buc'];
$nrCarti = 0;
$totalValoare = 0;
if(isset($_SESSION["titlu"])) {
	for ($i=0; $i < count($_SESSION['titlu']) ; $i++) { 
		$nrCarti += $_SESSION['nr_buc'][$i];
		$totalValoare =$totalValoare + $_SESSION['nr_buc'][$i] * $_SESSION['pret'][$i];
	}	
}


?>
Aveti <b><?=$nrCarti?></b> carti in cos, in valoare totala de <b><?=$totalValoare?></b> lei.
<a href="cos.php">Click aici pentru a vedea continutul cosului</a>


 


</div>
</td>
