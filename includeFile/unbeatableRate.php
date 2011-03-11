<?php
include"../inc/class/connClass.php";

$conn= new mysqlconnect();
$conn->connect();
$Query ="SELECT destinations, rate FROM temprate WHERE unbeatableRate =1 ORDER BY destinations LIMIT 0 , 4 ";	
$unbeatableRate = mysql_query($Query) or die(mysql_error());				
?>

 <table width="218" border="0" cellspacing="0" cellpadding="0">
            <?php 

		    while($row = mysql_fetch_array($unbeatableRate))
            {			
			?>
			<tr>
            <td class="destination"><?php 
            	list($destinationName,$operator) = split (" ", $row["destinations"]); 
            	printf("%s", $destinationName);
            	?> 
            </td>
            <td class="rates"><?php printf("%-06s", $row["rate"]); ?></td>
            </tr>
			<?php } ?>
</table>

