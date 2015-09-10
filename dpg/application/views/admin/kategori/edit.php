<div class="box box-primary">
    <form  id="kategoriFormEdit" role="form" onsubmit="simpan_kategori();
            return false;">
        <input type="hidden" name="kategori_id" value="<?php echo $row['kategori_id']; ?>">
        <form role="form">
            <div class="box-body">
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" class="form-control" placeholder="Masukkan nama kategori" name="nama_kategori" value="<?php echo $row['nama_kategori']; ?>" id="nama_kategoriedit">
                    <span id="message_nama_kategoriedit" class="text-red"></span>
                </div>
                <div class="form-group">
                    <label>Link</label>
                    <input type="text" class="form-control" placeholder="Masukkan link" name="link" value="<?php echo $row['link']; ?>" id="linkedit">
                    <span id="message_linkedit" class="text-red"></span>
                </div>
                <div class="form-group">
                    <label>Parent</label>
                    <select name="parent" class="form-control" id="parentedit">
                        <?php
                        if (count($parent) > 0) {
                            ?>
                            <option value="<?php echo '$row->parent'; ?>" selected><?php if ($row->parent == '1') {
                            echo $row->nama_kategori . '(Menu Parent)';
                        } else {
                            echo $row->nama_kategori . '(Sub Menu)';
                        } ?></option>
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
                    <span id="message_parentedit" class="text-red"></span>
                </div>
            </div><!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
<?php
echo anchor('admin/kategori', 'Kembali', array('class' => 'btn btn-primary'));
?>
            </div>
        </form>
</div><!-- /.box -->

<script type="text/javascript">
        function simpan_kategori() {
            var nama_kategori = $("#nama_kategoriedit").val();
            var link = $("#linkedit").val();
            var parent = $("#parentedit").val();
            var actSimpan = $(".act-simpan");
            actSimpan.button('loading');
            $.ajax({
                url: "<?php echo site_url(); ?>admin/kategori/insert",
                type: "post",
                data: "nama_kategori=" + nama_kategori + "&link=" + link + "&parent=" + parent,
                dataType: "json",
                success: function(data) {
                    if (data.correct == "salah") {
                        $("#message_nama_kategoriedit").html(data.message_nama_kategori);
                        $("#message_linkedit").html(data.message_link);
                        $("#message_parentedit").html(data.message_parent);
                    } else {
                        alert(data.message1);
                        $("#message_nama_kategoriedit").html("");
                        $("#message_linkedit").html("");
                        $("#message_parentedit").html("");
                        $("#kategoriFormEdit")[0].reset();
                    }
                    actSimpan.button('reset');
                }
            }
            );
        }

</script>
