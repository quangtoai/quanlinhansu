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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tlb_quatrinhluong (ma_nhan_vien, so_quyet_dinh, ngay_chuyen, muc_luong, ghi_chu) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ma_nhan_vien'], "text"),
                       GetSQLValueString($_POST['so_quyet_dinh'], "text"),
                       GetSQLValueString($_POST['ngay_chuyen'], "date"),
                       GetSQLValueString($_POST['muc_luong'], "text"),
                       GetSQLValueString($_POST['ghi_chu'], "text"));

  mysql_select_db($database_Myconnection, $Myconnection);
  $Result1 = mysql_query($insertSQL, $Myconnection) or die(mysql_error());

  $insertGoTo = "them_moi_qua_trinh_luong.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  sprintf("Location: %s", $insertGoTo);
}

mysql_select_db($database_Myconnection, $Myconnection);
$query_RCQTluong_TM = "SELECT * FROM tlb_quatrinhluong where ma_nhan_vien = '$ma_nv'";
$RCQTluong_TM = mysql_query($query_RCQTluong_TM, $Myconnection) or die(mysql_error());
$row_RCQTluong_TM = mysql_fetch_assoc($RCQTluong_TM);
$totalRows_RCQTluong_TM = mysql_num_rows($RCQTluong_TM);
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
<table width="800" border="0" cellspacing="1" cellpadding="0" align="center">
  <tr>
    <td class="row2" width="288" valign="top"><form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table width="288" align="center" cellpadding="1" cellspacing="1">
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">M?? nh??n vi??n:</td>
            <td><input type="text" name="ma_nhan_vien" value="<?php echo $ma_nv; ?>" readonly="readonly" size="25" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">S??? quy???t ?????nh:</td>
            <td><input type="text" name="so_quyet_dinh" value="" size="25" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Ng??y chuy???n:</td>
            <td><input type="text" name="ngay_chuyen" value="" size="25" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">M???c l????ng:</td>
            <td><input type="text" name="muc_luong" value="" size="25" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">Ghi ch??:</td>
            <td><input type="text" name="ghi_chu" value="" size="25" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td><input type="submit" value=":|: Th??m m???i :|:" /></td>
          </tr>
          <tr valign="baseline">
            <td nowrap="nowrap" align="right">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
    </td>
    <td class="row2" width="485" valign="top">
    <?php
		if ($totalRows_RCQTluong_TM<>0)
		{
	?>
    <table width="485" border="0" cellspacing="1" cellpadding="1" align="center">
      <tr>
        <th width="185">S??? quy???t ?????nh</th>
        <th width="100">Ng??y chuy???n</th>
        <th width="88">M???c l????ng</th>
        <th colspan="2">&nbsp;</th>
        </tr>
      <?php do { ?>
        <tr>
          <td class="row1"><?php echo $row_RCQTluong_TM['so_quyet_dinh']; ?></td>
          <td class="row1"><?php echo $row_RCQTluong_TM['ngay_chuyen']; ?></td>
          <td class="row1"><?php echo $row_RCQTluong_TM['muc_luong']; ?></td>
          <td width="35" class="row1"><a href="index.php?require=cap_nhat_qua_trinh_luong.php&catID=<?php echo $ma_nv; ?>&tomID=<?php echo $row_RCQTluong_TM['id']; ?>&title=C???p nh???t qu?? tr??nh l????ng">S???a</a></td>
          <td width="35" class="row1">Xo??</td>
        </tr>
        <?php } while ($row_RCQTluong_TM = mysql_fetch_assoc($RCQTluong_TM)); ?>
    </table>
    <?php
		}
	?>
    </td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($RCQTluong_TM);
?>
