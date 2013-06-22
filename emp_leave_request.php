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
$admin_id = $_SESSION["admin_id"];
$add = $_REQUEST["a"];
$fdate = $_REQUEST["fdate"];
$tdate= $_REQUEST["tdate"];
$emp_id = $_REQUEST["emp_id"];
$sdate = $_REQUEST["sdate"];
$tdate = $_REQUEST["tdate"];
$sel_leav = $_REQUEST["sel_leav"];
$no_days = $_REQUEST["no_days"];
$lreason = $_REQUEST["lreason"];

$add_date = date("d/m/Y");
$add_time = date("g: i a");

$stid = $_REQUEST["stid"];

$emp_name = "";
if($stid > 0 && $add == 1)
{
	//$strsql = @mysql_query("Update time_sheet set working_hours='". $whours ."',work_name='". $nm_work ."',project_desc='". $pdetail ."',num_records='". $nrecords ."',day_status='1' where actual_date='". $sdate ."' and emp_id='". $stid ."' and serial_no='". $serial_no ."'");
	$stid = $_REQUEST["stid"];
	$strsql = @mysql_query("Update");
	$row = mysql_fetch_row($strsql);
	if(!$row)
	{
		$strsql = mysql_query("Insert into time_sheet(emp_id,serial_no,add_date,add_time,actual_date,working_hours,work_name,project_desc,num_records,day_status) values('". $stid ."','". $serial_no ."','". $add_date ."','". $add_time ."','". $sdate ."','". $whours ."','". $nm_work ."','". $pdetail ."','". $nrecords ."','1')");
		$msg = "Time Sheet Added Successfully !";
	}
	else
	{
		$strsql = mysql_query("Update time_sheet set working_hours='". $whours ."',work_name='". $nm_work ."',project_desc='". $pdetail ."',num_records='". $nrecords ."',day_status='1' where actual_date='". $sdate ."' and emp_id='". $stid ."' and serial_no='". $serial_no ."'");
		$msg = "Time Sheet Updated Successfully !";		
	}	
}
if($stid > 0 && $add == 2)
{
	$strsql = @mysql_query("Delete from time_sheet where emp_id='". $stid ."' and actual_date='". $sdate ."' and serial_no='". $serial_no ."'");
	//$msg = "Record Deleted Successfully!";
	print("<script>alert('Record Deleted Successfully!');document.location.href='time_sheet.php?a=1&emp_id=". $stid ."&fdate=". $fdate ."&tdate=". $tdate ."';</script>");
}

//print($sdate ."&nbsp;".$tdate ."&nbsp;". $whours);
if($edit == 1)
{
	$sdate = $_REQUEST["sdate"];
	//$whours = $_REQUEST["nr"];	
    $strsql = @mysql_query("Select e_fname,e_mname,e_lname from employee_master where em_id = '". $stid ."'");
	$row = mysql_fetch_row($strsql);
	if($row)
	{
		$emp_name = $row[0] ."&nbsp;".$row[1]."&nbsp;".$row[2];
	}
	$strsql = @mysql_query("Select actual_date,working_hours,work_name,project_desc,num_records,day_status from time_sheet where actual_date='". $sdate ."' and emp_id='". $stid ."' and serial_no='". $serial_no ."'");
	$row = mysql_fetch_row($strsql);
	if($row)
	{
		$sdate = $row[0];
		$whours = $row[1];
		$nm_work = $row[2];
		$pdetail = $row[3];
		$nrecords = $row[4];			
	}
	else
	{
		$whours = "";
		$nm_work = "";
		$pdetail = "";
		$nrecords = "";	
	}
}

if($show == '1' && $hf_emp_id > 0)
{
	$month_n = $_REQUEST["month_n"];
	$strsql = mysql_query("Select b_target from base_target where emp_id='". $hf_emp_id ."' and month_name='". $month_n ."'");
	$row = mysql_fetch_row($strsql);
	if($row)
	{
		$basetarget = $row[0];
	}
	
	$tmtarget = '';
	$strsql = mysql_query("Select sum(num_records) from time_sheet where emp_id='". $hf_emp_id ."' and Date_format(actual_date,'%M-%Y')='". $month_n ."'");
	$row = mysql_fetch_row($strsql);
	if($row)
	{
		$tmtarget = $row[0];
	}
}
$Atdwidth = '0';
$UAtdwidth = '0';
$cdue = $tmtarget - $basetarget;

//if($cdue <= 0) { $cdue = '- -'; } 

if ($basetarget > 0 &&  $tmtarget > 0 ) {
$Atdwidth = ($tmtarget * 100)/$basetarget;
$UAtdwidth = ($cdue * 100)/$basetarget;
}
$ac = '&nbsp;';
$cd = '&nbsp;';
$Atdwidth = abs($Atdwidth) ."%";
$UAtdwidth = abs($UAtdwidth) ."%";

$incentive = '';

if ($basetarget < $tmtarget) 
{
	$incentive = ($tmtarget - $basetarget);
	$incentive = $incentive * 0.20;
}
?>
<body>
 	<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php require("admin_header.php"); ?></td>
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
                            <td colspan="3" align="center" class="Alert_Msg"><?PHP echo $msg?></td>
                          </tr>
                          <tr>
                            <td colspan="3" align="center" class="Alert_Msg">
