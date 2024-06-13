<?php
include_once('clstmdt.php');
class login extends tmdt
{	
		public function connectlogin($user,$pass)
		{
			$pass=md5($pass);
			$sql="select iduser, username, password, phanquyen from 
			taikhoan where username='$user' and password='$pass' limit 1";	
			$link=$this->connect();
			$ketqua=mysql_query($sql, $link);
			$i=mysql_num_rows($ketqua);
			if($i==1)
			{
				while($row=mysql_fetch_array($ketqua))
				{	
					$id=$row['iduser'];
					$myuser=$row['username'];
					$mypass=$row['password'];
					$phanquyen=$row['phanquyen'];
					session_start();
					$_SESSION['id']=$id;
					$_SESSION['user']=$myuser;
					$_SESSION['pass']=$mypass;
					$_SESSION['phanquyen']=$phanquyen;
					header('location:../admin/admin.php');
				}
			}
			else
			{
				return 0;	
			}	
		}

		public function mylogin($user,$pass,$table,$header)
		{
			$pass=md5($pass);
			$sql="select iduser, username, password, phanquyen from $table where username='$user' and password='$pass' limit 1";	
			$link=$this->connect();
			$ketqua=mysql_query($sql, $link);
			$i=mysql_num_rows($ketqua);
			if($i==1)
			{
				while($row=mysql_fetch_array($ketqua))
				{	
					$id=$row['iduser'];
					$myuser=$row['username'];
					$mypass=$row['password'];
					$phanquyen=$row['phanquyen'];
					session_start();
					$_SESSION['id']=$id;
					$_SESSION['user']=$myuser;
					$_SESSION['pass']=$mypass;
					$_SESSION['phanquyen']=$phanquyen;
					header('location:'.$header);
				}
			}
			else
			{
				return 0;	
			}	
		}

		public function confirmlogin($id,$user,$pass,$phanquyen)
		{
			$sql="select iduser from taikhoan where iduser='$id' and username='$user' 
			and password='$pass' and phanquyen='$phanquyen' limit 1";
			$link=$this->connect();
			$ketqua=mysql_query($sql,$link);
			$i=mysql_num_rows($ketqua);
			if($i!=1)
			{
				header ('location:../login');	
			}
		}
}

?>