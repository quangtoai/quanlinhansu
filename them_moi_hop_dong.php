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
  $insertSQL = sprintf("INSERT INTO tlb_hopdong (ma_nhan_vien, so_quyet_dinh, tu_ngay, den_ngay, loai_hop_dong, ghi_chu) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['ma_nhan_vien'], "text"),
                       GetSQLValueString($_POST['so_quyet_dinh'], "text"),
                       GetSQLValueString($_POST['tu_ngay'], "date"),
                       GetSQLValueString($_POST['den_ngay'], "date"),
                       GetSQLValueString($_POST['loai_hop_dong'], "int"),
                       GetSQLValueString($_POST['ghi_chu'], "text"));

  mysql_select_db($database_Myconnection, $Myconnection);
  $Result1 = mysql_query($insertSQL, $Myconnection) or die(mysql_error());

  $insertGoTo = "them_moi_hop_dong.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  sprintf("Location: %s", $insertGoTo);
}

mysql_select_db($database_Myconnection, $Myconnection);
$query_RCHopdong_TM = "SELECT * FROM tlb_hopdong where ma_nhan_vien = '$ma_nv'";
$RCHopdong_TM = mysql_query($query_RCHopdong_TM, $Myconnection) or die(mysql_error());
$row_RCHopdong_TM = mysql_fetch_assoc($RCHopdong_TM);
$totalRows_RCHopdong_TM = mysql_num_rows($RCHopdong_TM);
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
if ($totalRows_RCHopdong_TM<>0)
{
?>
<table class="row2" width="800" border="0" cellspacing="1" cellpadding="1" align="center">
  <tr>
    <th width="150">S??? Q??</th>
    <th width="80">T??? ng??y</th>
    <th width="100">?????n ng??y</th>
    <th width="120">Lo???i h???p ?????ng</th>
    <th width="200">Ghi ch??</th>
    <th colspan="3">&nbsp;</th>
  </tr>
  <?php do { ?>
    <tr>
      <td class="row1"><?php echo $row_RCHopdong_TM['so_quyet_dinh']; ?></td>
      <td class="row1"><?php echo $row_RCHopdong_TM['tu_ngay']; ?></td>
      <td class="row1"><?php echo $row_RCHopdong_TM['den_ngay']; ?></td>
      <td class="row1">
        <?php 
	if ($row_RCHopdong_TM['loai_hop_dong']==0)
	{
		echo "Kh??ng th???i h???n"; 
	}
	else
	{
		echo $row_RCHopdong_TM['loai_hop_dong'];
		echo " N??m";
	}
	?>
      </td>
      <td class="row1"><?php echo $row_RCHopdong_TM['ghi_chu']; ?></td>
      <td width="50" class="row1"><a href="index.php?require=them_moi_hop_dong.php&catID=<?php echo $ma_nv; ?>&title=Th??m m???i qu?? tr??nh c??ng t??c">Th??m</a></td>
      <td width="50" class="row1"><a href="index.php?require=cap_nhat_hop_dong.php&catID=<?php echo $ma_nv; ?>&tomID=<?php echo $row_RCHopdong_TM['id']; ?>&title=C???p nh???t h???p ?????ng">S???a</a></td>
      <td width="50" class="row1">Xo??</td>
    </tr>
    <?php } while ($row_RCHopdong_TM = mysql_fetch_assoc($RCHopdong_TM)); ?>
</table>
<?php
}
?>
<p></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="row2" width="800" align="center" cellpadding="1" cellspacing="1">
    <tr valign="baseline">
      <td width="135" align="right" nowrap="nowrap">M?? nh??n vi??n</td>
      <td width="235"><input type="text" name="ma_nhan_vien" value="<?php echo $ma_nv; ?>" readonly="readonly" size="32" /></td>
      <td width="79">T??? ng??y:</td>
      <td width="310"><input type="text" name="tu_ngay" value="" size="25" />
        (yyyy/mm/dd)</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">S??? quy???t ?????nh:</td>
      <td><input type="text" name="so_quyet_dinh" value="" size="32" /></td>
      <td>?????n ng??y:</td>
      <td><input type="text" name="den_ngay" value="" size="25" />
      (yyyy/mm/dd)</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Lo???i h???p ?????ng:</td>
      <td><select name="loai_hop_dong">
        <option value="0" <?php if (!(strcmp(0, ""))) {echo "SELECTED";} ?>>Kh??ng th???i h???n</option>
        <option value="1" <?php if (!(strcmp(1, ""))) {echo "SELECTED";} ?>>1 N??m</option>
        <option value="2" <?php if (!(strcmp(2, ""))) {echo "SELECTED";} ?>>2 N??m</option>
        <option value="3" <?php if (!(strcmp(3, ""))) {echo "SELECTED";} ?>>3 N??m</option>
        <option value="4" <?php if (!(strcmp(4, ""))) {echo "SELECTED";} ?>>4 N??m</option>
      </select></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ghi ch??:</td>
      <td colspan="3"><input type="text" name="ghi_chu" value="" size="87" /></td>
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
mysql_free_result($RCHopdong_TM);
?>
