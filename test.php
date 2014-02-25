<?php 

	include 'include/config.inc.php';	
	
// 	$DBLink = mysqli_connect(DBHOST, DBUSER, DBPW, DBNAME, 3306);
	
// 	/* check connection */
// 	if (mysqli_connect_errno()) {
// 	    printf("Connect failed: %s\n", mysqli_connect_error());
// 	    exit();
// 	}
	
// 	mysqli_set_charset($DBLink, "utf8");
// // 	mysql_select_db(DBNAME);
// // 	mysql_set_charset(DBCHARSET);

	
//     $result= mysqli_query($DBLink, 'SELECT opt_uid,name FROM optusers');
    
//     while ($row= mysqli_fetch_array($result)) {
    	
	    ?> 
<!-- 	<tr>  
	<td align="center" height="19"><?php echo $row["opt_uid"];?></td> 
	<td align="center"><?php echo $row["name"];?></td> 

	</tr>  -->
	
	<?php 
//     }

//     mysqli_free_result($result);
//     mysqli_close($DBLink);
    
	$DBLINK = new mysqli(DBHOST, DBUSER, DBPW, DBNAME, DBPORT);
	
	if (!$DBLINK) {
		die("数据库连接失败！".$DBLINK->connect_error);
	}
	
	$DBLINK->set_charset(DBCHARSET);
// 	$result = $DBLINK->query('SELECT opt_uid,name FROM optusers');
	
// 	while($row=$result->fetch_row())  {
// 		foreach ($row as $key =>$val) {
// 			echo '--'.$val;
// 		}
// 				echo "\n";

// 	}

// 	$AcceptNameResult=$DBLINK->query('SELECT opt_uid,name FROM optusers');
// 	//$ANaleROW=$AcceptNameResult->fetch_array(MYSQL_ASSOC);
	
// 	while ($ANaleROW=$AcceptNameResult->fetch_array(MYSQL_ASSOC)) {
//         foreach ($ANaleROW as $key => $value) {
// 			echo "$key".'='."$value";
// 			echo "<br/>";     	

//         }

	
// 	}
// 	$AcceptNameResult->free();
	
	
// 	echo "<hr>";
	
// 	//$CustomerBaseInfoSQL=$DBLINK->query('SELECT cid,CompanyName FROM customerbaseinformation');
	
// 	$CustomerNameResult = $DBLINK->query('SELECT cid,CompanyName FROM customerbaseinformation');
	
// 	?>
<!-- 	 <select id="selectError" data-rel="chosen"> -->
		 <?php 
// 		while ($CNROW=$CustomerNameResult->fetch_array(MYSQL_ASSOC)) {
			 
// 			echo '<option value='.$CNROW[cid].'>'.$CNROW[CompanyName].'</option>';
// 		   }
// 		?>
	
<!-- 	</select> -->
	<?php 
	
// 	$t1=$CustomerNameResult->fetch_array(MYSQL_ASSOC);
// 	print_r($t1);	
	
// 	$CustomerNameResult->free();
	
	
	
	
	
	
	$UserResult = $DBLINK->query('SELECT uid,username,Name,Telephone,Mobilephone,Address,Type FROM user');
	$TSTResult=$UserResult->fetch_array(MYSQL_ASSOC);

	while ($TSTResult) {

		print_r($TSTResult);
		echo $TSTResult['uid'];
		break;
	}
	
	
// 	while ($UROW=$UserResult->fetch_array(MYSQL_ASSOC)) {
// 		sprintf("<tr>
// 												<td>%s</td>
// 												<td>%s</td>
// 												<td>%s</td>
// 												<td>%s</td>
// 												<td>%s</td>
// 												<td>%s</td>
// 												<td class=\"center\">
// 													<a class=\"btn btn-info\" href=\"userEdit.php?%s\">
// 													    <i class=\"icon-edit icon-white\"></i> 编辑</a>
// 													<a class=\"btn btn-danger\" href=\"userEdit.php?%s\">
// 														<i class=\"icon-trash icon-white\"></i>删除</a>
// 												</td></tr>",$UROW[username],$UROW[Name],$UROW[Telephone],$UROW[Mobilephone],$UROW[Address],$UROW[Type],$UROW[uid],$UROW[uid]);
// 	}
	
	
	
	$UserResult->free();
	$DBLINK->close();
	
	?>