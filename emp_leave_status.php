<?php @session_start(); ?>
<?php 
require("database/dbconnect.php"); 
require("database/emp_sessionexpiry.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/site.css" rel="stylesheet" />
<title><?php print($Title); ?></title>
<link rel="shortcut icon" href="favicon.ico" >
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style>
</head>
<?php
$admin_id = $_SESSION["admin_id"];
$stid = $_REQUEST["stid"];
$emp_id=$_REQUEST["emp_id"];
$approval1=$_REQUEST["Approval1"];

?>
<body>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php //require("admin_header.php"); ?></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="1" class="table_border_clr1">
        <tr>
          <td align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="table_border_clr2">
              <tr>
                <td width="21%" align="left" valign="top"><?php require("emp_side_menu.php");?></td>
                <td width="0%" align="center" valign="top" bgcolor="#2597DF">&nbsp;</td>
                <td width="79%" align="center" valign="top"><table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="Button_Show_Map">: : View Employees Leave Status: :</td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td align="center" class="Alert_Msg"><?PHP echo $msg?></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><table width="100%" border="0" cellpadding="0" cellspacing="1" class="table_border_clr1">
                                <tr>
                                  <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_border_clr2">
                                      <tr>
                                        <td><form id="form1" name="form1" method="post" action="">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr class="table_border_clr1">
                                                <td colspan="2" align="left"><strong>&nbsp;Leave Id </strong></td>
                                                <td width="392" align="center" ><strong> Reason </strong></td>
                                                <td width="208" align="center" ><strong>Status</strong></td>
                                              </tr>
                                              <?php
											  $PgNo="";
 	
 	$PageSize = 15;
	$StartRow = 0;
  
	if(empty($_GET['PageNo'])){
	    if($StartRow == 0){
	        $PageNo = $StartRow + 1;
	    }
	}else{
	    if ($PgNo != "")
	    {	 $PageNo=1; }
 	    else
 	    {
	    	 $PageNo = $_GET['PageNo'];
	    	 $StartRow = ($PageNo - 1) * $PageSize;
    	}
	}

	if($PageNo % $PageSize == 0){
	    $CounterStart = $PageNo - ($PageSize - 1);
	}else{
	    $CounterStart = $PageNo - ($PageNo % $PageSize) + 1;
	}
	$CounterEnd = $CounterStart + ($PageSize - 1);

	$strsql = ("SELECT elt_id,reason,lstatus FROM emp_leave_tbl WHERE emp_id='".$_SESSION['emp_id']."'");
	//$sql_row=mysql_fetch_row($strsql);

	$TRecord = @mysql_query($strsql);
    $result = @mysql_query($strsql . " LIMIT $StartRow,$PageSize");
    $RecordCount = @mysql_num_rows($TRecord);

	if ($RecordCount == "")
   		{ $RecordCount = 0; }
   		
	 $MaxPage = $RecordCount % $PageSize;

	 if($RecordCount % $PageSize == 0){
	    $MaxPage = $RecordCount / $PageSize;
	 }else{
	  $MaxPage = ceil($RecordCount / $PageSize);
 		}
     if (@mysql_numrows($result)==0)
 		{
		 	 if (isset($_GET["PageNo"]))
		 	 {
	 	 	  if ($_GET["PageNo"]>1)
 			  	{ 
				  print("<script>location.href='view_emp_leave.php?PageNo=".($_GET["PageNo"]- 1)."';</script>");
			 	  exit(); 
				}
			 }
	  }
	  $Purl="view_emp_leave.php?";
				$i = 0;
				if ($RecordCount>0)
				 {
					while ($sql_row = @mysql_fetch_array($result)) 
					 {
					 //$i = $i + 1;
						 if($sql_row[2]=='Admin Approved')
						{
						   $pr= "Leave Request Approved";
						}
						else if($sql_row[2]=='Admin Rejected')
						{
						    $pr="Leave Request Rejected!";
						}	
						else if($sql_row[2]=='New')
						{
						    $pr="Pending Approval";
						}					 
					?>
                                              <tr>
                                                <td width="12" align="left">&nbsp;</td>
                                                <td width="83" align="left"><?PHP echo $sql_row[0]?></td>
                                                <td align="center">&nbsp;<?PHP echo $sql_row[1]?></td>
                                                <td align="center"><?PHP echo $pr?></td>
                                              </tr>
                                              <?php
												}
												}
												else
												{
												?>
                                              <tr>
                                                <td colspan="2">&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                              </tr>
											  <?php 
											  } 
											  ?>
                                            </table>
                                          </form></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                          <td class="Pagination"><?php pagination($RecordCount,$CounterStart,$CounterEnd,$PageNo,$MaxPage,$PageSize,$Purl);       ?>                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><?php //require("admin_footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
<script language="javascript">
function RecEdit(ld)
{
	document.form1.action="emp_tl_leave_request.php?lid="+ ld;
	document.form1.submit();
}
</script>