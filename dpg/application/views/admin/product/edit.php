<div class="box box-primary">
    <form  id="productFormEdit" role="form" onsubmit="simpan_product();
            return false;">
        <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
        <form role="form">
            <div class="box-body">
                <div class="form-group">
                    <label>Nama Product</label>
                    <input type="text" class="form-control" placeholder="Masukkan nama product" name="nama_product" value="<?php echo $row['nama_product']; ?>" id="nama_productedit">
                    <span id="message_nama_productedit" class="text-red"></span>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input type="text" class="form-control" placeholder="Masukkan harga" name="harga" value="<?php echo $row['harga']; ?>" id="hargaedit">
                    <span id="message_hargaedit" class="text-red"></span>
                </div>
                <div class="form-group">
                    <input type="hidden" class="form-control" name="setnilai" value="<?php echo $row['kategori_id']; ?>" id="setnilai">
                    <label>Kategori</label>
                    <select name="kategori" class="form-control" id="kategoriedit">
                        <?php
                        if (count($kategori) > 0) {
                            ?>
                            <option option value=''>--pilih nama kategori--</option>
                            <?php
                            foreach ($kategori as $k) {
                                echo "<option value='$k->kategori_id'>$k->nama_kategori</option>";
                            }
                        } else {
                            echo "<option>--Data Belum Tersedia--</option>";
                        }
                        ?>
                    </select>
                    <span id="message_kategoriedit" class="text-red"></span>
                </div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                <?php
                echo anchor('admin/product', 'Kembali', array('class' => 'btn btn-primary'));
                ?>
            </div>
        </form>
</div><!-- /.box -->

<script type="text/javascript">
        var setnilai = $("#setnilai").val();
        $("#kategoriedit").val(setnilai);

        function simpan_product() {
            var nama_product = $("#nama_productedit").val();
            var harga = $("#hargaedit").val();
            var kategori = $("#kategoriedit").val();
            var actSimpan = $(".act-simpan");
            actSimpan.button('loading');
            $.ajax({
                url: "<?php echo site_url(); ?>admin/product/insert",
                type: "post",
                data: "nama_product=" + nama_product + "&harga=" + harga + "&kategori=" + kategori,
                dataType: "json",
                success: function(data) {
                    if (data.correct == "salah") {
                        $("#message_nama_productedit").html(data.message_nama_product);
                        $("#message_hargaedit").html(data.message_harga);
                        $("#message_kategoriedit").html(data.message_kategori);
                    } else {
                        alert(data.message1);
                        $("#message_nama_productedit").html("");
                        $("#message_hargaedit").html("");
                        $("#message_kategoriedit").html("");
                        $("#productFormEdit")[0].reset();
                    }
                    actSimpan.button('reset');
                }
            }
            );
        }

</script>