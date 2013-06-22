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
$add = $_REQUEST["a"];
$ape_id = $_REQUEST["ape_id"];
$project = $_REQUEST["project_name"];
$emp_name1 = $_REQUEST["emp_name1"];
$psdate = $_REQUEST["psdate"];

$admin_add_date = date("d/m/y");
$admin_add_time = date("g: i a");
$ip_address = $_SERVER['HTTP_HOST'];

if($add == 1)
{
	$strsql = @mysql_query("Select emp_id from assign_prj_emp where project_name='". $project ."'");
	$row = mysql_fetch_row($strsql);
	if(!$row)
	{
		
		/* ================= PHOTO UPLOAD ============================= */	
			
		$result = @mysql_query("Insert into assign_prj_emp(admin_id,prj_date,add_date,add_time,project_name,emp_id,project_file) values('". $_SESSION["admin_id"] ."','". $psdate ."','". $admin_add_date ."','". $admin_add_time ."','". $project."','". $emp_name1 ."','". $file ."')");
		$msg = "Project Assigned Successfully!";	
		$id = mysql_insert_id();
		$dir = "project_files";
		$img = $_FILES["file_upload"]["name"];
	
		if ($_FILES['file_upload']['error'] != UPLOAD_ERR_OK)
		{
			switch ($_FILES['file_upload']['error'])
			{
				case UPLOAD_ERR_INI_SIZE:
				die('The uploaded file exceeds the upload_max_filesize directive ' . 'in php.ini.');
				break;
				case UPLOAD_ERR_FORM_SIZE:
				die('The uploaded file exceeds the MAX_FILE_SIZE directive that ' . 'was specified in the HTML form.');
				break;
				case UPLOAD_ERR_PARTIAL:
				die('The uploaded file was only partially uploaded.');
				break;
				case UPLOAD_ERR_NO_FILE:
				die('No file was uploaded.');
				break;
				case UPLOAD_ERR_NO_TMP_DIR:
				die('The server is missing a temporary folder.');
				break;
				case UPLOAD_ERR_CANT_WRITE:
				die('The server failed to write the uploaded file to disk.');
				break;
				case UPLOAD_ERR_EXTENSION:
				die('File upload stopped by extension.');
				break;
			}
		}
		
		if (file_exists($dir . $_FILES["file_upload"]["name"]))
		{
			echo $_FILES["file_upload"]["name"] . " already exists. ";
		}
		else
		{
			$e = explode(".", $_FILES["file_upload"]["name"]);
			$ext = $e[1];
			move_uploaded_file($_FILES["file_upload"]["tmp_name"], $dir."/copy/" . $_FILES["file_upload"]["name"]);
			$org_file = $dir."/copy/".$img;
			$reg = $id.".".$ext;
			$thumb_file = $dir."/".$reg;
			rename($org_file,$thumb_file);

			$sql="UPDATE assign_prj_emp SET project_file='".$reg."' WHERE ape_id='".$id."'";
			$query = mysql_query($sql);
			unlink($org_file);
		}
	}
	else
	{
		if($_FILES["file_upload"]["name"] == "")
		{
			$result = @mysql_query("Update assign_prj_emp set admin_id='". $_SESSION["admin_id"] ."',prj_date='". $psdate ."',add_date='". $admin_add_date ."',add_time='". $admin_add_time ."',emp_id='". $emp_name1 ."' where ape_id='". $ape_id ."'");
	
			$msg = "Project Reassigned Successfully!";
		}
		else
		{
			$strsql = @mysql_query("Select project_file from assign_prj_emp where ape_id='". $ape_id ."'");
			$row = mysql_fetch_row($strsql);
			if($row)
			{
				$file = $row[0];
				$dir = "project_files";
				unlink($dir."/".$file);
			}
			$fl = $_FILES["file_upload"]["name"];
			$e = explode(".", $_FILES["file_upload"]["name"]);
			$ext = $e[1];
			move_uploaded_file($_FILES["file_upload"]["tmp_name"], $dir."/copy/" . $_FILES["file_upload"]["name"]);
			$org_file = $dir."/copy/".$fl;
			$reg = $ape_id.".".$ext;
			$thumb_file = $dir."/".$reg;
			rename($org_file,$thumb_file);

			unlink($org_file);

			$result = @mysql_query("Update assign_prj_emp set admin_id='". $_SESSION["admin_id"] ."',prj_date='". $psdate ."',add_date='". $admin_add_date ."',add_time='". $admin_add_time ."',emp_id='". $emp_name1 ."',project_file='". $reg ."' where ape_id='". $ape_id ."'");
	
			$msg = "Project and file reassigned successfully!";
		}
	}
}

