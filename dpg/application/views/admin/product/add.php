<div class="box box-primary">
    <!-- form start -->
    <form  id="productForm" role="form" onsubmit="simpan_product();
            return false;" method="post" enctype="multipart/form-data">
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
                <input type="file" name="userfile" id="userfile">
                <span id="message_userfile" class="text-red"></span>
            </div>
        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary act-simpan">Simpan</button>
            <?php
            echo anchor('admin/product', 'Kembali', array('class' => 'btn btn-primary'));
            ?>
        </div>
    </form>
</div><!-- /.box -->

<script src="<?php echo base_url() ?>assets/js/jquery.form.js" type="text/javascript"></script>
<script type="text/javascript">
//        function simpanfoto() {
//
//
//            $('#uploadfotopasien').ajaxForm({
//                success: function(resp) {
//                    // Setelah eksekusi sukses maka diberikan hasil dari eksekusi dan detail pesannya
//                    $('.hasil').html(resp);
//                },
//            });
//        }
//        ;
///////////////////////////////////////////////////////////////////////////////////////////////
        function simpan_product() {
            var nama_product = $("#nama_product").val();
            var harga = $("#harga").val();
            var kategori = $("#kategori").val();
            var userfile = $('#userfile').val(); // Nama control file yang nantinya akan mengupload file
            var actSimpan = $(".act-simpan");
            actSimpan.button('loading');
            $.ajax({
                url: "<?php echo site_url(); ?>admin/product/insert",
                type: "post",
                data: "&nama_product=" + nama_product + "&harga=" + harga + "&kategori=" + kategori + "&userfile=" + userfile,
                dataType: "json",
                beforeSend: function() {
                    // Dieksekusi sebelum upload dilakukan, mengeset label msg
                    var percentVal = 'Mengupload 0%';
                    $('#message_userfile').html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    // Dieksekusi pada saat upload dilakukan, menampilkan persentase progress upload ke label msg
                    var percentVal = 'Mengupload ' + percentComplete + '%';
                    $('#message_userfile').html(percentVal);
                },
                beforeSubmit: function() {
                    // Sebelum form di submit
                    $('#message_userfile').html('Silahkan Tunggu ... ');
                },
                success: function(data) {
                    if (data.correct == "salah") {
                        $("#message_nama_product").html(data.message_nama_product);
                        $("#message_harga").html(data.message_harga);
                        $("#message_kategori").html(data.message_kategori);
                        $("#message_userfile").html(data.message_userfile);
                    } else {
                        alert(data.message1);
                        $("#message_nama_product").html("");
                        $("#message_harga").html("");
                        $("#message_kategori").html("");
                        $("#message_userfile").html("")
                        $("#productForm")[0].reset();
                    }
                    actSimpan.button('reset');
                }
            }
//            ).fail(function(data) {
//                console.log(data)
//                actSimpan.button('reset');
//            }
            );
        }

</script>