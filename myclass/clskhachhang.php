<?php
include('clstmdt.php');
class khachhang extends tmdt
{
    public function xemdssanpham($sql)
    {
        $link = $this->connect();
        $ketqua = mysql_query($sql, $link);
        $i = mysql_num_rows($ketqua);
        if ($i > 0) 
        {
            while ($row = mysql_fetch_array($ketqua)) 
            {
                $idsp = $row['idsp'];
                $tensp = $row['tensp'];
                $hinh = $row['hinh'];
                $gia = $row['gia'];
                echo '<div id="sanpham">
                <div id="sanpham_ten">'.$tensp.'</div>
                <div id="sanpham_hinh"><a href="chitietsanpham.php?id='.$idsp.'"> <img src="img/'.$hinh.'"width="160" height="170" alt=""/></a></div>
                <div id="sanpham_gia">Giá: '.$gia.' USD</div>
                </div>';
            }
        } 
        else 
        {
            echo 'Đang cập nhật dữ liệu.';
        }
    }

    public function xemdscongty($sql)
    {
        $link = $this->connect();
        $ketqua = mysql_query($sql, $link);
        $i = mysql_num_rows($ketqua);
        if ($i > 0) 
        {
            while ($row = mysql_fetch_array($ketqua)) 
            {
                $idcty = $row['idcty'];
                $tencty = $row['tencty']; 
                echo ' <a href="?id='.$idcty.'">'.$tencty.'</a> <br>';
            }
        } 
        else 
        {
            echo 'Đang cập nhật dữ liệu.';
        }
    }

    public function xemchitietsp($sql)
	 	{
			$link=$this->connect();
			$ketqua=mysql_query($sql,$link);
			$i=mysql_num_rows($ketqua);
            if($i>0)
			{
				echo'<table width="600" border="1" align="center" cellpadding="3" cellspacing="0">
                <tbody>';
				while($row=mysql_fetch_array($ketqua))
				{
					$idsp=$row['idsp'];
					$tensp=$row['tensp'];
					$gia=$row['gia'];
                    $mota=$row['mota'];
                    $hinh=$row['hinh'];
					$giamgia=$row['giamgia'];
					$idcty=$row['idcty'];
					$tencty=$this->laycot("select tencty from congty where idcty='$idcty' limit 1");
                    $soluong = 1;

                    if ($this->laycot("select soluong from dathang_chitiet where idsp='$idsp' limit 1")) 
                    {
                        $soluong = $this->laycot("select soluong from dathang_chitiet where idsp='$idsp' limit 1");
                    }
					
				echo '<tr>
                        <td width="261" rowspan="7"><img src="img/'.$hinh.'" width="205" alt=""/></td>
                        <td width="149"><strong>TÊN SẢN PHẨM</strong></td>
                        <td width="164">'.$tensp.'</td>
                    </tr>
                    <tr>
                        <td><strong>NHÀ SẢN XUẤT</strong></td>
                        <td>'.$tencty.'</td>
                    </tr>
                    <tr>
                        <td><strong>MÔ TẢ</strong></td>
                        <td>'.$mota.'</td>
                    </tr>
                    <tr>
                        <td><strong>GIÁ</strong></td>
                        <td>'.$gia.'</td>
                    </tr>
                    <tr>
                        <td><strong>GIẢM GIÁ</strong></td>
                        <td>'.$giamgia.'</td>
                    </tr>
                    <tr>
                        <td><strong>SỐ LƯỢNG</strong></td>
                        <td><input type="text" name="txtsoluong" id="txtsoluong" value="'.$soluong.'"></td>
                    </tr>
                    <tr>
                        <td><strong>CHỨC NĂNG</strong></td>
                        <td><input type="submit" name="nut" id="nut" value="Đặt hàng">
                        <input type="submit" name="nut" id="nut" value="Sửa">
                        <input type="submit" name="nut" id="nut" value="Xóa">
                        </td>
                    </tr>';
				}
				echo'</tbody>
					</table>';
			}
			else
			{
				echo 'Không có dữ liệu';
			}
		}
		
		public function giohang($sql)
			{
				$link=$this->connect();
                $ketqua=mysql_query($sql,$link);
                $i=mysql_num_rows($ketqua);
                if($i>0)
                {
                    echo'<table width="600" border="1" align="center" cellpadding="3" cellspacing="0">
                    <tbody>
						<tr>
                            <td><strong>STT</strong></td>
                            <td><strong>TÊN SẢN PHẨM</strong></td>
                            <td><strong>SỐ LƯỢNG</strong></td>
                            <td><strong>GIÁ</strong></td>
                            <td><strong>GIẢM GIÁ</strong></td>
                        </tr>';
					$dem=1;
					while($row=mysql_fetch_array($ketqua))
					{	
                        $iddh=$row['0'];
                        $idsp=$row['1'];
                        $tensp=$this->laycot("select tensp from sanpham where idsp='$idsp' limit 1");
                        $soluong=$row['2'];
                        $gia=$row['3'];
                        $giamgia=$row['4'];

                        echo'<tr>
                            <td><a href="chitietsanpham.php?id='.$idsp.'&idct='.$iddh.'">'.$dem.'</a></td>
                            <td><a href="chitietsanpham.php?id='.$idsp.'&idct='.$iddh.'">'.$tensp.'</a></td>
                            <td><a href="chitietsanpham.php?id='.$idsp.'&idct='.$iddh.'">'.$soluong.'</a></td>
                            <td><a href="chitietsanpham.php?id='.$idsp.'&idct='.$iddh.'">'.$gia.'</a></td>
                            <td><a href="chitietsanpham.php?id='.$idsp.'&idct='.$iddh.'">'.$giamgia.'</a></td>
                        </tr>';
                        $dem++;
                    }
					echo'</tbody>
						</table>';
				}
                else
                {
                    echo 'Không tìm thấy dữ liệu';
                }
            }
        
    }
?>