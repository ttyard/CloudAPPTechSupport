<?php

   $RepairsrecordInsertSQL=sprintf("INSERT INTO `customerrepairsrecord` (`cid`,`opt_uid`,`accept_date`,`qc_id`,`host_ip`,`description`) VALUE('%s','%s','%s','%s','%s','%s')",(int)$_POST['CustomerID'],(int)$_POST['OPTUID'],(string)$_POST['AcceptDateTime'],(int)$_POST['QCID'],(string)$_POST['HostIP'],htmlspecialchars($_POST['Description']));
   echo $RepairsrecordInsertSQL;
?>