<?php require_once('Connections/Myconnection.php'); ?>
<?php
$ma_nv = get_param('catID');
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
  $insertSQL = sprintf("INSERT INTO tlb_congviec (ma_nhan_vien, ngay_vao_lam, phong_ban_id, cong_viec_id, chuc_vu_id, muc_luong_cb, he_so, phu_cap, so_sld, ngay_cap, noi_cap, tknh, ngan_hang, hoc_van_id, bang_cap_id, ngoai_ngu_id, tin_hoc_id, dan_toc_id, quoc_tich_id, ton_giao_id, tinh_thanh_id) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString(get_param('ma_nhan_vien'), "text"),
                       GetSQLValueString(get_param('ngay_vao_lam'), "date"),
                       GetSQLValueString(get_param('phong_ban_id'), "text"),
                       GetSQLValueString(get_param('cong_viec_id'), "text"),
					   GetSQLValueString(get_param('chuc_vu_id'), "text"),
                       GetSQLValueString(get_param('muc_luong_cb'), "text"),
                       GetSQLValueString(get_param('he_so'), "text"),
                       GetSQLValueString(get_param('phu_cap'), "text"),
                       GetSQLValueString(get_param('so_sld'), "text"),
                       GetSQLValueString(get_param('ngay_cap'), "date"),
                       GetSQLValueString(get_param('noi_cap'), "text"),
                       GetSQLValueString(get_param('tknh'), "text"),
                       GetSQLValueString(get_param('ngan_hang'), "text"),
                       GetSQLValueString(get_param('hoc_van_id'), "text"),
                       GetSQLValueString(get_param('bang_cap_id'), "text"),
                       GetSQLValueString(get_param('ngoai_ngu_id'), "text"),
                       GetSQLValueString(get_param('tin_hoc_id'), "text"),
                       GetSQLValueString(get_param('dan_toc_id'), "text"),
                       GetSQLValueString(get_param('quoc_tich_id'), "text"),
                       GetSQLValueString(get_param('ton_giao_id'), "text"),
                       GetSQLValueString(get_param('tinh_thanh_id'), "text"));

  mysqli_select_db($Myconnection, $database_Myconnection);
  $Result1 = mysqli_query($Myconnection, $insertSQL) or die(mysqli_error());

  $insertGoTo = "danh_sach_nhan_vien.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  //th??m m???i c??ng vi???c xong, chuy???n sang trang danh s??ch nh??n vi??c
  	$url = "index.php";
	location($url);
}

