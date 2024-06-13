<?php
include("myclass/clskhachhang.php");
$p = new khachhang();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="container">
        <div id="banner"> 
            <div class="bn">BANNER WEBSITE</div>
        </div>
        <div id="menu">
            <form style="float: right;" action="" method="get">
                <input type="text" name="search" id="search" placeholder="Search...">
                <button type="submit" value="Search" name="nut">Tìm kiếm</button>
            </form>
        </div>
        <div id="main">
            <div id="left">MENU <br>
                <?php
                    $p->xemdscongty("select * from congty order by tencty asc");
                ?>
            </div>
            <div id="right">
                <?php
                    $idcty = $_REQUEST['id'];
                    $tensp = $_REQUEST['search'];
                    if (isset($idcty) && $idcty > 0) 
                    {
                        $p->xemdssanpham("select * from sanpham where idcty='$idcty' order by gia asc");
                    } 
                    else if(isset($_GET['nut']))
                    {
                        $p->xemdssanpham("select * from sanpham where tensp like N'%$tensp%'");
                    }
                    else 
                    {
                        $p->xemdssanpham("select * from sanpham order by gia asc");
                    }
                ?>
            </div>
        </div>
        <div id="footer">
            <div class="ft">Footer website</div>
        </div>
    </div>
</body>
</html>