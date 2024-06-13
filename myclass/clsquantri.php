<?php
include ("clstmdt.php");
class quantri extends tmdt 
{
    public function choncongty($sql, $idchon)
    {
        $link = $this->connect();
        $ketqua = mysql_query($sql, $link);
        $i = mysql_num_rows($ketqua);
        if($i > 0) 
        {
            echo '<select name="congty" id="congty">
                <option>Mời chọn công ty cung cấp</option>';
            while ($row=mysql_fetch_array($ketqua)) 
            {

                $idcty = $row['idcty'];
                $tencty = $row['tencty'];
                if($idchon==$idcty)
                {
                    echo '<option value="'.$idcty.'" selected>'.$tencty.'</option>';
                }
                else
                {
                    echo '<option value="'.$idcty.'">'.$tencty.'</option>';
                }
            }
            echo '</select>';
        } 
        else 
        {
            echo 'Không có dữ liệu';
        }
    }

    public function xemdanhsachsanpham($sql)
    {
        $link = $this->connect();
        $ketqua = mysql_query($sql, $link);
        $i = mysql_num_rows($ketqua);
        if($i > 0) 
        {
            echo '<table width="600" border="1" align="center" cellpadding="2" cellspacing="0">
                <tbody>
                <tr>
                    <td width="50" align="center" valign="middle">STT</td>
                    <td width="180" align="center" valign="middle">TÊN SẢN PHẨM</td>
                    <td width="199" align="center" valign="middle">MÔ TẢ</td>
                    <td width="145" align="center" valign="middle">GIÁ</td>
                </tr>';
                $dem=1;
            while ($row=mysql_fetch_array($ketqua)) 
            {

                $idsp = $row['idsp'];
                $tensp = $row['tensp']; 
                $gia = $row['gia']; 
                $mota = $row['mota']; 
                
                echo '<tr>
                    <td align="center" valign="middle"><a href="?id='.$idsp.'">'.$dem.'</a></td>
                    <td align="left" valign="middle"><a href="?id='.$idsp.'">'.$tensp.'</a></td>
                    <td align="left" valign="middle"><a href="?id='.$idsp.'">'.$mota.'</a></td>
                    <td align="left" valign="middle"><a href="?id='.$idsp.'">'.$gia.'</a></td>
                    </tr>';
                $dem++;
            }
            echo '</tbody>
                </table>';
            
        } 
        else 
        {
            echo 'Không có dữ liệu';
        }
    }
}
?>