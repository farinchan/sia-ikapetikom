<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin/partisi/head.php'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dropzone.css">
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php $this->load->view('admin/partisi/navbar.php'); ?>
<?php $this->load->view('admin/partisi/sidebar.php'); ?>

<?php echo $content; ?>
<input type="hidden" id="id_topik" value="<?php echo $this->uri->segment(4); ?>">
<?php $this->load->view('admin/partisi/footer.php') ?>
</div>
<?php $this->load->view('admin/partisi/js.php') ?>
<script src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>
<script>
$(document).ready(function(){
    $('#spinner').hide();

    $('#list_topik').DataTable({
        "processing" : true,
        "serverSide" : true,
        "responsive" : true,
        "order" : [],
        "ajax" : {
            'url' : '<?php echo base_url('admin/ModulForum/listtopik') ?>',
            'type' : 'POST'
        },
        "columnDefs":[
            {
                'target':[0],
                'orderable':false
            }
        ]
    });

    $('#tambah_kategoritopik').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('admin/ModulForum/tambahkategori_action') ?>',
            type : 'POST',
            data : $(this).serialize(),
            beforeSend : function(){
                $('#spinner').show();
            },
            complete : function(){
                $('#spinner').hide();
            },
            success : function(data){
                swal(data);
                $('#tambah_kategoritopik').trigger("reset");
            },
            error : function(data){
                console.log(data);
            }
        });
    });

    $('#edit_kategoritopik').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('admin/ModulForum/editkategori_action') ?>',
            type : 'POST',
            data : $(this).serialize(),
            beforeSend : function(){
                $('#spinner').show();
            },
            complete : function(){
                $('#spinner').hide();
            },
            success : function(data){
                swal(data)
                .then((value) => {
                    location.reload();
                });
            },
            error : function(data){
                console.log(data);
            }
        });
    });

    $('#pagination').on('click','a',function(e){
       e.preventDefault(); 
       var pageno = $(this).attr('data-ci-pagination-page');
       loadPagination(pageno);
     });
 
    loadPagination(0);

    function loadPagination(pagno){ 
        $.ajax({
            url: '<?php echo base_url('admin/ModulForum/getDetaildiskusi/'); ?>'+pagno+'',
            type: 'GET',
            data : {'id_topik': $('#id_topik').val()},
            dataType: 'json',
            success: function(response){
            $('#pagination').html(response.pagination);
                createTable(response.result,response.row);
            }
        });
    }

    function createTable(result,sno){
        sno = Number(sno);
        $('#isi_diskusi').empty();
        var html = '';

        html += '<div class="time-label">';
        html += '<span class="bg-info">';
        html += 'Ada '+$('#tot_diskusi').val()+' Komentar';
        html += '</span></div>';

        for(index in result){
            var nama_alumni = result[index].nama_alumni;
            var tanggal = result[index].tanggal;
            var foto_alumni = result[index].foto_alumni;
            var isi_diskusi = result[index].isi_diskusi;
            var lampiran_file = result[index].lampiran_file;
            var id_topik = result[index].id_topik;
            var tanggal = result[index].tanggal;
            var nisn = result[index].nisn;
            var id_diskusi = result[index].id_diskusi;

            html += '<div>';
            if(lampiran_file == "kosong"){
                html += '<i class="fas fa-envelope bg-primary"></i>';
            }else{
                html += '<i class="fas fa-file-alt bg-primary"></i>';
            }
            html += '<div class="timeline-item"><span class="time"> <a onclick="return confirm('+"'Yakin Mau Menghapus Percakapan Ini ?'"+')" href="<?php echo base_url('admin/ModulForum/hapusdiskusi/') ?>'+id_diskusi+'/'+id_topik+'"><i class="fas fa-trash fa-lg"></i></a></span>';
            html += '<h3 class="timeline-header"><a href="<?php echo base_url('admin/ModulAlumni/lihat/'); ?>'+nisn+'"><img src="<?php echo base_url('assets/user/img/'); ?>'+foto_alumni+'" alt="" class="rounded-circle" srcset="" width="30px"> '+nama_alumni+'</a> Commented On '+tanggal+'</h3>';
            html += '<div class="timeline-body">';
            html += isi_diskusi;
            html += '</div>';
            if(lampiran_file != "kosong"){
                html += '<div class="timeline-footer">';
                html += 'Lampiran file : <a href="<?php echo base_url('main/downloadfiletopik?data=');?>'+lampiran_file+'" style="color: blue;">'+lampiran_file+'</a>';
                html += '</div>';
            }
            html += '</div></div>';

        }

        $(html).appendTo('#isi_diskusi');
    }
});
</script>
</body>
</html>
