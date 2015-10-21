<body onload="loadForm();"></body>

<div class="box box-primary">
    <div class="box-body">
        <div class="col-xs-7">
            <form role="form" id="productForm">
                <input type="hidden" name="product_id" id="product_id" value="<?php echo $row['product_id']; ?>">
                <div class="box-body">
                    <div class="form-group">
                        <label>Nama Product</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama product" name="nama_product" value="<?php echo $row['nama_product']; ?>" id="nama_product">
                        <span id="message_nama_product" class="text-red"></span>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" class="form-control" placeholder="Masukkan harga" name="harga" value="<?php echo $row['harga']; ?>" id="harga">
                        <span id="message_harga" class="text-red"></span>
                    </div>
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="setnilai" value="<?php echo $row['kategori_id']; ?>" id="setnilai">
                        <label>Kategori</label>
                        <select name="kategori" class="form-control" id="kategori">
                            <?php
                            if (count($kategori) > 0) {
                                ?>
                                <option option value=''>--pilih kategori--</option>
                                <?php
                                foreach ($kategori as $k) {
                                    echo "<option value='$k->kategori_id'>$k->nama_kategori</option>";
                                }
                            } else {
                                echo "<option>--Data Belum Tersedia--</option>";
                            }
                            ?>
                        </select>
                        <span id="message_kategori" class="text-red"></span>
                    </div>
                    <!--                <div class="form-group">
                                        <label>Silahkan Pilih File Gambar</label>
                                        <input type="file" id="gambar" name="gambar" onchange="pressed();"><span id="fileLabel"><?php echo $row['picture']; ?></span>
                                        <span id="message_gambar" class="text-red"></span>
                                    </div>-->
                </div><!-- /.box-body -->
                <div class="no-print">
                    &nbsp;&nbsp;&nbsp;<button  id="button_submit" type="submit" class="btn btn-primary act-simpan">Simpan</button>
                    <?php
                    echo anchor('admin/product', 'Kembali', array('class' => 'btn btn-primary'));
                    ?>
                </div>
            </form>
        </div>

        <div class="col-xs-5">
            <form role="form" method="post" enctype="multipart/form-data" id="productFormUpload">
                <div class="box-body"><br>
                    <input type="hidden" name="idUpload" id="idUpload" value="<?php echo $row['product_id']; ?>">
                    <input type="hidden" name="gambarUpload" id="gambarUpload" value="<?php echo $row['picture']; ?>">
                    <div align="center" class="imagePriview" id="refresh">
                    </div>
                    <br>   
                    <input type="file" class="btn btn-default form-control" id="gambar" name="gambar">
                    <span id="message_gambar" class="text-red"></span>
                    <br>
                    <div class="progress">
                        <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            <span class="sr-only">0% Complete (success)</span>
                        </div>
                    </div>                   
                    <input type="submit" name="submit" class="btn btn-success" value="Upload">
                </div>
            </form>       
        </div>
    </div>
</div><!-- /.box -->


<script src="<?php echo base_url() ?>assets/js/jquery.form.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function loadForm() {
        var gambarUpload = $("#gambarUpload").val();
        $.ajax({
            type: 'post',
            url: "<?php echo site_url(); ?>admin/product/refresh",
            data: "gambarUpload=" + gambarUpload,
            success: function(html) {
                $("#refresh").html(html);
            }            
        });
        return false;
    }
    ///////////////setdefault combobox////////////////////////
    var setnilai = $("#setnilai").val();
    $("#kategori").val(setnilai);
    ////////////////hide progressbar///////////////////////
    $(".progress").hide();
    ///////////////////////////////////////////////////
    jQuery(document).ready(function() {
        jQuery("#productFormUpload").submit(function(e) {
            e.preventDefault();
            var data = new FormData();
            data.append("product_id", jQuery("#idUpload").val());
            data.append("gambar", jQuery("#gambar").get(0).files[0]);
            jQuery.ajax({
                url: "<?php echo site_url(); ?>admin/product/upload",
                type: 'post',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $(".progress").show();
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    $(".progress-bar progress-bar-primary progress-bar-striped").width(percentComplete + '%');
                    $(".sr-only").html(percentComplete + '%')
                },
                error: function(_, textStatus, errorThrown) {
                    alert("Error Uploading");
                    console.log(textStatus, errorThrown);
                },
                success: function() {
                    alert('Upload success');
                    $("#message_gambar").html("")
                    $("#productFormUpload")[0].reset();
                    $(".progress").hide();
                },
                complete: function(response) {
                    loadForm();
                }
            });


        });
    });

//    jQuery(document).ready(function() {
//        jQuery("#productForm").submit(function() {
//            var pict = jQuery("#gambar").get(0).files[0]);
//            var actSimpan = $(".act-simpan");
//            actSimpan.button('loading');
//            jQuery.ajax({
//                url: "<?php echo site_url(); ?>admin/product/update",
//                type: "post",
//                dataType: "json",
//                contentType: false,
//                processData: false,
//                data: function() {
//                    var data = new FormData();
//                    data.append("nama_product", jQuery("#nama_product").val());
//                    data.append("harga", jQuery("#harga").val());
//                    data.append("kategori", jQuery("#kategori").val());
//                    data.append("gambar", jQuery("#gambar").get(0).files[0]);
//                    return data;
//                    //return new FormData(jQuery("form")[0]);
//                }(),
//                error: function(_, textStatus, errorThrown) {
//                    alert("Error Uploading");
//                    console.log(textStatus, errorThrown);
//                },
//                success: function(data) {
//                    if (data.correct == "salah") {
//                        $("#message_nama_product").html(data.message_nama_product);
//                        $("#message_harga").html(data.message_harga);
//                        $("#message_kategori").html(data.message_kategori);
//                        $("#message_gambar").html(data.message_gambar);
//                    } else {
//                        alert(data.message1);
//                        $("#message_nama_product").html("");
//                        $("#message_harga").html("");
//                        $("#message_kategori").html("");
//                        $("#message_gambar").html("")
//                        $("#productForm")[0].reset();
//                    }
//                    actSimpan.button('reset');
//                }
//            });
//            return false;
//        });
//    });


</script>
