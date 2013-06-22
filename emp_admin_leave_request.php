<?php @session_start(); ?>
<?php 
require("database/dbconnect.php"); 
require("database/admin_sessionexpiry.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/site.css" rel="stylesheet" />
<SCRIPT LANGUAGE="JavaScript" SRC="../javascript/CalendarPopup.js"></SCRIPT>
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
$re=$_REQUEST["re"];
$ad=$_REQUEST["a"];
$lid=$_REQUEST["lid"];
$fname=$_REQUEST["fname"];
$fdate=$_REQUEST["fdate"];
$tdate=$_REQUEST["tdate"];
$ndays=$_REQUEST["ndays"];
$ltype=$_REQUEST["leave_type"];
$reason=$_REQUEST["reason"];

if($ad == '' && $lid > 0)
 {
$query=@mysql_query("SELECT a.from_date,a.to_date,b.e_fname,b.e_mname,b.e_lname,a.reason FROM employee_master b,emp_leave_tbl a WHERE a.elt_id='".$lid."' AND a.emp_id=b.em_id");
$mysql_row = mysql_fetch_row($query);
		$fdate=$mysql_row[0];
		$tdate=$mysql_row[1];
		$fname=$mysql_row[2];
		$mname=$mysql_row[3];
		$lname=$mysql_row[4];
		$reason=$mysql_row[5];
		}
else if($ad=='1' && $lid > 0)
	{
	$query=@mysql_query("SELECT a.from_date,a.to_date,b.e_fname,b.e_mname,b.e_lname,a.reason FROM employee_master b,emp_leave_tbl a WHERE a.elt_id='".$lid."' and a.emp_id=b.em_id");
$mysql_row = mysql_fetch_row($query);
		$fdate=$mysql_row[0];
		$tdate=$mysql_row[1];
		$fname=$mysql_row[2];
		$mname=$mysql_row[3];
		$lname=$mysql_row[4];
		$reason=$mysql_row[5];
		
	 $result=@mysql_query("Update emp_leave_tbl set lstatus='Admin Approved', admin_date='".date('y/m/d')."' where elt_id='".$lid."'");
	 
		if($result)
		{
			$msg ="Employee Leave Approval successfully!";
		}
		else
		{
			$msg ="Error. Please try again later!";
		}
	}
else if($re == 1 && $lid > 0 && $ad ==0)
	{
	$query=@mysql_query("SELECT a.from_date,a.to_date,b.e_fname,b.e_mname,b.e_lname,a.reason FROM employee_master b,emp_leave_tbl a WHERE a.elt_id='".$lid."' and a.emp_id=b.em_id");
echo "listed";
$mysql_row = mysql_fetch_row($query);
	
		$fdate=$mysql_row[0];
		$tdate=$mysql_row[1];
		$fname=$mysql_row[2];
		$mname=$mysql_row[3];
		$lname=$mysql_row[4];
		$reason=$mysql_row[5];
		
 	$res=@mysql_query("Update emp_leave_tbl set lstatus='Admin Rejected', admin_date='".date('y/m/d')."' where elt_id='".$lid."'");
	if($res)
	{
		$msg ="Employee Leave Rejected!";
    }
 else
	{
		$msg ="Error. Please try again later!";
    }
 }
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
                <td width="21%" align="left" valign="top"><?php require("admin_side_menu.php");?></td>
                <td width="0%" align="center" valign="top" bgcolor="#2597DF">&nbsp;</td>
                <td width="79%" align="center" valign="top"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="Button_Show_Map">: : Leave Request: :</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td width="100%" align="center" class="Alert_Msg"><?PHP echo $msg?></td>
                          </tr>
                          <tr>
                            <td align="center" class="Alert_Msg">&nbsp;</td>
                          </tr>
                             <tr>
                            <td><form id="form3" name="form3" method="post" action="emp_admin_leave_request.php?a=1">
                              <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
                                <tr>
                                  <td><table width="100%" border="1" cellpadding="4" cellspacing="2" bordercolor="#CCCCCC">
                                    <tr>
                                      <td width="22%" align="right"><strong>Employee Name : </strong></td>
                                      <td colspan="3"><strong>&nbsp;
                                            <?PHP echo $fname ?>&nbsp;<?PHP echo $mname ?>&nbsp;<?PHP echo $lname ?>
                                           <input type="hidden" name="lid" value="<?PHP echo $lid?>"  id="lid"/>
                                      </strong></td>
                                    </tr>
                                
                                    <tr>
                                      <td colspan="4"><table width="100%" border="0" cellspacing="2" cellpadding="2">

                                        <tr>
                                          <td colspan="2" align="right"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                      <td width="30%" align="right">From :&nbsp; </td>
                                      <td width="26%"><input name="sdate" type="text" id="sdate"  value="<?PHP echo $fdate?>" size="15" maxlength="20" readonly="readonly"/></td>
                                      <td width="8%" align="right">To :&nbsp; </td>
                                      <td width="36%"><input name="tdate" type="text" id="tdate"  value="<?PHP echo $tdate?>" size="15" maxlength="20" readonly="readonly"/></td>
                                    </tr>
                                          </table></td>
                                          </tr>
                                        <tr>
                                          <td width="30%" align="right">Reason for leave request : </td>
                                          <td width="70%"><textarea name="lreason" rows="6" readonly="readonly" id="pdetail"><?PHP echo $reason?>
                                                    </textarea></td>
                                        </tr>
                                        <tr>
                                          <td align="right">&nbsp;</td>
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td align="right">&nbsp;</td>
                                          <td><input type="submit" name="Submit2" value="Approve Leave" />
                                          <input type="button" name="Submit23" value="Disapprove or Reject Leave" onclick="rejectFrm()"/></td>
                                        </tr>
                                      </table></td>
                                      </tr>
                                  </table></td>
                                </tr>
                              </table>
                            </form>                            </td>
                          </tr>
                          
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                          <td class="Pagination"> </tr>
                          <tr>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>
					  </td>
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
function rejectFrm()
{
document.form3.action='emp_admin_leave_request.php?re=1&a=0';
document.form3.submit();
}
</script>