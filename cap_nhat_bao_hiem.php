<?php require_once('Connections/Myconnection.php'); ?>
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tlb_baohiem SET so_bhxh=%s, ngay_cap_bhxh=%s, noi_cap_bhxh=%s, so_bhyt=%s, ngay_cap_bhyt=%s, noi_cap_bhyt=%s WHERE ma_nhan_vien=%s",
                       GetSQLValueString($_POST['so_bhxh'], "text"),
                       GetSQLValueString($_POST['ngay_cap_bhxh'], "text"),
                       GetSQLValueString($_POST['noi_cap_bhxh'], "text"),
                       GetSQLValueString($_POST['so_bhyt'], "text"),
                       GetSQLValueString($_POST['ngay_cap_bhyt'], "text"),
                       GetSQLValueString($_POST['noi_cap_bhyt'], "text"),
                       GetSQLValueString($_POST['ma_nhan_vien'], "text"));

  mysqli_select_db($Myconnection, $database_Myconnection);
  $Result1 = mysqli_query($updateSQL, $Myconnection) or die(mysqli_error());

  $updateGoTo = "them_moi_bao_hiem.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  sprintf("Location: %s", $updateGoTo);
}

mysqli_select_db($Myconnection, $database_Myconnection);
$query_RCBaohiem_DS = "SELECT * FROM tlb_baohiem";
$RCBaohiem_DS = mysqli_query($Myconnection, $query_RCBaohiem_DS) or die(mysqli_error());
$row_RCBaohiem_DS = mysqli_fetch_assoc($RCBaohiem_DS);
$totalRows_RCBaohiem_DS = mysqli_num_rows($RCBaohiem_DS);
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
<table class="row2" width="800" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr>
    <th width="100">S??? s??? BHXH</th>
    <th width="66">Ng??y c???p</th>
    <th width="109">N??i c???p</th>
    <th width="100">S??? s??? BHYT</th>
    <th width="83">Ng??y c???p</th>
    <th width="109">N??i c???p</th>
    <th width="35">&nbsp;</th>
    <th width="35">&nbsp;</th>
  </tr>
  <tr class="row">
    <td class="row1"><?php echo $row_RCBaohiem_DS['so_bhxh']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_DS['ngay_cap_bhxh']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_DS['noi_cap_bhxh']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_DS['so_bhyt']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_DS['ngay_cap_bhyt']; ?></td>
    <td class="row1"><?php echo $row_RCBaohiem_DS['noi_cap_bhyt']; ?></td>
    <td class="row1">&nbsp;</td>
    <td class="row1">Xo??</td>
  </tr>
</table>
<?php
mysqli_free_result($RCBaohiem_DS);
?>
<p></p>
<?php
mysqli_select_db($Myconnection, $database_Myconnection);
$query_RCBaohiem_CN = "SELECT * FROM tlb_baohiem inner join tlb_nhanvien on tlb_baohiem.ma_nhan_vien = tlb_nhanvien.ma_nhan_vien where tlb_baohiem.ma_nhan_vien = '$ma_nv'";
$RCBaohiem_CN = mysqli_query($Myconnection, $query_RCBaohiem_CN) or die(mysqli_error());
$row_RCBaohiem_CN = mysqli_fetch_assoc($RCBaohiem_CN);
$totalRows_RCBaohiem_CN = mysqli_num_rows($RCBaohiem_CN);
?>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="row2" width="800" align="center" cellpadding="3" cellspacing="3" bgcolor="#66CCFF">
    <tr valign="baseline">
      <td width="133" align="right" nowrap="nowrap">M?? nh??n vi??n:</td>
      <td width="237"><?php echo $row_RCBaohiem_CN['ma_nhan_vien']; ?></td>
      <td width="120">H??? v?? t??n:</td>
      <td width="269"><?php echo $row_RCBaohiem_CN['ho_ten']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">S??? s??? BHXH:</td>
      <td><input type="text" name="so_bhxh" value="<?php echo htmlentities($row_RCBaohiem_CN['so_bhxh'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td>S??? s??? BHYT:</td>
      <td><input type="text" name="so_bhyt" value="<?php echo htmlentities($row_RCBaohiem_CN['so_bhyt'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ng??y c???p BHXH:</td>
      <td><input type="text" name="ngay_cap_bhxh" value="<?php $sqldate = strtotime($row_RCBaohiem_CN['ngay_cap_bhxh']); $date = date('d-m-Y', $sqldate);echo $date;?>" size="32" /></td>
      <td>Ng??y c???p BHYT:</td>
      <td><input type="text" name="ngay_cap_bhyt" value="<?php $sqldate2 = strtotime($row_RCBaohiem_CN['ngay_cap_bhyt']); $date2 = date('d-m-Y', $sqldate2);echo $date2; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">N??i c???p BHXH:</td>
      <td><input type="text" name="noi_cap_bhxh" value="<?php echo htmlentities($row_RCBaohiem_CN['noi_cap_bhxh'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      <td>N??i c???p BHYT:</td>
      <td><input type="text" name="noi_cap_bhyt" value="<?php echo htmlentities($row_RCBaohiem_CN['noi_cap_bhyt'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="4" align="center" nowrap="nowrap"><input type="submit" value=":|: C???p nh???t :|:" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="ma_nhan_vien" value="<?php echo $row_RCBaohiem_CN['ma_nhan_vien']; ?>" />
</form>
<p></p>
</body>
</html>
<?php
mysqli_free_result($RCBaohiem_CN);
?>
