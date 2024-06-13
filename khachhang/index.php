<?php include ("../myclass/clslogin.php");
$p= new login();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
<body>
<form id="form1" name="form1" method="post">
  <table width="600" border="1" align="center" cellpadding="5">
    <tbody>
      <tr>
        <td colspan="2" align="center">Đăng Nhập</td>
      </tr>
      <tr>
        <td width="149">Nhập email</td>
        <td width="419"><input type="text" name="txtuser" id="txtuser"></td>
      </tr>
      <tr>
        <td>Nhập mật khẩu</td>
        <td><input type="password" name="txtpass" id="txtpass"></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><input type="submit" name="nut" id="nut" value="Đăng nhập">
        <input type="reset" name="reset" id="reset" value="Reset"></td>
      </tr>
    </tbody>
  </table>
  <div align="center">
  <?php
  if($_POST['nut']=='Đăng nhập')
  {
	  $user=$_REQUEST['txtuser'];
	  $pass=$_REQUEST['txtpass'];
	  if($user!='' && $pass!='')
	  {
		  if($p->mylogin($user,$pass,"khachhang","../")==0)
		  {
			  echo'Sai username hoặc password';
		  }
	  }
	  else
	  {
		  echo'Vui lòng nhập đầy đủ thông tin';
	  }
  }
  ?>
  </div>
</form>
</body>
</html>