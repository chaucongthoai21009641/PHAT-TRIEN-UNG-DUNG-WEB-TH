<?php
class tmdt
{
    public function connect()
    {
        $con = mysql_connect("localhost", "usertmdt", "passtmdt");
        if (!$con) 
        {
            echo 'Không thể kết nối được csdl.';
            exit();
        } 
        else 
        {
            mysql_select_db("tmdt_db");
            mysql_query("SET NAMES UTF8");
            return $con;
        }
    }

    public function xuatdscongty($sql)
    {
        $link = $this->connect();
        $ketqua = mysql_query($sql, $link);
        $i = mysql_num_rows($ketqua);
        if ($i > 0) 
        {
            echo '<table width="500" border="1">
                            <tbody>
                            <tr>
                                <td width="133">STT</td>
                                <td width="199">TÊN CÔNG TY </td>
                                <td width="146">ĐỊA CHỈ</td>
                            </tr>';
            $dem = 1;
            while ($row = mysql_fetch_array($ketqua)) 
            {

                $idcty = $row['idcty'];
                $tencty = $row['tencty'];
                $diachi = $row['diachi'];
                echo '<tr>
                        <td>' . $dem . '</td>
                        <td>' . $tencty . '</td>
                        <td>' . $diachi . '</td>
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

    public function uploadfile ($name, $tmp_name, $folder)
    {
        $newname = $folder."/".$name;
        if(move_uploaded_file($tmp_name, $newname))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function themxoasua($sql)
    {
        $link=$this->connect();
        if(mysql_query($sql, $link))
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function laycot($sql)
    {
        $link = $this->connect();
        $ketqua = mysql_query($sql, $link);
        $i = mysql_num_rows($ketqua);
        $trave = '';
        if ($i > 0) 
        {
            while ($row = mysql_fetch_array($ketqua)) 
            {
                $gt = $row[0];
                $trave = $gt;
            }
        }
        return $trave;
    }

}
?>
