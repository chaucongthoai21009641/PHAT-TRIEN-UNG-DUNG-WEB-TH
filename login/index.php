<?php
include_once("../myclass/clslogin.php");
$p = new login();
error_reporting(0);
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Untitled Document</title>
</head>

<body>
  <form id="form1" name="form1" method="post">
    <table width="400" border="1" align="center">
      <tbody>
        <tr>
          <td colspan="2" align="center"><strong>ĐĂNG NHẬP</strong></td>
        </tr>
        <tr>
          <td width="131" align="left" valign="middle">Nhập username</td>
          <td width="253" align="left" valign="middle"><input type="text" name="txtuser" id="txtuser"></td>
        </tr>
        <tr>
          <td align="left" valign="middle">Nhập password</td>
          <td align="left" valign="middle"> <input type="password" name="txtpass" id="txtpass"></td>
        </tr>
        <tr>
          <td colspan="2" align="center"><input type="submit" name="nut" id="nut" value="Đăng nhập">
            <input type="reset" name="reset" id="reset" value="Reset">
          </td>
        </tr>
      </tbody>
    </table>
    <div align="center">
      <?php
      switch ($_POST['nut']) {
        case 'Đăng nhập'; 
        {
          $user = $_REQUEST['txtuser'];
          $pass = $_REQUEST['txtpass'];
            if ($user != '' && $pass != '') {
              if ($p->connectlogin($user, $pass) == 0) 
              {
                echo 'Sai username hoặc password.';
              }
            } 
            else 
            {
              echo 'Vui lòng nhập đầy đủ username và password';
            }
            break;
          }
      }
      ?>
  </form>
</body>

</html>