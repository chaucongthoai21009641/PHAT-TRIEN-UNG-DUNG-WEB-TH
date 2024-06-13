<?php
session_start();
error_reporting(0);
include('../myclass/clsquantri.php');
$u = new quantri();
if (isset( $_SESSION['id']) && isset($_SESSION['user']) && isset($_SESSION['pass'])  && isset($_SESSION['phanquyen'])) 
{
  include_once '../myclass/clslogin.php';
  $p = new login();
  $p->confirmlogin($_SESSION['id'], $_SESSION['user'], $_SESSION['pass'], $_SESSION['phanquyen']);
} 
else 
{
  header('location:../login');
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
$layid = $_REQUEST['id'];
$layten =$u->laycot("select tensp from sanpham where idsp='$layid' limit 1");
$laygia =$u->laycot("select gia from sanpham where idsp='$layid' limit 1");
$laymota =$u->laycot("select mota from sanpham where idsp='$layid' limit 1");
$laygiamgia =$u->laycot("select giamgia from sanpham where idsp='$layid' limit 1");

?>
<form method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="600" border="1" align="center" cellpadding="5" cellspacing="0">
    <tbody>
      <tr>
        <td colspan="2" align="center" valign="middle"><strong>QUẢN LÝ SẢN PHẨM</strong></td>
      </tr>
      <tr>
        <td width="166" align="left" valign="middle">Chọn nhà cung cấp</td>
        <td width="408" align="left" valign="middle">
		    <?php
          $layidcty =$u->laycot("select idcty from sanpham where idsp='$layid' limit 1");
          $u->choncongty("select * from congty order by tencty asc", $layidcty);
        ?>
        <input type="hidden" name="txtid" id="txtid" value="<?php echo $layid; ?>"></td>
		</td>
      </tr>
      <tr>
        <td align="left" valign="middle">Nhập tên sản phẩm</td>
        <td align="left" valign="middle"><input type="text" name="txtten" id="txtten" value="<?php echo $layten; ?>"></td>
      </tr>
      <tr>
        <td align="left" valign="middle">Nhập giá</td>
        <td align="left" valign="middle"><input type="text" name="txtgia" id="txtgia" value="<?php echo $laygia; ?>"></td>
      </tr>
      <tr>
        <td align="left" valign="middle">Nhập mô tả</td>
        <td align="left" valign="middle"><textarea name="txtmota" cols="50" rows="5" id="txtmota"><?php echo $laymota; ?></textarea></td>
      </tr>
      <tr>
        <td align="left" valign="middle">Nhập giảm giá</td>
        <td align="left" valign="middle"><input type="text" name="txtgiamgia" id="txtgiamgia" value="<?php echo $laygiamgia; ?>"></td>
      </tr>
      <tr>
        <td align="left" valign="middle">Chọn hình đại diện</td>
        <td align="left" valign="middle"><input type="file" name="myfile" id="myfile"></td>
      </tr>
      <tr>
        <td colspan="2" align="center" valign="middle"><input type="submit" name="nut" id="nut" value="Thêm sản phẩm">
        <input type="submit" name="nut" id="nut" value="Sửa sản phẩm">
        <input type="submit" name="nut" id="nut" value="Xóa sản phẩm"></td>
      </tr>
    </tbody>
  </table>

  <div align="center">
  <?php
  switch($_POST["nut"])
  {
    case 'Thêm sản phẩm';
    {
      $name = $_FILES['myfile']['name'];
      $tmp_name = $_FILES['myfile']['tmp_name'];
      $idcty = $_REQUEST['congty'];
      $ten = $_REQUEST['txtten'];
      $gia = $_REQUEST['txtgia'];
      $mota = $_REQUEST['txtmota'];
      $giamgia = $_REQUEST['txtgiamgia'];
      
      
      if($tmp_name!='')
      {
        $name = time()."_".$name;
        if($u->uploadfile($name, $tmp_name, "../img")==1)
        {
          if($u->themxoasua("INSERT INTO sanpham(tensp,gia,mota,hinh,giamgia,idcty) VALUES('$ten','$gia','$mota','$name','$giamgia','$idcty')")==1)
          {
            echo' <script language="javascript">
            alert("Thêm sản phẩm thành công");
            </script>';
          }
          else
          {
            echo' <script language="javascript">
            alert("Thêm sản phẩm thất bại");
            </script>';
          }
        }
        else
        {
          echo' <script language="javascript">
            alert("Upload hình thất bại");
            </script>';
        }
      }
      else
      {
        echo' <script language="javascript">
            alert("Vui lòng chọn hình đại diện");
            </script>';
      }
      echo '<script language="javascript">
          window.location="../admin/admin.php";
          </script';
      break;
    }
    case'Xóa sản phẩm';
    {
      $idxoa = $_REQUEST['txtid'];
      $hinh=$u->laycot("select hinh from sanpham where idsp='$idxoa' limit 1");
      if($idxoa>0)
      {
        if(unlink("../img/".$hinh))
        {
          if($u->themxoasua("delete from sanpham where idsp = '$idxoa' limit 1")==1)
          {
            echo' <script language="javascript">
            alert("Xóa sản phẩm thành công");
            </script>';
          }
        }
        
      }
      else
      {
        echo' <script language="javascript">
            alert("Vui lòng chọn sản phẩm cần xóa");
            </script>';
      }
      echo '<script language="javascript">
          window.location="../admin/admin.php";
          </script';
      break;
    }
    case 'Sửa sản phẩm';
    {
      $idsua = $_REQUEST['txtid'];
      $idcty = $_REQUEST['congty'];
      $ten = $_REQUEST['txtten'];
      $gia = $_REQUEST['txtgia'];
      $mota = $_REQUEST['txtmota'];
      $giamgia = $_REQUEST['txtgiamgia'];
      
      if($idsua>0)
      {
        if($u->themxoasua("update sanpham set tensp='$ten',gia='$gia',mota='$mota',giamgia='$giamgia' where idsp='$idsua' limit 1")==1)
          {
            echo '<script language="javascript">
            window.location="../admin/admin.php";
            </script';
          }
      }
      else
      {
        echo' <script language="javascript">
            alert("Vui lòng chọn sản phẩm cần sửa");
            </script>';
      }
      break;
    }
  }
  ?>
  </div>
  <hr><br>

  <?php
  $u->xemdanhsachsanpham("select * from sanpham order by idsp desc")
  ?>
</form>
</body>
</html>


