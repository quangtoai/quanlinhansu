<?php
$ma_nv = $_GET['catID'];
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tlb_baohiem (ma_nhan_vien, so_bhxh, ngay_cap_bhxh, noi_cap_bhxh, so_bhyt, ngay_cap_bhyt, noi_cap_bhyt) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ma_nhan_vien'], "text"),
                       GetSQLValueString($_POST['so_bhxh'], "text"),
                       GetSQLValueString($_POST['ngay_cap_bhxh'], "date"),
                       GetSQLValueString($_POST['noi_cap_bhxh'], "text"),
                       GetSQLValueString($_POST['so_bhyt'], "text"),
                       GetSQLValueString($_POST['ngay_cap_bhyt'], "date"),
                       GetSQLValueString($_POST['noi_cap_bhyt'], "text"));

  mysql_select_db($database_Myconnection, $Myconnection);
  $Result1 = mysql_query($insertSQL, $Myconnection) or die(mysql_error());

  $insertGoTo = "them_moi_bao_hiem.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
	sprintf("Location: %s", $insertGoTo);
}
mysql_select_db($database_Myconnection, $Myconnection);
$query_RCBaohiem_TM = "SELECT * FROM tlb_baohiem where ma_nhan_vien = '$ma_nv'";
$RCBaohiem_TM = mysql_query($query_RCBaohiem_TM, $Myconnection) or die(mysql_error());
$row_RCBaohiem_TM = mysql_fetch_assoc($RCBaohiem_TM);
$totalRows_RCBaohiem_TM = mysql_num_rows($RCBaohiem_TM);
if ($totalRows_RCBaohiem_TM <>0)
	{
  	$url = "index.php?require=cap_nhat_bao_hiem.php&catID=$ma_nv&title=C???p nh???t b???o hi???m";
	location($url);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<body text="#000000" link="#CC0000" vlink="#0000CC" alink="#000099">
<table class="row6" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="20%"><a href="index.php?require=them_moi_quan_he_gia_dinh.php&catID=<?php echo $ma_nv; ?>&title=Quan h??? gia ????nh">Quan h??? gia ????nh</a></td>
          <td width="20%" align="center"><a href="index.php?require=them_moi_qua_trinh_cong_tac.php&catID=<?php echo $ma_nv; ?>&title=Qu?? tr??nh c??ng t??c">Qu?? tr??nh c??ng t??c</a></td>
          <td width="19%" align="center"><a href="index.php?require=them_moi_qua_trinh_luong.php&catID=<?php echo $ma_nv; ?>&title=Qu?? tr??nh l????ng">Qu?? tr??nh l????ng</a></td>
          <td width="20%" align="center"><a href="index.php?require=them_moi_hop_dong.php&catID=<?php echo $ma_nv; ?>&title=H???p ?????ng">H???p ?????ng</a></td>
          <td width="20%" align="center"><a href="index.php?require=them_moi_bao_hiem.php&catID=<?php echo $ma_nv; ?>&title=B???o hi???m">B???o hi???m</a></td>
        </tr>
      </table>
<?php
		if ($totalRows_RCBaohiem_TM<>0)
		{
	?>
<table class="row2" width="800" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr>
    <th width="100">S??? s??? BHXH</th>
    <th width="66">Ng??y c???p</th>
    <th width="109">N??i c???p</th>
    <th width="100">S??? s??? BHYT</th>
    <th width="83">Ng??y c???p</th>
    <th width="109">N??i c???p</th>
    <th colspan="2">&nbsp;</th>
  </tr>
  <tr>
    <td class="row1"><?php echo $row_RCBaohiem_TM['so_bhxh']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_TM['ngay_cap_bhxh']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_TM['noi_cap_bhxh']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_TM['so_bhyt']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_TM['ngay_cap_bhyt']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_TM['noi_cap_bhyt']; ?></td>
    <td width="35" class="row1"><a href="index.php?require=cap_nhat_bao_hiem.php&catID=<?php echo $ma_nv; ?>&title=C???p nh???t b???o hi???m">S???a</a></td>
    <td width="35" class="row1">Xo??</td>
  </tr>
</table>
	<?php
		}
	?>
<p></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="row2" width="800" align="center" cellpadding="3" cellspacing="3">
    <tr valign="baseline">
      <td width="133" align="right" nowrap="nowrap">M?? nh??n vi??n:</td>
      <td width="211"><input type="text" name="ma_nhan_vien" value="<?php echo $ma_nv; ?>" readonly="readonly" size="32" /></td>
      <td width="129">&nbsp;</td>
      <td width="286">&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">S??? s??? BHXH</td>
      <td><input type="text" name="so_bhxh" value="" size="32" /></td>
      <td>S??? s??? BHYT:</td>
      <td><input type="text" name="so_bhyt" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ng??y c???p BHXH:</td>
      <td><input type="text" name="ngay_cap_bhxh" value="" size="32" /></td>
      <td>Ng??y c???p BHYT:</td>
      <td><input type="text" name="ngay_cap_bhyt" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">N??i c???p BHXH:</td>
      <td><input type="text" name="noi_cap_bhxh" value="" size="32" /></td>
      <td>N??i c???p BHYT:</td>
      <td><input type="text" name="noi_cap_bhyt" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="4" align="center" nowrap="nowrap"><input type="submit" value=":|: Th??m m???i :|:" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p></p>
</body>
</html>
<?php
mysql_free_result($RCBaohiem_TM);
?>
