<div class="box box-primary">
    <!-- form start -->
    <form  id="kategoriForm" role="form" onsubmit="simpan_kategori();
            return false;">
        <div class="box-body">
            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" class="form-control" placeholder="Masukkan nama kategori" name="nama_kategori" id="nama_kategori">
                <span id="message_nama_kategori" class="text-red"></span>
            </div>
            <div class="form-group">
                <label>Link</label>
                <input type="text" class="form-control" placeholder="Masukkan link" name="link" id="link">
                <span id="message_link" class="text-red"></span>
            </div>
            <div class="form-group">
                <label>Kategori Menu Parent</label>
                <select name="parent" class="form-control" id="parent">
                    <?php
                    if (count($parent) > 0) {
                        ?>
                        <option value = "">--pilih parent--</option>
                        <option value ="0">Menu Parent</option>
                        <?php
                        foreach ($parent as $p) {
                            echo "<option value = '$p->kategori_id'>$p->nama_kategori</option>";
                        }
                    } else {
                        echo "<option>--Data Belum Tersedia--</option>";
                    }
                    ?>
                </select>
                <span id="message_parent" class="text-red"></span>
            </div>
        </div><!-- /.box-body -->

        <div class="box-footer">
            <button type="submit" class="btn btn-primary act-simpan">Simpan</button>
            <?php
            echo anchor('admin/kategori', 'Kembali', array('class' => 'btn btn-primary'));
            ?>
        </div>
    </form>
</div><!-- /.box -->


<script type="text/javascript">
        function simpan_kategori() {
            var nama_kategori = $("#nama_kategori").val();
            var link = $("#link").val();
            var parent = $("#parent").val();
            var actSimpan = $(".act-simpan");
            actSimpan.button('loading');
            $.ajax({
                url: "<?php echo site_url(); ?>admin/kategori/insert",
                type: "post",
                data: "nama_kategori=" + nama_kategori + "&link=" + link + "&parent=" + parent,
                dataType: "json",
                success: function(data) {
                    if (data.correct == "salah") {
                        $("#message_nama_kategori").html(data.message_nama_kategori);
                        $("#message_link").html(data.message_link);
                        $("#message_parent").html(data.message_parent);
                    } else {
                        alert(data.message1);
                        $("#message_nama_kategori").html("");
                        $("#message_link").html("");
                        $("#message_parent").html("");
                        $("#kategoriForm")[0].reset();
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
