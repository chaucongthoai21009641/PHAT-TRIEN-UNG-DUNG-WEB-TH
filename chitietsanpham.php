<?php
include ("myclass/clskhachhang.php");
$p= new khachhang();
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div id="container">
        <div id="banner">
            <div class="bn">CHI TIẾT SẢN PHẨM</div>
        </div>
        <div id="main">
        <input type="hidden" name="txtid" id="txtid" value="<?php echo $layid; ?>">
        <form id="form1" name="form1" method="post">
            <?php
            $idsp=$_REQUEST['id'];
            $p->xemchitietsp("select * from sanpham where idsp='$idsp' limit 1");
            ?>

            <div align="center">
            <?php
            if($_POST['nut']=='Đặt hàng')
            {
				if(isset($_SESSION['id']))
				{
					$idkh=$_SESSION['id'];
					$ngaydathang=date('Y-m-d');
					$idsp=$_REQUEST['id'];
					$gia=$p->laycot("select gia from sanpham where idsp='$idsp' limit 1");
					$giamgia=$p->laycot("select giamgia from sanpham where idsp='$idsp' limit 1");
					$soluong=$_REQUEST['txtsoluong'];
					if($p->themxoasua("insert into dathang(idkh,id_nhanvien,ngaydathang,trangthai) values ('$idkh','0','$ngaydathang','0')")!=0)
					{
						$iddh=$p->laycot("select iddh from dathang where idkh='$idkh' order by iddh desc limit 1");
						if($iddh>0)
						{
							if($p->themxoasua("INSERT INTO dathang_chitiet(iddh,idsp,soluong,dongia,giamgia) VALUES ('$iddh', '$idsp', '$soluong', '$gia', '$giamgia')")==1)
							{
								echo '<script language="javascript">
                                   alert("Đặt hàng thành công");
                                   </script>';
							}
						}
					}
					else
					{
						echo'Lỗi đặt hàng không thành công';
					}
				}
                else
                {
                    echo '<script language="javascript">
                        alert("Vui lòng đăng nhập trước khi đặt hàng");
                        </script>';
                        
                    echo '<script language="javascript">
                    window.location="khachhang";
                    </script>';
                }
                    
            }
            elseif ($_POST['nut'] == 'Xóa') 
            {
                if (isset($_SESSION['id'])) 
                {
                    $idkh = $_SESSION['id'];
                    $idsp = $_REQUEST['id'];
                    $iddh = $_REQUEST['idct'];

                    if ($idkh > 0 && $idsp > 0 && $iddh > 0) 
                    {
                        if ($p->themxoasua("DELETE FROM dathang where iddh='$iddh' limit 1") == 1) 
                        {
                            if ($p->themxoasua("DELETE FROM dathang_chitiet where iddh='$iddh'") == 1) 
                            {
                                echo '<script language="javascript">
                                    alert("Xóa sản phẩm thành công");
                                    </script>';
                            }
                        }
                    }
                } 
                else 
                {
                    echo 'Xóa sản phẩm không thành công!';
                }
            } 

            elseif ($_POST['nut'] == 'Sửa') 
            {
                if (isset($_SESSION['id'])) 
                {
                    $idkh = $_SESSION['id'];
                    $idsp = $_REQUEST['id'];
                    $iddh = $_REQUEST['idct'];
                    $soluong = $_REQUEST['txtsoluong'];
                    
                    if ($idkh > 0 && $iddh > 0 && $idsp > 0) 
                    {
                        if ($p->themxoasua("update dathang_chitiet set soluong='$soluong' where iddh='$iddh' limit 1") == 1) 
                        {
                            $p->laycot("select giamgia from sanpham where idsp='$idsp' limit 1");
                            echo '<script language="javascript">
                                alert("Sửa sản phẩm thành công");
                                </script>';
                        }
                    }
                } 
                else 
                {
                    echo 'Sửa sản phẩm không thành công';
                }
            }
              
            ?>
            <hr>
            <?php
            if(isset($_SESSION['id'])) 
            {
                $idkh=$_SESSION['id'];
                $tenkh=$p->laycot("select ten from khachhang where iduser='$idkh' limit 1");
				echo '<div align="right">Xin chào: ' .$tenkh.'<a href="khachhang/logout.php">  Logout</a></div>';
                $p->giohang("select ct.iddh, ct.idsp, ct.soluong, ct.dongia, ct.giamgia from 
                dathang dh, dathang_chitiet ct where dh.iddh=ct.iddh and idkh='$idkh'");
            }
            ?>
            </div>
        </form>
        </div>
        <div id="footer">
            <div class="ft">Footer website</div>
        </div>
    </div>
</body>
</html>
