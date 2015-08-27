<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Quick Example</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
    <?php
    echo form_open('admin/kategori/edit');
    ?>
    <input type="hidden" name="kategori_id" value="<?php echo $row['kategori_id']; ?>">
    <form role="form">
        <div class="box-body">
            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" class="form-control" placeholder="Masukkan nama kategori" name="nama_kategori" value="<?php echo $row['nama_kategori']; ?>">
            </div>
            <div class="form-group">
                <label>Link</label>
                <input type="text" class="form-control" placeholder="Masukkan link" name="link" value="<?php echo $row['link']; ?>">
            </div>
            <div class="form-group">
                <label>Parent</label>
                <select name="parent" class="form-control">
                    <option value ="">-- pilih parent --</option>
                    <option value ="0">Menu Parent</option>
                    <?php
                    foreach ($parent as $p) {
                        echo "<option value='$p->kategori_id'";
                        echo $row['parent'] == $p->kategori_id ? 'selected' : '';
                        echo ">$p->nama_kategori</option>";
                    }
                    ?>
                </select>
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