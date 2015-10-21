<div class="box box-primary">
    <!-- form start -->
    <form role="form" id="productForm">
        <div class="box-body">
            <div class="form-group">
                <label>Nama Product</label>
                <input type="text" class="form-control" placeholder="Masukkan nama product" name="nama_product" id="nama_product">
                <span id="message_nama_product" class="text-red"></span>
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="text" class="form-control" placeholder="Masukkan nilai harga" name="harga" id="harga">
                <span id="message_harga" class="text-red"></span>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select name="kategori" class="form-control" id="kategori">
                    <?php
                    if (count($kategori) > 0) {
                        ?>
                        <option value = "">--pilih kategori--</option>
                        <?php
                        foreach ($kategori as $k) {
                            echo "<option value = '$k->kategori_id'>$k->nama_kategori</option>";
                        }
                    } else {
                        echo "<option>--Data Belum Tersedia--</option>";
                    }
                    ?>
                </select>
                <span id="message_kategori" class="text-red"></span>
            </div>
            <div class="form-group">
                <label>Silahkan Pilih File Gambar</label>
                <input type="file" id="gambar" name="gambar"/>
                <span id="message_gambar" class="text-red"></span>
            </div>
        </div><!-- /.box-body -->

        <div class="box-footer">
            <button  id="button_submit" type="submit" class="btn btn-primary act-simpan">Simpan</button>
            <?php
            echo anchor('admin/product', 'Kembali', array('class' => 'btn btn-primary'));
            ?>
        </div>
    </form>
</div><!-- /.box -->

<!--<script src="<?php echo base_url() ?>assets/uploadify/jquery.uploadify.min.js" type="text/javascript"></script>-->
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#productForm").submit(function() {
            var pict = $("#gambar").val();
            var actSimpan = $(".act-simpan");
            actSimpan.button('loading');
            jQuery.ajax({
                url: "<?php echo site_url(); ?>admin/product/insert",
                type: "post",
                dataType: "json",
                contentType: false,
                processData: false,
                data: function() {
                    var data = new FormData();
                    data.append("nama_product", jQuery("#nama_product").val());
                    data.append("harga", jQuery("#harga").val());
                    data.append("kategori", jQuery("#kategori").val());
                    data.append("gambar", jQuery("#gambar").get(0).files[0]);
                    return data;
                    //return new FormData(jQuery("form")[0]);
                }(),
                error: function(_, textStatus, errorThrown) {
                    alert("Error Uploading");
                    console.log(textStatus, errorThrown);
                },
                success: function(data) {
                    if (data.correct == "salah") {
                        $("#message_nama_product").html(data.message_nama_product);
                        $("#message_harga").html(data.message_harga);
                        $("#message_kategori").html(data.message_kategori);
                        if (pict == "") {
                            $("#message_gambar").html("You did not select a file to upload.");
                        } else {
                            $("#message_gambar").html(data.message_gambar);
                        }
                    } else {
                        alert(data.message1);
                        $("#message_nama_product").html("");
                        $("#message_harga").html("");
                        $("#message_kategori").html("");
                        $("#message_gambar").html("")
                        $("#productForm")[0].reset();
                    }
                    actSimpan.button('reset');
                }
            });
            return false;
        });
    });
</script>
