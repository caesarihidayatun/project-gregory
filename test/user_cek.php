<?php
if(isset($_POST["name2check"]) && $_POST["name2check"] != ""){
    //include_once 'my_folder/connect_to_mysql.php';
    $sql = mysql_connect("localhost","root","");
    mysql_select_db("perdagangan_elektronik",$sql);
    $username = preg_replace('#[^a-z0-9]#i', '', $_POST['name2check']); 
    $sql_uname_check = mysql_query("SELECT kode FROM pengguna WHERE kode='$username' LIMIT 1"); 
    $uname_check = mysql_num_rows($sql_uname_check);
    if (strlen($username) < 4) {
	    echo '4 - 15 characters please';
	    exit();
    }
	if (is_numeric($username[0])) {
	    echo 'First character must be a letter';
	    exit();
    }
    if ($uname_check < 1) {
	    echo '<strong>' . $username . '</strong> is OK';
	    exit();
    } else {
	    echo '<strong>' . $username . '</strong> is taken';
	    exit();
    }
}
?>
<html>
<head>
<script type="text/javascript" language="javascript">
function checkusername(){
	var status = document.getElementById("usernamestatus");
	var u = document.getElementById("uname").value;
	if(u != ""){
		status.innerHTML = 'checking...';
		var hr = new XMLHttpRequest();
		hr.open("POST", "user_cek.php", true);
		hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		hr.onreadystatechange = function() {
			if(hr.readyState == 4 && hr.status == 200) {
				status.innerHTML = hr.responseText;
			}
		}
    var v = "name2check="+u;
    hr.send(v);
	}
}
</script>
</head>
<body>
<input type="text" name="uname" id="uname" onblur="checkusername()" maxlength="15" />
<span id="usernamestatus"></span>
</body>
</html>