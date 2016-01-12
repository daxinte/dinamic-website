<?php
session_start();
include("conectare.php");
include("page_top.php");
include("meniu.php");
$id_domeniu = $_GET['id_domeniu'];
$sqlNumeDomeniu = "SELECT nume_domeniu FROM domenii WHERE id_domeniu=".$id_domeniu;
$resursaNumeDomeniu = mysql_query($sqlNumeDomeniu) or die(mysql_error()); 
$numeDomeniu = mysql_result($resursaNumeDomeniu, 0,'nume_domeniu');
?>
<td valign="top">
<h1>Domeniu <?=$numeDomeniu?></h1>
<b>Carti in domeniu</b>
<u><i><?=$numeDomeniu?></i></u>:</b>
<table cellpadding="5">

<?php
$rec_limit = 2;

if( isset($_GET['page'] ) ) {
            $page = $_GET['page'];
            $offset = $rec_limit * ($page - 1);
         }else {
            $page = 1;
            $offset = 0;
         }
         echo $page,"|",$offset;
         // die;
$sql = "SELECT
  id_carte,
  titlu,
  descriere,
  pret,
  nume_autor
FROM
  carti,
  autori,
  domenii
WHERE
  carti.id_domeniu = domenii.id_domeniu AND carti.id_autor = autori.id_autor AND domenii.id_domeniu = $id_domeniu 
  LIMIT $rec_limit OFFSET $offset";

  //select carti unde id_domeniu = $id_domeniu, pornind de la $offset, nr de carti = $rec_limit
$resursa = mysql_query($sql) or die(mysql_error());

while ($row = mysql_fetch_array($resursa)) 
{
		
	print '<tr>
				<td align="center">';
			
					$adresaImagine = "coperte".$row['id_carte'].".jpg";
					if(file_exists($adresaImagine))
					{
					print '<img src="'.$adresaImagine.'"
					width="75" height="100"><br>';
					}
					else
					{
					print '<div style="width:75px; height:100px; border: 1px black solid; background-color:#cccccc">
					Fara imagine</div>';
					}
					
						print '</td>
									<td>
										<b><a href="carte.php?id_carte='.
										$row['id_carte'].'">'.$row['titlu'].'</a></b><br> de
										<i>'.$row['nume_autor'].'</i>
										<br>Pret: '.$row['pret'].' lei
									</td></tr>';
					

		
}
							
				print'</tr>	
			</table>

		</td>';


include("page_bottom.php");

$q = "SELECT COUNT(titlu) as 'total' FROM carti WHERE id_domeniu=".$id_domeniu;
$total_carti = mysql_fetch_array(mysql_query($q));
$total_carti = $total_carti['total'];	
$num_page=ceil($total_carti/$rec_limit);
if ($page>1) 
{
	echo "<a href='domeniu.php?id_domeniu=$id_domeniu&page=1'>".'|<'."</a> "; // Goto 1st page 
}


for ($i=1; $i<=$num_page; $i++) 
{ 
	if ($page==$i) 
			
			{
            	echo " <b>$i</b> "; 
            }
            else { echo "<a href='domeniu.php?id_domeniu=$id_domeniu&page=".$i."'>".$i."</a> ";}

           

};
if ($page<$num_page) 
{
	echo "<a href='domeniu.php?id_domeniu=$id_domeniu&page=$num_page'>".'>|'."</a> "; // Goto last page
	}






	/* Setup page vars for display. */
								//$prev = $page - 1; //previous page is current page - 1
								//$next = $page + 1; //next page is current page + 1
								 //if( $page > 1 ) {
 		//print '
 		//			<tr align="center">';
		//	            print "<a href = \"domeniu.php?id_domeniu=$id_domeniu&page=$prev\">Last 2 Records</a> |";
		//	            print "<a href = \"domeniu.php?id_domeniu=$id_domeniu&page=$next\">Next 2 Records</a>";
		//		         }else if( $page == 1 ) 
		//		         {
		//		            print "<a href = \"domeniu.php?id_domeniu=$id_domeniu&page=$next\">Next 2 Records</a>";
		//		         }

?>
<form action="domeniu.php" method="POST">
	<table>
	<tr>
		<td>
			<select id= "rec_limit" name = 'rec_limit' style = 'position: relative' value="">
				  <option value="1">1</option>
				  <option value="2" selected="selected">2</option>
				  <option value="3">3</option>
			</select>
		</td>
	</tr>
</table>
</form>

<?php
$rec_limit=isset($_POST['rec_limit'])?$_POST['rec_limit']:null;
?>