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
<body>
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php //require("admin_header.php"); ?></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="1" class="table_border_clr1">
        <tr>
          <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="table_border_clr2">
              <tr>
                <td width="21%" align="left" valign="top"><?php require("emp_side_menu.php");?></td>
                <td width="1%" align="center" valign="top" bgcolor="#2597DF">&nbsp;</td>
                <td width="79%" align="center" valign="top"><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">

                  <tr>
                    <td class="Button_Show_Map">Employee Panel </td>
                  </tr>
                  <tr>
                    <td><table width="93%" border="0" cellpadding="5" cellspacing="0">
  <tbody>
    <tr>
      <td bordercolor="#000000"><form action="accident report.php" method="post" class="style1">  
          <table border="1" cellpadding="0" cellspacing="0">
            <col width="64">
            <col width="237">
            <col width="242">
            <col width="87">
            <tr height="20">
              <td colspan="4" rowspan="4" height="108" width="630" align="left" valign="top"><img width="105" height="93" src="safety corrective acton plan - Copy_clip_image002_0000.gif">
                  <table cellpadding="0" cellspacing="0">
                    <tr>
                      <td colspan="4" rowspan="4" height="108" width="630">                     PIONEER      DESIGNTECH PRIVATE LIMITED</td>
                    </tr>
                </table></td>
            </tr>
            <tr height="20"> </tr>
            <tr height="20"> </tr>
            <tr height="48"> </tr>
            <tr height="31">
              <td colspan="4" height="31">ACCIDENT REPORT</td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td></td>
              <td>DATE</td>
              <td><input type="text" name="date"></td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr height="20">
              <td height="20">SL NO</td>
              <td>DESCRIPTION</td>
              <td>&nbsp;</td>
              <td>REMARKS</td>
            </tr>
            <tr height="26">
              <td height="26">1</td>
              <td>  Name of employee</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr height="26">
              <td height="26">2</td>
              <td>  Occupation</td>
              <td><input type="text" name="a1"></td>
              <td><input type="text" name="a2"></td>
            </tr>
            <tr height="26">
              <td height="26">3</td>
              <td>  Salary</td>
              <td><input type="text" name="b1"></td>
              <td><input type="text" name="b2"></td>
            </tr>
            <tr height="26">
              <td height="26">4</td>
              <td>  Date of appointment</td>
              <td><input type="text" name="c1"></td>
              <td><input type="text" name="c2"></td>
            </tr>
            <tr height="26">
              <td height="26">5</td>
              <td>  Direct employee OR Subcontractor</td>
              <td><input type="text" name="d1"></td>
              <td><input type="text" name="d2"></td>
            </tr>
            <tr height="26">
              <td height="26">6</td>
              <td>  Date / Time / Place of accident</td>
              <td><input type="text" name="e1"></td>
              <td><input type="text" name="e2"></td>
            </tr>
            <tr height="26">
              <td height="26">7</td>
              <td>  Nature of accident</td>
              <td><input type="text" name="f1"></td>
              <td><input type="text" name="f2"></td>
            </tr>
            <tr height="26">
              <td height="26">8</td>
              <td>  Description of accident</td>
              <td><input type="text" name="g1"></td>
              <td><input type="text" name="g2"></td>
            </tr>
            <tr height="26">
              <td height="26">9</td>
              <td>  Cause of accident</td>
              <td><input type="text" name="h1"></td>
              <td><input type="text" name="h2"></td>
            </tr>
            <tr height="26">
              <td height="26">10</td>
              <td>  Nature / degree of injury</td>
              <td><input type="text" name="i1"></td>
              <td><input type="text" name="i2"></td>
            </tr>
            <tr height="26">
              <td height="26">11</td>
              <td>  Name of hospital of treatment</td>
              <td><input type="text" name="j1"></td>
              <td><input type="text" name="j2"></td>
            </tr>
            <tr height="26">
              <td height="26">12</td>
              <td>  Period of disablement from / to</td>
              <td><input type="text" name="k1"></td>
              <td><input type="text" name="k2"></td>
            </tr>
            <tr height="26">
              <td height="26">13</td>
              <td>  Treatment expenses</td>
              <td><input type="text" name="l1"></td>
              <td><input type="text" name="l1"></td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td>Name</td>
              <td>Signature</td>
              <td>&nbsp;</td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr height="20">
              <td height="20">&nbsp;</td>
              <td></td>
              <td></td>
              <td>&nbsp;</td>
            </tr>
            <tr height="21">
              <td height="21">&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table>
          <p>&nbsp;</p>
          <div align="center">
            <input name="submit" value="Ok" type="submit">
            <input name="reset" type="reset">
          </div>
      </form>
       &nbsp; </td>
    </tr>
  </tbody>
</table></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
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