if($add == '' && $ape_id > 0)
{
	$strsql = @mysql_query("Select ape_id, project_name, emp_id, prj_date, project_file from assign_prj_emp where ape_id='". $ape_id ."'");
	$row = mysql_fetch_row($strsql);
	if($row)
	{
		$project = $row[1];
		$emp_name1 = $row[2];
		$psdate = $row[3];
		$file = $row[4];
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
                      <td width="76%" class="Button_Show_Map"> : : Assign Project to Emplyee : :</td>
                     <td width="30%" align="right"><a href="view_project_ass_employee.php" class="a1">View Assigned List</a></td>
                    </tr>
                    <tr>
                      <td colspan="2"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
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
                                        <td><form action="assign_project.php?a=1" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return form_validate()">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td height="21" class="table_border_clr1"><span class="header1"> &nbsp;: : Assign Project : : <input type="hidden" name="ape_id" value="<?= $ape_id;?>" /></span></td>
                                              </tr>
                                              <tr>
                                                <td><table width="100%" border="0" cellpadding="2" cellspacing="2" class="grid_header_p">
                                                    <tr>
                                                      <td align="right">&nbsp;</td>
                                                      <td align="left">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td width="25%" align="right">Project Name  : </td>
                                                      <td width="75%" align="left"><label><span class="font2">
                                                        <input name="project_name" type="text" id="project_name" value="<?= $project ?>" <? if($ape_id>0){ ?> readonly="readonly" <? } ?> />
                                                      *</span></label></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right">Employee Name : </td>
                                                      <td align="left"><span class="font2">
                                                        <select name="emp_name1" id="emp_name1">
                                                          <option value="0">Select Employee Name</option>
                                                          <?PHP $results = @mysql_query("Select em_id,e_fname,e_mname,e_lname from employee_master order by e_fname asc");		
									while($row = @mysql_fetch_array($results,MYSQL_NUM))
									{
									?>
                                                          <option value="<?PHP echo $row[0]?>" <?PHP if($row[0] == $emp_name1) {?> selected="selected" <?PHP } ?> >
                                                          <?PHP echo $row[1]?>
                                                          &nbsp;
                                                          <?PHP echo $row[2]?>
                                                          &nbsp;
                                                          <?PHP echo $row[3]?>                                                          </option>
                                                          <?PHP } ?>
                                                        </select>
                                                        </span><span class="font2">*</span></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right">Project Date : </td>
                                                      <td>
<input name="psdate" type="text" id="psdate"  value="<?PHP echo $psdate?>" size="20" /> [yyyy-mm-dd]</td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right">Project File : </td>
                                                      <td><input type="file" name="file_upload" id="file_upload" /><?php if($ape_id>0){ echo "<a href='project_files/$file' target='_blank'>View File</a>"; }?></td>
                                                    </tr>
                                                    <tr>
                                                      <td colspan="2" align="center"><label></label>
                                                        <input name="Submit" type="submit" class="font6" value="Save/Submit" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td colspan="2" align="center">&nbsp;</td>
                                                    </tr>
                                                    <tr align="left">
                                                      <td colspan="2"><label class="fontfare">Note : Mendatory fields are indicated by (<span class="font2">*</span>).</label></td>
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
                      <td colspan="2">&nbsp;</td>
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
	if(document.form1.project_name.value == "")
	{
		alert("Please enter Project Name");
		document.form1.project_name.focus();
		return false;
	}
	if(document.form1.emp_name1.value == 0)
	{
		alert("Please Select Employee Name");	
		document.form1.emp_name1.focus();
		return false;
	}
}

function TextClear(opt)
{
	if(opt==1)document.form1.psdate.value = "";
}
</script>