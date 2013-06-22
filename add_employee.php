<?php 
error_reporting(E_ALL & ~E_NOTICE);
@session_start(); ?>
<?php 
require("database/dbconnect.php"); 
require("database/admin_sessionexpiry.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="javascript/calendar.css" rel="stylesheet"/>
<SCRIPT LANGUAGE="JavaScript" SRC="javascript/calendar_us.js"></SCRIPT>
<title>Employee</title>

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
$add = $_REQUEST["a"];
$em_id = $_REQUEST["em_id"];
$fname = $_REQUEST["fname"];
$mname = $_REQUEST["mname"];
$lname = $_REQUEST["lname"];
$bdate = $_REQUEST["bdate"];
$bplace = $_REQUEST["bplace"];
$praddress = $_REQUEST["praddress"];
$peraddress = $_REQUEST["peraddress"];
$email1 = $_REQUEST["email1"];
$email2 = $_REQUEST["email2"];
$phone = $_REQUEST["phone"];
$mobile1 = $_REQUEST["mobile1"];
$mobile2 = $_REQUEST["mobile2"];
$jdate = $_REQUEST["jdate"];
$qualification = $_REQUEST["qualification"];
$euname = $_REQUEST["euname"];
$epword = $_REQUEST["epword"];
$salary = $_REQUEST["salary"];
	
$admin_add_date = date("d/m/y");
$admin_add_time = date("g: i a");
$ip_address = $_SERVER['HTTP_HOST'];

$h1 = ": : Add Employee : :";
$h2 = ": : Add Employee : :";
$readonly = "";

if($add == '' && $em_id > 0)
{
	$h1 = ": : Edit Employee : :";
	$h2 = ": : Edit Employee : :";
	
	$strsql = @mysql_query("Select e_fname,e_mname,e_lname,e_dbirth,e_dbirth_place,e_present_address,e_permanent_address,e_email1,e_email2,e_phone,e_mobile1,e_mobile2,e_joined_date,e_qualification_id,e_uname,e_pword,e_salary from employee_master where em_id='". $em_id ."'");
	$row = mysql_fetch_row($strsql);
	if($row)
	{
		$fname = $row[0];
		$mname = $row[1];
		$lname = $row[2];
		$bdate = $row[3];
		$bplace = $row[4];
		$praddress = $row[5];
		$peraddress = $row[6];
		$email1 = $row[7];
		$email2 = $row[8];
		$phone = $row[9];
		$mobile1 = $row[10];
		$mobile2 = $row[11];
		$jdate = $row[12];
		$qualification = $row[13];
		$euname =  $row[14];
		$epword =  $row[15];
		$salary = $row[16];
		$readonly = "readonly";
	}
}
elseif($add == 1 && $em_id == 0)
{
	$strsql = @mysql_query("Select e_fname from employee_master where e_fname='". $fname ."' and e_mname='". $mname ."' and e_lname='". $lname ."'");
	$row = mysql_fetch_row($strsql);
	if(!$row)
	{
		$result = @mysql_query("Insert into employee_master(admin_id,add_date,add_time,e_fname,e_mname,e_lname,e_dbirth,e_dbirth_place,e_present_address,e_permanent_address,e_email1,e_email2,e_phone,e_mobile1,e_mobile2,e_joined_date,e_qualification_id,e_uname,e_pword) values('". $_SESSION["admin_id"] ."','". $admin_add_date ."','". $admin_add_time ."','". $fname ."','". $mname ."','". $lname  ."','". $bdate ."','". $bplace ."','". $praddress ."','". $peraddress ."','". $email1 ."','". $email2 ."','". $phone ."','". $mobile1 ."','". $mobile2 ."','". $jdate ."','". $qualification ."','". $euname ."','". $epword ."')");
		$msg = "Record Added Successfully!";
		
	}
	else
	{
		$msg = "Employee Name Already Exists!";
	}
}
elseif($add == 1 && $em_id > 0)
{
	$strsql = @mysql_query("Select e_fname from employee_master where e_fname='". $fname ."' and e_mname='". $mname ."' and e_lname='". $lname ."' and em_id !='". $em_id ."'");
	$row = mysql_fetch_row($strsql);
	if(!$row)
	{
		$result = @mysql_query("Update employee_master set e_fname='". $fname ."',e_mname='". $mname ."',e_lname='". $lname ."',e_dbirth='". $bdate ."',e_dbirth_place='". $bplace ."',e_present_address='". $praddress ."',e_permanent_address='". $peraddress ."',e_email1='". $email1 ."',e_email2='". $email2 ."',e_phone='". $phone ."',e_mobile1='". $mobile1 ."',e_mobile2='". $mobile2 ."',e_joined_date='". $jdate ."',e_qualification_id='". $qualification ."',e_uname='". $euname ."',e_pword='". $epword ."',e_salary='". $salary ."' where em_id='". $em_id ."'");
		$msg = "Record Updated Successfully!";
	}	
	else
	{
		$msg = "Employee Name Already Exists!";
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
                      <td bgcolor="#D2D2D2" class="Button_Show_Map"><?php echo $h1?></td>
                    </tr>
                    <tr>
                      <td><table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td align="center" class="Alert_Msg"><?php echo $msg; ?></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><table width="100%" border="0" cellpadding="0" cellspacing="1" class="table_border_clr1">
                                <tr>
                                  <td><table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_border_clr2">
                                      <tr>
                                        <td><form id="form1" name="form1" method="post" action="add_employee.php?a=1" onsubmit="return form_validate()">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td height="21" bgcolor="#D2D2D2" class="table_border_clr1"><span class="header1"> &nbsp;<?php echo $h2?> 
                                                  <input type="hidden" name="em_id" value="<?php echo $em_id?>" id="em_id"/>
                                                </span></td>
                                              </tr>
                                              <tr>
                                                <td><table width="100%" border="0" cellpadding="1" cellspacing="2" class="grid_header_p">
                                                    <tr>
                                                      <td width="31%" align="right">First Name : </td>
                                                      <td width="69%" align="left"><label>
                                                        <input name="fname" type="text" id="fname"  value="<?php echo $fname?>" size="30" maxlength="50" />
                                                      <span class="font2">*</span></label></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right"> Middle Name : </td>
                                                      <td align="left"><input name="mname" type="text" id="mname" value="<?php echo $mname?>" size="30" maxlength="50" />
                                                        <span class="font2">*</span></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right">Last Name : </td>
                                                      <td><input name="lname" type="text" id="lname"  value="<?php echo $lname?>" size="30" maxlength="50" />
                                                        <span class="font2">*</span></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right">Date of Birth : </td>
                                                      <td>
<input name="bdate" type="text" id="bdate" value="<?php echo $bdate?>" size="30" maxlength="50" readonly/>
<script language="JavaScript" type="text/javascript">
new tcal ({'formname': 'form1','controlname': 'bdate'});
</script>
                                                        [dd-mm-yyyy]</td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right">Birth Place : </td>
                                                      <td><input name="bplace" type="text" id="bplace"  value="<?php echo $bplace?>" size="30" maxlength="50" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right">Present Address : </td>
                                                      <td><span class="font2">
                                                        <textarea name="praddress" cols="30" rows="4" id="praddress"><?php echo $praddress?>
</textarea>
                                                        *</span></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right">Permanent Address : </td>
                                                      <td><textarea name="peraddress" cols="30" rows="4" id="peraddress"><?php echo $peraddress?>
</textarea></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right">E-mail -1&nbsp;: </td>
                                                      <td><input name="email1" type="text" id="email1"  value="<?php echo $email1?>" size="30" onblur="validate_email(this)"/>
                                                        <span class="font2">*</span></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right">E-mail -2&nbsp;: </td>
                                                      <td><input name="email2" type="text" id="email2"  value="<?php echo $email2?>" size="30" onblur="validate_email(this)"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right">Phone : </td>
                                                      <td><input name="phone" type="text" id="phone"  value="<?php echo $phone?>" size="30" maxlength="11"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right">Mobile -1&nbsp;: </td>
                                                      <td><input name="mobile1" type="text" id="mobile1"  value="<?php echo $mobile1?>" size="30" maxlength="11"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right">Mobile - 2 : </td>
                                                      <td><input name="mobile2" type="text" id="mobile2"  value="<?php echo $mobile2?>" size="30" maxlength="11"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right">Join Date :</td>
                                                      <td><input name="jdate" type="text" id="jdate"  value="<?php echo $jdate?>" size="30" maxlength="20" />
 <script language="JavaScript" type="text/javascript">
	new tcal ({'formname': 'form1','controlname': 'jdate'});
	                            </script>
                                                        [dd-mm-yyyy]</td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right">Qualification : </td>
                                                      <td><span class="font2">
                                                        <select name="qualification" id="qualification">
                                                          <option value="0">Select Qualification</option>
                                                          <?php
									$results = @mysql_query("Select qm_id,q_name from qualification_master order by q_name asc");		
									while($row = @mysql_fetch_array($results,MYSQL_NUM))
									{
									?>
                                                          <option value="<?php echo $row[0]?>" <?php  if($row[0] == $qualification) {?> selected="selected" <?php  } ?> >
                                                          <?php echo $row[1]?>                                                          </option>
                                                          <?php 	} ?>
                                                        </select>
                                                        </span></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right">Employee Salary : </td>
                                                      <td><input name="salary" type="text" id="salary"  value="<?php echo $salary?>" size="30" maxlength="12"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right">User Name : </td>
                                                      <td><input name="euname" type="text" id="euname" value="<?php echo $euname?>" size="30" maxlength="12" <?php echo $readonly?>/>
                                                        <span class="font2">*</span></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right">Password : </td>
                                                      <td><input name="epword" type="password" id="epword"  value="<?php echo $epword?>" size="30" maxlength="12" />
                                                        <span class="font2">*</span></td>
                                                    </tr>
                                                    <tr>
                                                      <td colspan="2" align="center"><label>&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <input name="Submit2" type="button" class="font6" value="New Employee" onclick="clearall()" />
                                                        &nbsp;&nbsp;&nbsp; </label>
                                                        <input name="Submit" type="submit" class="font6" value="Save/Submit" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td colspan="2" align="center">&nbsp;</td>
                                                    </tr>
                                                    <tr align="left">
                                                      <td colspan="2"><label class="fontfare">Note : Mendatory fields are indicated by (<span class="font2">*</span>). </label></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                            </table>
                                          </form></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
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
function form_validate()
{
	if(document.form1.fname.value == '')
	{
		alert("Please Enter First Name");	
		document.form1.fname.focus();
		return false;
	}
	else if(document.form1.mname.value == '')
	{
		alert("Please Enter Middle Name");	
		document.form1.mname.focus();
		return false;
	}
	else if(document.form1.lname.value == '')
	{
		alert("Please Enter Last Name");	
		document.form1.lname.focus();
		return false;
	}
	else if(document.form1.praddress.value == "")
	{
		alert("Please Enter Present Address");	
		document.form1.praddress.focus();
		return false;
	}
	else if(document.form1.email1.value == "")
	{
		alert("Please Enter Valid E-mail");	
		document.form1.email1.focus();
		return false;
	}
	else if(document.form1.euname.value == "")
	{
		alert("Please Enter Employee User Name");	
		document.form1.euname.focus();
		return false;
	}	
	else if(document.form1.epword.value == "")
	{
		alert("Please Enter Employee Password");	
		document.form1.epword.focus();
		return false;
	}		
	else if(document.form1.email1.value != "")
	{	
		return checkemail(document.form1.email1);
	}
	else if(document.form1.role.value == 0)
	{
		alert("Please assign the new employee a role");
		document.form1.role.focus();
		return false;
	}
	else if(document.form1.status.value == 0)
	{
		alert("Please set the new employee a status");
		document.form1.role.focus();
		return false;
	}

}


function clearall()
{
	document.form1.fname.value = "";
	document.form1.mname.value = "";
	document.form1.lname.value = "";
	document.form1.bdate.value = "";
	document.form1.bplace.value = "";
	document.form1.praddress.value = "";
	document.form1.peraddress.value = "";
	document.form1.email1.value = "";
	document.form1.email2.value = "";
	document.form1.phone.value = "";
	document.form1.mobile1.value = "";
	document.form1.mobile2.value = "";
	document.form1.jdate.value = "";
	document.form1.qualification.value = "0";
	document.form1.euname.value = "";
	document.form1.epword.value = "";
	document.form1.em_id.value = "";
	document.form1.salary.value = "";
	document.form1.action = "add_employee.php";
	document.form1.submit();
}

function validate_email(obj)
{
	if(obj.value != "")
	checkemail(obj);
}
function checkemail(obj)
{
 if(!(obj.value == "" ))
 {
  if(!isEmailAddr(obj.value))
    {
	  alert("Enter the Correct and valid Email Address");
	  obj.value="";
	  obj.focus();
	  return false;
	}
	else
	return true;  
 }	
}

function isEmailAddr(email)
{
  var result=false;
  var thestr=new String(email);
  var index= thestr.indexOf("@");
  if(index>0)
   {
    var pindex=thestr.indexOf(".",index);
	if((pindex>index+1)&&(thestr.length>pindex+1))
	   result=true;
	}
	return result;
}

function TextClear(opt)
{
	if(opt == 1)document.form1.bdate.value = "";
	if(opt == 2)document.form1.jdate.value = "";
}
</script>