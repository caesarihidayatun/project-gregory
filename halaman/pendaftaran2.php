<script language="JavaScript"> 

 function validasiForm()
    	{
		if ((document.reg.kode.value != ""))
		{
		var user = /^[a-zA-Z0-9]{4,15}$/; 
		if ((user.test(document.reg.kode.value) == false))
				{
					alert("Terdapat kesalahan penulisan pada kolom Username.");
					return false;
				}
		}
		{
        formObj = document.reg;
        if ((formObj.kode.value == ""))
 
        { 
            alert("Username tisak boleh kosong.");
            return false;
        }
		 
		{
        formObj = document.reg;
        if ((formObj.kata_kunci.value != formObj.ulangi_kata_kunci.value))
 
        { 
            alert("Konfirmasi password salah.");
            return false;
        }
		 
		if ((document.reg.kata_kunci.value != ""))
		{
		var pass = /^[a-zA-Z0-9]{6,20}$/; 
		if ((pass.test(document.reg.kata_kunci.value) == false))
				{
					alert("Password tidak boleh kurang dari 6 karakter dan maksimal 20 karakter.");
					return false;
				}
		}
    	{
        formObj = document.reg;
        if ((formObj.kata_kunci.value == ""))
 
        {
            alert("Password tidak boleh kosong.");
 
            return false;
        }	
 
 
    	{
        formObj = document.reg;
        if ((formObj.ulangi_kata_kunci.value == ""))
 
        {
            alert("Anda belum mengkonfirmasi password.");
 
            return false;
        }	
		
		
    	{
        formObj = document.reg;
        if ((document.reg.email.value != ""))
		{
		var em = /^.+\@(\[?)[a-zA-Z0-9\-\_\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?)$/; 
		if ((em.test(document.reg.email.value) == false))
				{
					alert("Terdapat kesalahan penulisan pada kolom Email.");
					return false;
				}
		}
		{
        formObj = document.reg;
        if ((formObj.email.value == ""))
 
        {
            alert("Email tidak boleh kosong.");
 
            return false;
        }
		
		{
        formObj = document.reg;
        if ((formObj.nama.value == ""))
 
        {
            alert("nama tidak boleh kosong.");
 
            return false;
        }
		
		{
        formObj = document.reg;
        if ((formObj.alamat.value == ""))
 
        {
            alert("Alamat tidak boleh kosong.");
 
            return false;
        }
		
		if ((document.reg.kodepos.value != ""))
		{
		var telp = /^[0-9]{5,5}$/; 
		if ((telp.test(document.reg.kodepos.value) == false))
				{
					alert("Terdapat kesalahan penulisan pada kolom Kodepos.");
					return false;
				}
		}
		
		{
        formObj = document.reg;
        if ((formObj.kodepos.value == ""))
 
        {
            alert("Kode Pos tidak boleh kosong.");
 
            return false;
        }
		
		if ((document.reg.telepon.value != ""))
		{
		var telp = /^[0-9]{10,15}$/; 
		if ((telp.test(document.reg.telepon.value) == false))
				{
					alert("Terdapat kesalahan penulisan pada kolom Telepon/HP.");
					return false;
				}
		}
		{
        formObj = document.reg;
        if ((formObj.telepon.value == ""))
 
        {
            alert("Telepon/HP tidak boleh kosong.");
 
            return false;
        }
		{
        if ((document.reg.ccek.value == ""))
							 
		{
			alert("anda belum menulis captha");
							 
			return false;
		}
		
		else
            return true;
						
		}}}}}}}}}}}}
		
		function checkusername(){
		var status = document.getElementById("usernamestatus");
		var u = document.getElementById("uname").value;
		if(u != ""){
			status.innerHTML = 'checking...';
			var hr = new XMLHttpRequest();
			hr.open("POST", "http://localhost/gregory-ta/halaman/pendaftaran2.php", true);
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
<?php

$konek = mysql_connect("localhost","root","");
mysql_selectdb("perdagangan_elektronik",$konek);

if (isset($_GET['deleteid'])) 
{
    echo 'Yakin Menghapus Item ini ' . $_GET['deleteid'] . '? 
    <a href="pengguna2.php?yesdelete=' . $_GET['deleteid'] . '">Yes
    </a> | <a href="pengguna2.php">No</a>';
	exit();
}
if (isset($_GET['yesdelete'])) 
{
	$id_to_delete = $_GET['yesdelete'];
	mysql_query("DELETE FROM pengguna WHERE no='$id_to_delete' LIMIT 1") or die (mysql_error());
?>
<script>
    alert("item telah terhapus");
    location.href("pengguna2.php");
</script>
<?php
}

?>

<?php
 
if (isset($_POST['nama'])) 
{
    //$no = mysql_real_escape_string($_POST['no']);
    $kode = mysql_real_escape_string($_POST['kode']);
    $nama = mysql_real_escape_string($_POST['nama']);
    $kata_kunci = mysql_real_escape_string($_POST['kata_kunci']);
    $alamat = mysql_real_escape_string($_POST['alamat']);
    $email = mysql_real_escape_string($_POST['email']);
    $kota = mysql_real_escape_string($_POST['kota']);
	$kodepos = mysql_real_escape_string($_POST['kodepos']);
    $telepon = mysql_real_escape_string($_POST['telepon']);
    //$tanggal_disisipkan = mysql_real_escape_string($_POST['tanggal_disisipkan']);
    $jenis_pengguna = mysql_real_escape_string($_POST['jenis_pengguna']);
    $status_pengguna = mysql_real_escape_string($_POST['status_pengguna']);
	$sql = mysql_query("SELECT kode FROM pengguna WHERE nama='$kode' LIMIT 1");
	$productMatch = mysql_num_rows($sql);
    if ($productMatch > 0) 
        {
		echo 'Sudah terpakai Untuk Kode "nama" , <a href="http://localhost/perdagangan_elektronik/admin/halaman/pengguna2.php">Kembali</a>';
		exit();
        }
    else
    {
	$sql = mysql_query("INSERT INTO pengguna (no, kode, nama, kata_kunci, alamat, kode_pos, email, kota, telepon, tanggal_disisipkan, jenis_pengguna, status_akses) 
        VALUES('','$kode','$nama','" . md5($kata_kunci) . "','$alamat','$kodepos','$email','$kota','$telepon',now(),'$jenis_pengguna','$status_pengguna')") or die (mysql_error());
        if(mysql_query($sql))
            {
                
                /**
                 * jika sukses masuk ke dalam database, maka session pengguna dilepaskan.
                 */
                unset($_SESSION["pengguna"]);
                $_SESSION["berhasil"] = "ditambahkan.";
                
            }
            else
            {
                
                /**
                 * jika gagal masuk ke dalam database, maka 
                 * mengaktifkan pesan peringatan dan proses penambahan pengguna batal.
                 */
                $kesalahan = true;
                $pesan_kesalahan[] = "terjadi kesalahan pada database.";
                
            }
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>manage pengguna</title>
<link rel="stylesheet" href="../style.css" type="text/css" media="screen" />
</head>
<body>
<div align="center" id="ContentmainWrapper">
  <div id="pageContent"><br />
<div align="left" style="margin-left:24px;">
    </div>
    <a name="inventoryForm" id="inventoryForm"></a>

    <form action=""  method="post" onSubmit="return validasiForm();" name="reg">
        <h3>Formulir Pendaftaran</h3>
        <table border="0">
            <tr>                
                <td align="right">Username : </td>
                <td>
                    <!--<input name="kode" type="text" size="31"/>-->
                    <input type="text" name="uname" id="uname" onBlur="checkusername()" maxlength="15" />
					<span id="usernamestatus"></span>
                </td>
            </tr>
            <tr>
                <td align="right">Kata Kunci : </td>
                <td>
                    <input name="kata_kunci" type="password" size="31"/>
                </td>
            </tr>
            <tr>
                <td align="right">Ulangi Kata Kunci : </td>
                <td>
                    <input name="ulangi_kata_kunci" type="password" size="31"/>
                </td>
            </tr>
            <tr>
                <td align="right">Email : </td>
                <td>
                    <input name="email" type="text"size="63"/>
                </td>
            </tr>
            <tr>
                <td align="right">Nama : </td>
                <td>
                    <input name="nama" type="text" size="63"/>
                </td>
            </tr>
            <tr>
                <td align="right">Alamat Lengkap : </td>
                <td>
                    <input type="text" name="alamat" size="63"/>
                </td>
            </tr>
            <tr>
                <td align="right">Kota : </td>
                <td>
                    <select name="kota">
                        <?php
                        $sql = "
                            SELECT
                                *
                            FROM
                                kota";
                        $sumber_data = mysql_query($sql);
                        
                        while($baris = mysql_fetch_assoc($sumber_data))
                        {
                            ?>
                            <option value="<?php echo($baris["no"]);?>"><?php echo($baris["nama"]);?></option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">Kode Pos : </td>
                <td>
                    <input type="text" name="kodepos" size="63"/>
                </td>
            </tr>
            <tr>
                <td align="right">Telepon : </td>
                <td>
                    <input name="telepon" type="text"size="15"/>
                </td>
            </tr>
            <tr>
            <td align="right">Jenis Pengguna : </td>
            <td><select name="jenis_pengguna">
            	<option value="2" selected="selected">Pengguna Biasa</option>
                <option value="1">Administrator</option>
                </select></td>
            </tr>
            <tr>
            <td align="right">Status Pengguna : </td>
            <td><select name="status_pengguna">
                <option value="DIPERBOLEHKAN" selected="selected">Diperbolehkan</option>
                <option value="DITOLAK">Ditolak</option>
                </select></td>
            </tr>
            <tr> 
   				<br/>
                <td class="tekshead">
                    <font color="#a6958b" style="font-weight:bold">
                        Verification Code
                    </font>       
               	</td>
                <td>
                    <img src="v.php"/>
				</td>
            </tr>
            <tr>
                <td>
                </td>
               <td>
                <input id="ccek" name="ccek" type="text"/><font color = "red">*</font>
               </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="hidden" value="<?php echo $_SESSION["ccek"]; ?>" size="4" id="koncaptcha" name="koncaptcha" maxlength="4" />
                    <font size="2" face="Arial, Helvetica, sans-serif" color = "red">
                    jumlahkan angka di atas untuk verifikasi.
                    </font>
                </td>
            </tr> 
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" value="Daftar"/>
                </td>
            </tr>
        </table>
    </form>
    <br />
  <br />
  </div>
</div>
</body>
</html>