mysqli_select_db($Myconnection, $database_Myconnection);
$query_RCPhongban = "SELECT * FROM tlb_phongban";
$RCPhongban = mysqli_query($Myconnection, $query_RCPhongban) or die(mysqli_error());
$row_RCPhongban = mysqli_fetch_assoc($RCPhongban);
$totalRows_RCPhongban = mysqli_num_rows($RCPhongban);
//L???y m?? nh??n vi??n ????a v??o ????? c???p nh???t
$query_RCThem_congviec = "SELECT * FROM tlb_nhanvien where ma_nhan_vien= '$ma_nv'";
$RCThem_congviec = mysqli_query($Myconnection, $query_RCThem_congviec) or die(mysqli_error());
$row_RCThem_congviec = mysqli_fetch_assoc($RCThem_congviec);
$totalRows_RCThem_congviec = mysqli_num_rows($RCThem_congviec);
//lay danh sach cong viec khi cap nhat
$query_RCctcongviec = "SELECT * FROM tlb_ctcongviec";
$RCctcongviec = mysqli_query($Myconnection, $query_RCctcongviec) or die(mysql_error());
$row_RCctcongviec = mysqli_fetch_assoc($RCctcongviec);
$totalRows_RCctcongviec = mysqli_num_rows($RCctcongviec);
// danh sach chuc vu
$query_RCChucvu = "SELECT * FROM tlb_chucvu";
$RCChucvu = mysqli_query($Myconnection, $query_RCChucvu) or die(mysqli_error());
$row_RCChucvu = mysqli_fetch_assoc($RCChucvu);
$totalRows_RCChucvu = mysqli_num_rows($RCChucvu);
//lay danh sach Hoc van
$query_RCHocvan = "SELECT * FROM tlb_hocvan";
$RCHocvan = mysqli_query($Myconnection, $query_RCHocvan ) or die(mysqli_error());
$row_RCHocvan = mysqli_fetch_assoc($RCHocvan);
$totalRows_RCHocvan = mysqli_num_rows($RCHocvan);
// lay danh sach bang cap
$query_RCBangcap = "SELECT * FROM tlb_bangcap";
$RCBangcap = mysqli_query($Myconnection, $query_RCBangcap) or die(mysqli_error());
$row_RCBangcap = mysqli_fetch_assoc($RCBangcap);
$totalRows_RCBangcap = mysqli_num_rows($RCBangcap);
//lay danh sach ngoai ngu
$query_RCNgoaingu = "SELECT * FROM tlb_ngoaingu";
$RCNgoaingu = mysqli_query($Myconnection, $query_RCNgoaingu) or die(mysqli_error());
$row_RCNgoaingu = mysqli_fetch_assoc($RCNgoaingu);
$totalRows_RCNgoaingu = mysqli_num_rows($RCNgoaingu);
//lay danh sach tin hoc
$query_RCTinhoc = "SELECT * FROM tlb_tinhoc";
$RCTinhoc = mysqli_query($Myconnection, $query_RCTinhoc) or die(mysqli_error());
$row_RCTinhoc = mysqli_fetch_assoc($RCTinhoc);
$totalRows_RCTinhoc = mysqli_num_rows($RCTinhoc);
//lay danh sach dan toc
$query_RCDantoc = "SELECT * FROM tlb_dantoc";
$RCDantoc = mysqli_query($Myconnection, $query_RCDantoc) or die(mysql_error());
$row_RCDantoc = mysqli_fetch_assoc($RCDantoc);
$totalRows_RCDantoc = mysqli_num_rows($RCDantoc);
//Lay danh sach quoc tich
$query_RCQuoctich = "SELECT * FROM tlb_quoctich";
$RCQuoctich = mysqli_query($Myconnection, $query_RCQuoctich) or die(mysql_error());
$row_RCQuoctich = mysqli_fetch_assoc($RCQuoctich);
$totalRows_RCQuoctich = mysqli_num_rows($RCQuoctich);
//Lay danh sach ton giao
$query_RCTongiao = "SELECT * FROM tlb_tongiao";
$RCTongiao = mysqli_query($Myconnection, $query_RCTongiao) or die(mysql_error());
$row_RCTongiao = mysqli_fetch_assoc($RCTongiao);
$totalRows_RCTongiao = mysqli_num_rows($RCTongiao);
//Lay danh sach tinh thanh
$query_RCTinhthanh = "SELECT * FROM tlb_tinhthanh";
$RCTinhthanh = mysqli_query($Myconnection, $query_RCTinhthanh) or die(mysql_error());
$row_RCTinhthanh = mysqli_fetch_assoc($RCTinhthanh);
$totalRows_RCTinhthanh = mysqli_num_rows($RCTinhthanh);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	line-height: 1.4;
}
-->
</style></head>

<body text="#000000" link="#CC0000" vlink="#0000CC" alink="#000099">
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table class="row2" width="800" align="center" cellpadding="2" cellspacing="2">
    <tr valign="baseline">
      <td width="96" align="right" nowrap="nowrap">M?? nh??n vi??n:</td>
      <td width="259"><input type="text" name="ma_nhan_vien" value="<?php echo $row_RCThem_congviec['ma_nhan_vien']; ?>" readonly="readonly" size="32" /></td>
      <td width="117">T??i kho???n NH:</td>
      <td width="300"><input type="text" name="tknh" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ng??y v??o l??m *:</td>
      <td><input type="text" name="ngay_vao_lam" value="" size="25" /></td>
      <td>Ng??n h??ng:</td>
      <td><input type="text" name="ngan_hang" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ph??ng ban:</td>
      <td><select name="phong_ban_id">
        <?php 
do {  
?>
        <option value="<?php echo $row_RCPhongban['phong_ban_id']?>"><?php echo $row_RCPhongban['ten_phong_ban']?></option>
        <?php
} while ($row_RCPhongban = mysql_fetch_assoc($RCPhongban));
?>
      </select></td>
      <td>H???c v???n:</td>
      <td><select name="hoc_van_id">
        <?php 
