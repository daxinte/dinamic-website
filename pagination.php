<?php


function pagination($page,$num_page)
{
  echo'<ul style="list-style-type:none;">';
  for($i=1;$i<=$num_page;$i++)
  {
     if($i==$page)
{
 echo'<li style="float:left;padding:5px;">'.$i.'</li>';
}
else
{
 echo'<li style="float:left;padding:5px;"><a href="domeniu.php?id_domeniu=$id_domeniu&page=.$i.">'.$i.'</a></li>';
}
  }
  echo'</ul>';
}