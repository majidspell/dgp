<link href="<?php echo base_url() ?>template/adminlte/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<div class="box" id="kategoriresult">
    <div class="box-header">
        <div><?php
            echo anchor('admin/kategori/add', 'Input Kategori', array('class' => 'btn btn-primary btn-sm'));
            ?></div>
    </div><!-- /.box-header -->
    <!--&nbsp;&nbsp;&nbsp;-->

    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Jenis Menu</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($record as $r) {
                    echo" <tr class='datakat$r->kategori_id'>
                                <td width='10'>$no</td>
                                <td>$r->nama_kategori</td>
                                <td>";
                    if ($r->parent == 0) {
                        echo "Menu Parent";
                    } else {
                        $jenisparent = $this->db->get_where('kategori', array('kategori_id' => $r->kategori_id))->row_array();
                        echo $jenisparent['nama_kategori'].' (Sub Menu)';
                    }
                    echo"</td>
                                <td width='10'>" . anchor("admin/kategori/edit/" . $r->kategori_id, "<i class='fa fa-trash'>", array('title' => 'edit data')) . "</td>
                                <td width='10'><p class='fa fa-trash' title='hapus data' onclick='deletekat($r->kategori_id)'><p> </td>
                          </tr>       
                            ";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div><!-- /.box-body -->
</div><!-- /.box -->
<script src="<?php echo base_url() ?>template/adminlte/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>template/adminlte/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() ?>template/adminlte/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>template/adminlte/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>template/adminlte/dist/js/app.min.js" type="text/javascript"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url() ?>template/adminlte/dist/js/demo.js" type="text/javascript"></script>
<!-- page script -->
<script type="text/javascript">
    $(function() {
        $("#example1").dataTable();
        $('#example2').dataTable({
            "bPaginate": true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": false
        });
    });

    function deletekat(id) {
        $.ajax({
            type: "GET",
            url: "kategori/delete",
            data: "kategori_id=" + id,
            success: function(html) {
                $(".datakat" + id).hide(500);
            }
        });
        return false;
    }

//    function deletekat(id) {
//        $.ajax({
//            type: "GET",
//            url: "kategori/delete",
//            data: "kategori_id=" + id,
//            success: function(data) {
//                alert("data berhasil dihapus");
//                $("#kategoriresult").load("<?php echo site_url(); ?>admin/kategori/index #kategoriresult");
//            }
//        });
//        return false;
//    }


</script>