do {  
?>
        <option value="<?php echo $row_RCHocvan['hoc_van_id']?>"><?php echo $row_RCHocvan['ten_hoc_van']?></option>
        <?php
} while ($row_RCHocvan = mysql_fetch_assoc($RCHocvan));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">C??ng vi???c:</td>
      <td><select name="cong_viec_id">
        <?php 
do {  
?>
        <option value="<?php echo $row_RCctcongviec['cong_viec_id']?>"><?php echo $row_RCctcongviec['ten_cong_viec']?></option>
        <?php
} while ($row_RCctcongviec = mysql_fetch_assoc($RCctcongviec));
?>
      </select></td>
      <td>B???ng c???p:</td>
      <td><select name="bang_cap_id">
        <?php 
do {  
?>
        <option value="<?php echo $row_RCBangcap['bang_cap_id']?>"><?php echo $row_RCBangcap['ten_bang_cap']?></option>
        <?php
} while ($row_RCBangcap = mysql_fetch_assoc($RCBangcap));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ch???c v???:</td>
      <td><select name="chuc_vu_id">
        <?php 
do {  
?>
        <option value="<?php echo $row_RCChucvu['chuc_vu_id']?>"><?php echo $row_RCChucvu['ten_chuc_vu']?></option>
        <?php
} while ($row_RCChucvu = mysql_fetch_assoc($RCChucvu));
?>
      </select></td>
      <td>Ngo???i ng???:</td>
      <td><select name="ngoai_ngu_id">
        <?php 
do {  
?>
        <option value="<?php echo $row_RCNgoaingu['ngoai_ngu_id']?>"><?php echo $row_RCNgoaingu['ten_ngoai_ngu']?></option>
        <?php
} while ($row_RCNgoaingu = mysql_fetch_assoc($RCNgoaingu));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">M???c l????ng :</td>
      <td><input type="text" name="muc_luong_cb" value="" size="32" /></td>
      <td>Tin h???c:</td>
      <td><select name="tin_hoc_id">
        <?php 
do {  
?>
        <option value="<?php echo $row_RCTinhoc['tin_hoc_id']?>"><?php echo $row_RCTinhoc['ten_tin_hoc']?></option>
        <?php
} while ($row_RCTinhoc = mysql_fetch_assoc($RCTinhoc));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">H??? s???:</td>
      <td><input type="text" name="he_so" value="" size="32" /></td>
      <td>D??n t???c:</td>
      <td><select name="dan_toc_id">
        <?php 
do {  
?>
        <option value="<?php echo $row_RCDantoc['dan_toc_id']?>"><?php echo $row_RCDantoc['ten_dan_toc']?></option>
        <?php
} while ($row_RCDantoc = mysql_fetch_assoc($RCDantoc));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ph??? c???p:</td>
      <td><input type="text" name="phu_cap" value="" size="32" /></td>
      <td>Qu???c t???ch:</td>
      <td><select name="quoc_tich_id">
        <?php 
do {  
?>
        <option value="<?php echo $row_RCQuoctich['quoc_tich_id']?>"><?php echo $row_RCQuoctich['ten_quoc_tich']?></option>
        <?php
} while ($row_RCQuoctich = mysql_fetch_assoc($RCQuoctich));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">S??? s??? lao ?????ng:</td>
      <td><input type="text" name="so_sld" value="" size="32" /></td>
      <td>T??n gi??o:</td>
      <td><select name="ton_giao_id">
        <?php 
do {  
?>
        <option value="<?php echo $row_RCTongiao['ton_giao_id']?>"><?php echo $row_RCTongiao['ten_ton_giao']?></option>
        <?php
} while ($row_RCTongiao = mysql_fetch_assoc($RCTongiao));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ng??y c???p:</td>
      <td><input type="text" name="ngay_cap" value="" size="32" /></td>
      <td>T???nh th??nh:</td>
      <td><select name="tinh_thanh_id">
        <?php 
do {  
?>
        <option value="<?php echo $row_RCTinhthanh['tinh_thanh_id']?>"><?php echo $row_RCTinhthanh['ten_tinh_thanh']?></option>
        <?php
} while ($row_RCTinhthanh = mysql_fetch_assoc($RCTinhthanh));
?>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">N??i c???p:</td>
      <td><input type="text" name="noi_cap" value="" size="32" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr valign="baseline">
      <td colspan="4" align="center" nowrap="nowrap"><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($RCPhongban);
?>
