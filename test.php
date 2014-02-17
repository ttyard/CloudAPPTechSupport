<?php 

	include 'include/config.inc.php';	
	
	$DBLink = mysqli_connect(DBHOST, DBUSER, DBPW, DBNAME, 3306);
	
	/* check connection */
	if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
	
	mysqli_set_charset($DBLink, "utf8");
// 	mysql_select_db(DBNAME,$DBLink);
// 	mysql_set_charset(DBCHARSET,$DBLink);

	
    $result= mysqli_query($DBLink, 'SELECT opt_uid,name FROM optusers');
    
    while ($row= mysqli_fetch_array($result)) {
    	
	    ?> 
	<tr> 
	<td align="center" height="19"><?php echo $row["opt_uid"];?></td> 
	<td align="center"><?php echo $row["name"];?></td> 
	</tr> 
	
	<?php 
    }

    mysqli_free_result($result);
    mysqli_close($DBLink);
    
	
	?>