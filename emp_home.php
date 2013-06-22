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
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td align="center">&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                        </tr>
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