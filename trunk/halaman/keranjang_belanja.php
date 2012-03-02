<style>
div.halaman_keranjang_belanja table tr th,
div.halaman_keranjang_belanja table tr td
{
    padding: 2px 3px;
}
div.halaman_keranjang_belanja table tr th
{
    background-color: #CCC;
}
div.halaman_keranjang_belanja table tr:nth-child(odd)
{
    background-color: #EEE;
}
div.halaman_keranjang_belanja table tr:nth-child(even)
{
    background-color: #DDD;
}
</style>
<div class="halaman_keranjang_belanja">
    <h3>Keranjang Belanja</h3>
    <table width="100%">
        <tr>
            <th>No.</th>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Kuantitas</th>
            <th>Harga per Item</th>
            <th>Harga Total</th>
            <th>Hapus</th>
        </tr>
        <?php
        if(isset($_SESSION["keranjang_belanja"]))
        {
            @$nomer = $_GET["nomer"];
            @$kuantitas = $_GET["kuantitas"];
            if(count($_SESSION["keranjang_belanja"])>0)
            {
                $no_urut = 1;
                $total_keseluruhan = 0;
                foreach($_SESSION["keranjang_belanja"] as $no_produk=>$kuantitas_produk)
                {
                    $sql = "
                        SELECT
                            *
                        FROM
                            produk
                        WHERE
                            no = '".$no_produk."'";
                    $sumber_data_produk = mysql_query($sql);
                    $produk = mysql_fetch_assoc($sumber_data_produk);
                    
                    if($produk!=FALSE)
                    {
                        $total_keseluruhan = $total_keseluruhan + ($produk["harga"]*$kuantitas_produk);
                        ?>
                        <tr>
                            <td align="right"><?php echo($no_urut++);?></td>
                            <td align="left"><?php echo($produk["kode"]);?></td>
                            <td align="left"><?php echo($produk["nama"]); ?></td>
                            <td align="center">
                                <form method="post" action="<?php echo(buat_url("ubah_kuantitas_produk_di_keranjang_belanja")) ?>">
                                    <input type="hidden" name="no_produk" value="<?php echo($produk["no"]);?>"/>
                                    <input type="text" name="kuantitas" value="<?php echo($kuantitas_produk);?>" size="4" />
                                    <input type="submit" name="ubah_kuantitas_produk_di_keranjang_belanja" value="Ubah" />
                                </form>
                            </td>
                            <td align="right">Rp.<?php echo(number_format($produk["harga"], 2, ",", "."));?></td>
                            <td align="right">Rp.<?php echo(number_format(($produk["harga"]*$kuantitas_produk), 2, ",", "."));?></td>
                            <td align="center">
                                <input type="button" value="Hapus" onclick="location.href='<?php echo(buat_url("hapus_produk_di_keranjang_belanja", array("no_produk"=>$produk["no"])))?>';" />
                            </td>
                        </tr>
                        <?php
                    }
                }
            }
        }
        ?>
        <tr>
            <td colspan="4"></td>
            <td align="left" style="font-weight: bold;">Total Keseluruhan</td>
            <td align="right">Rp.<?php echo(number_format(@$total_keseluruhan, 2, ",", "."));?></td>
            <td></td>
        </tr>
    </table>
    <div>
        <strong>
            <center>
                <a href="<?php echo(buat_url("katalog"));?>">&lt;&lt; Kembali ke Katalog</a></a>
                <?php if(isset($_SESSION["keranjang_belanja"]) && count($_SESSION["keranjang_belanja"])>0):?>
                    | <a href="<?php echo(buat_url("login", array("redirect"=>"pengiriman")));?>">Selesaikan Belanja &gt;&gt;</a>
                <?php endif;?>
            </center>
        </strong>
    </div>
</div>