<DIV ID="testdiv1" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>
<DIV ID="testdiv2" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>
<DIV ID="testdiv3" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>
<DIV ID="testdiv4" STYLE="position:absolute;visibility:hidden;background-color:white;layer-background-color:white;"></DIV>

<SCRIPT LANGUAGE="JavaScript" ID="js18">
var cal18 = new CalendarPopup("testdiv1");
cal18.setCssPrefix("TEST");

var cal19 = new CalendarPopup("testdiv2");
cal19.setCssPrefix("TEST");

var cal20 = new CalendarPopup("testdiv3");
cal20.setCssPrefix("TEST");

var cal21 = new CalendarPopup("testdiv4");
cal21.setCssPrefix("TEST");

</SCRIPT>
&nbsp;</td>
                          </tr>
                          <?php if($edit == 1) { ?>
                          <tr>
                            <td colspan="3"><form id="form3" name="form3" method="post" action="time_sheet.php?a=1&edit=1">
                              <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC">
                                <tr>
                                  <td><table width="100%" border="1" cellpadding="4" cellspacing="2" bordercolor="#CCCCCC">
                                    <tr>
                                      <td width="22%" align="right"><strong>Employee Name : </strong></td>
                                      <td colspan="3"><strong>&nbsp;
                                            <?PHP echo $emp_name?>
                                            <input type="hidden" name="stid" value="<?PHP echo $stid?>" />
                                      </strong></td>
                                    </tr>
                                
                                    <tr>
                                      <td colspan="4"><table width="100%" border="0" cellspacing="2" cellpadding="2">

                                        <tr>
                                          <td colspan="2" align="right"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                      <td align="right">From :&nbsp; </td>
                                      <td width="38%"><input name="sdate" type="text" id="sdate"  value="<?PHP echo $sdate?>" size="15" maxlength="20" readonly="readonly"/></td>
                                      <td width="16%" align="right">To :&nbsp; </td>
                                      <td width="24%"><input name="tdate" type="text" id="tdate"  value="<?PHP echo $tdate?>" size="15" maxlength="20" readonly="readonly"/></td>
                                    </tr>
                                          </table></td>
                                          </tr>
                                        <tr>
                                          <td align="right">Leave Type&nbsp;: </td>
                                          <td><select name="sel_leav" id="sel_leav" onchange="FrmSubmit()">
                                            <option value="0">Leave Type here</option>
                                            <?php
											  $query=@mysql_query("Select * from leave_master");
											  while($row = @mysql_fetch_array($query,MYSQL_NUM))
											  {
											   ?>
                                            <option value="<?PHP echo $row[0]?>" <?PHP  if($row[0] == $sel_leav) { ?> selected="selected" <?PHP  } ?>> <?PHP echo $row[1]?> </option>
                                            <?PHP  } ?>
                                          </select></td>
                                        </tr>
                                        <tr>
                                          <td width="30%" align="right">Number of days : </td>
                                          <td width="70%"><input name="no_days" type="text" id="no_days" value="<?PHP echo $no_days?>" size="40" /></td>
                                        </tr>
                                        <tr>
                                          <td align="right">Reason for leave request : </td>
                                          <td><textarea name="lreason" cols="37" rows="5" id="pdetail"><?PHP echo $lreason?>
                                                    </textarea></td>
                                        </tr>
                                        <tr>
                                          <td align="right">&nbsp;</td>
                                          <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td align="right">&nbsp;</td>
                                          <td><input type="submit" name="Submit2" value="Approve Leave" />
                                            <input type="button" name="Submit23" value="Disapprove or Reject Leave" /></td>
                                        </tr>
                                      </table></td>
                                      </tr>
                                  </table></td>
                                </tr>
                              </table>
                            </form>                            </td>
                          </tr>
                          <?php } elseif($edit == 0) {?>
                          <tr>
                            <td colspan="3"><form id="form2" name="form2" method="post" action="time_sheet.php?a=1">
                              <table width="100%" border="1" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                                    <tr>
                                      <td align="right">&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td width="41%" align="right">Employee Name :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                                      <td width="59%"><select name="emp_id" id="emp_id">
                                          <option value="0">Select Employee Name</option>
                                    <?PHP
									$results = @mysql_query("Select em_id,e_fname,e_mname,e_lname from employee_master where e_status=1 order by e_fname asc");
									while($row = @mysql_fetch_array($results,MYSQL_NUM))
									{
									?>
										<option value="<?PHP echo $row[0]?>" <?PHP if($row[0] == $emp_id) {?> selected="selected" <?PHP  } ?> >
										<?PHP echo $row[1]?>&nbsp;<?PHP echo $row[2]?>&nbsp;<?PHP echo $row[3]?>
										</option>
                                   <?PHP
									}
  								    ?>
                                      </select>
									  </td>
                                    </tr>
                                    <tr>
                                      <td colspan="2"><table width="100%" border="0" cellspacing="2" cellpadding="2">
                                          <tr>
                                            <td width="12%" align="right">From : </td>
                                            <td width="38%"><input name="fdate" type="text" id="fdate"  value="<?PHP echo $fdate?>" size="15" maxlength="20" readonly="readonly"/><a href="#" onclick="cal18.select(document.forms['form2'].fdate,'anchor18','yyyy-MM-dd'); return false;" name="anchor18" id="anchor18"><button type="button" onclick="TextClear(1)"></button></a> [yyyy-mm-dd]</td>
                                            <td width="6%">To : </td>
                                            <td width="44%"><input name="tdate" type="text" id="tdate"  value="<?PHP echo $tdate?>" size="15" maxlength="20" readonly="readonly"/><a href="#" onclick="cal19.select(document.forms['form2'].tdate,'anchor19','yyyy-MM-dd'); return false;" name="anchor19" id="anchor19"><button onclick="TextClear(2)"></button></a> [yyyy-mm-dd]</td>
                                          </tr>
                                      </table></td>
                                    </tr>
                                    <tr>
                                      <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="61%" align="right"><label>
                                              <input type="submit" name="Submit" value="Show Leave Details" />
                                            </label></td>
                                            <td width="39%">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td align="right">&nbsp;</td>
                                            <td>&nbsp;</td>
                                          </tr>
                                      </table></td>
                                    </tr>
                                  </table></td>
                                </tr>
                              </table>
                            </form></td>
                          </tr>
                          <tr>
                            <td colspan="3">
                              <table width="100%" border="0" cellpadding="0" cellspacing="1" class="table_border_clr1">
                                <tr>
                                  <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_border_clr2">
                                      <tr>
                                        <td><form id="form1" name="form1" method="post" action="time_sheet.php">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td height="21" colspan="10" align="left" class="table_border_clr1"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td width="6%" height="21" align="right" ><strong>Sl No</strong></td>
                                                      <td width="2%" >&nbsp;</td>
                                                      <td width="28%" ><strong>&nbsp;&nbsp;&nbsp;&nbsp;Date </strong></td>
                                                      <td width="14%" align="right" ><strong>No. of days</strong></td>
                                                      <td width="50%" align="center" ><strong>Reason</strong></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                              <tr>
                                                <td width="1%" align="left">&nbsp;</td>
                                                <td width="5%" align="right"><?PHP echo $i?></td>
                                                <td width="2%">&nbsp;</td>
                                                <td width="28%"><?PHP echo $sql_row[0]?></td>
                                                <td width="14%" align="right"><?PHP echo $sql_row[2]?>&nbsp;</td>
												<td width="1%">&nbsp;</td>
                                                <td width="49%" align="left"><?PHP echo $sql_row[1]?></td>
                                              </tr>
											  <?PHP 
											  }
												}
											  ?>
                                            </table>
                                          </form></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td width="56%" align="right"><!--Total Minutes : --></td>
                            <td width="15%" align="right"></td>
                            <td width="29%" align="right">&nbsp;</td>
                          </tr>
                          <tr>
                          <td colspan="3" class="Pagination"> </tr>
                          <tr>
                            <td colspan="3">&nbsp;</td>
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
    <td><?php require("admin_footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
<script language="javascript">
function RecDelete(stid,sdate,serial_no)
{
	if(confirm("Sure you want to Delete ?"))
	{
		document.form3.action="time_sheet.php?a=2&stid="+ stid +'&sdate='+ sdate +'&serial_no='+ serial_no;
		document.form3.submit();
	}
}
function RecEdit(stid,sdate)
{
	document.form1.action="time_sheet.php?edit=1&sdate="+ sdate+'&stid='+stid;
	document.form1.submit();
}
function TextClear(opt)
{
	if(opt == 1)document.form2.fdate.value = "";
	if(opt == 2)document.form2.tdate.value = "";
	if(opt == 3)document.form3.sdate.value = "";
}

var show = '<?PHP echo $show?>';
document.getElementById("dborder").style.display = 'none';
if(show == 1) {document.getElementById("dborder").style.display = 'block';}

function Show_Target()
{
	if(document.form2.emp_id.value == '0')
	{
		alert("Please Select Employee Name");
		document.form2.emp_id.focus();
	}
	else if(document.form4.month_n.value == '')
	{
		alert("Please Enter Month Name");
		document.form4.month_n.focus();
	}
	else
	{
		var emp_id = document.form2.emp_id.value;
		document.form4.hf_emp_id.value = document.form2.emp_id.value;
		document.form4.action = 'time_sheet.php?show=1&emp_id='+emp_id;
		document.form4.submit();
	}
}
function FrmSubmit()
{
	var stid = '<?PHP echo $stid?>';
	var sdate = '<?PHP echo $sdate?>';
	
	if(stid == '0')
	{
		alert("Please Select Employee Name");
		document.form2.emp_id.focus();
		return false;
	}
	else
	{
		document.form3.action="time_sheet.php?edit=1&sdate="+ sdate +'&stid='+ stid;
		document.form3.submit();
	}
}
</script>