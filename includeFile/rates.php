
<html>

<head>

	<link rel="stylesheet" type="text/css" media="screen,print" href="../rezalib/css/reset.css" />
	
	
	<style>
	
	
		html, body { color:#333333; font:12px/18px Verdana,sans-serif !important; margin-left:auto; margin-right:auto; text-align: center; }
		
		
		#intrates {width:680px; border: 1px solid #bec9d5; border-width:0 0 0 0; font:12px/18px Verdana,sans-serif; margin-left:auto;margin-right:auto;text-align:center;}
		#intrates td {height:30px; vertical-align:middle; padding-left:10px; border-bottom:1px solid #bec9d5;}
		#intrates tr:hover {backgroud:white; color:red}
		#intrates .alt {background-color:#f1f1f1}
		#intrates .alt2 {background-color:#e9f0f9}
		#intrates th, #intratesHead th {color:#FFF; font-weight:bold; height:30px; vertical-align:middle; padding-left: 10px; border-bottom: 1px solid #bec9d5 }
		
		
		#intratesHead {border: solid #bec9d5; border-width: 1px 1px 0 1px; height:40px;}
		#intratesHead th {color:#FFF; font-weight:bold; height:40px;  vertical-align:middle; background:url(images/bg_th.png) repeat-x;}
		#intratesHead tr:hover {backgroud:white; color:red}
		
		#intrate-sort {float: left; display:block; margin: 0; padding: 0; width: 335px; padding-left: 15px;}
		#intrate-sort a {color:#e77200; text-decoration:none; padding-right: 5px;}
		#intrate-sort a:hover{color:#FF7200; text-decoration:none; padding-right: 5px;}
		
		#intrate-search {width:699px; margin-bottom:5px; padding:10px; background:url(images/intrates_search.png) no-repeat; height:77px; font-family:Verdana, sans-serif;}
		#intrate-search form{float:left; }
		#intrate-search .textfield{margin-right:5px; padding:5px 2px; border-top:1px solid #ccc; border-left:1px solid #ccc; border-bottom:none; border-right:none; background:#fff; width:200px}
		#intrate-search label, #intrate-search .label{margin-bottom:5px; display:block}
		#intrate-search #sort-links{line-height:30px}
		
		#intrate-search .showall{border:solid #ccc; border-width:0 1px; background:none; line-height:30px; margin:0 5px; color:#007ac0; font-family:Verdana, sans-serif; width:70px; text-align:center}
		#intrate-search .showall:hover{color:#e77200; cursor:pointer}
		
	
		#intrates_div {overflow-y: scroll; width: 700px; height:380px; position: relative; margin:0; padding:0;}	
		
		#intcontainer {margin-left:auto; margin-right:auto; text-align: center; width: 700px; z-index: 1; margin:0; padding:0;}
			
		
		/*a { color:#007AC0; cursor:pointer; text-decoration:none; }*/
	
	</style>    
</head>

<body>


<div id="intcontainer">
      
	<div align="left" id="intrate-search">


    	<form action="rates.php" method="post" name="search">
        	<label style="align:left;">Search by Country or Dial Code:</label>
            <input class="textfield" name="keyword" />
            <input type="hidden" value="search" name="function" />
            <input align="absbottom" type="image" value="Search" src="images/button_search_black.png" />
        </form>
		<div id="intrate-sort"><div class="label">Jump to Letter:</div><div id="sort-links">
	        	<a href="rates.php?sort=a">A</a><a href="rates.php?sort=b">B</a><a href="rates.php?sort=c">C</a><a href="rates.php?sort=d">D</a><a href="rates.php?sort=e">E</a><a href="rates.php?sort=f">F</a><a href="rates.php?sort=g">G</a><a href="rates.php?sort=h">H</a><a href="rates.php?sort=i">I</a><a href="rates.php?sort=j">J</a><a href="rates.php?sort=k">K</a><a href="rates.php?sort=l">L</a><a href="rates.php?sort=m">M</a><a href="rates.php?sort=n">N</a><a href="rates.php?sort=o">O</a><a href="rates.php?sort=p">P</a><a href="rates.php?sort=q">Q</a><a href="rates.php?sort=r">R</a><a href="rates.php?sort=s">S</a><a href="rates.php?sort=t">T</a><a href="rates.php?sort=u">U</a><a href="rates.php?sort=v">V</a><a href="rates.php?sort=w">W</a><a href="rates.php?sort=y">Y</a><a href="rates.php?sort=z">Z</a></div>
		</div> <!-- end intrate-sort -->  
		
		
	</div> <!-- end intrate-search -->

	
	<table width="100%" cellspacing="0" cellpadding="0" border="0" id="intratesHead">
		<tr>
        	<th width="250px" align="center" scope="col">Country</th>
            <th scope="col" align="center">Code</th>
            <th scope="col" align="center">Rate/Min</th>
        </tr>   
    </table>
									                                        
	<?php 
			include"../inc/class/search.php";
									
            $dal = new DAL();
						
			$getsearchword= $_GET["sort"];

			if($getsearchword) {	
				
				$sort=TRUE;
				$results = $dal->get_models($getsearchword,$sort);
				displayResult($results);
			}
			else {	
				
				$getsearchword=$_POST["keyword"];
				if($getsearchword=="") {			 
					
					foreach(range('a', 'z') as $letter) {
						
						$sort=TRUE;
						$results = $dal->get_models($letter,$sort);	
						$totalResul= count($results);	 
												   
						displayResult($results);
						if($results >=0) {
							break;
						}
											 
					} // end foreach
				} 
				else {
				
					$sort=FALSE;
					$results = $dal->get_models($getsearchword,$sort);
					displayResult($results);		
				}
			}

	?>                                                                                                                                                          
	<?php 

    function displayResult($results) {

	?>

	<div id="intrates_div">                                      
	
	<table cellspacing="0" cellpadding="0" border="0" id="intrates">
			<?php
		    	if ($results) { 	
		        
					foreach ($results as $model) {
		    ?>
		
				<tr class="alt" >
		    		<td width="250px" scope="col" align="left"><?php echo $model->destinations; ?></td>
		     	    <td align="center" scope="col"><?php echo $model->areaCodes; ?></td>
					<td align="center" scope="col"><?php printf("%-06s", $model->rate); ?></td>
		    	</tr>
			<?php
		            }
		        }
		    ?>
    	</table>      
	
	<?php
    } 		
    ?>                                                                                                                     
     
     </div> <!-- end table_div -->                                


</div>


</body>
</html>