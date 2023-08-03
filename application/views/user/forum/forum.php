<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('user/partisi/head.php'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dropzone.css">

<body>

<?php $this->load->view('user/partisi/navbar.php') ?>

<main id="main">
<?php echo $content; ?>
</main>

<?php $this->load->view('user/partisi/footer.php') ?>
<?php $this->load->view('user/partisi/js.php') ?>
<script src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>
<?php $this->load->view('user/partisi/datatables_js'); ?>

<script>
$("#textarea_diskusi").each(function () {
    this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
}).on("input", function () {
    this.style.height = "auto";
    this.style.height = (this.scrollHeight) + "px";
});
$('#spinner').hide();
$('#list_topik').DataTable();
$(document).ready(function(){
    $('#form_tambahtopik').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('main/buattopik_action'); ?>',
            type : 'POST',
            data : new FormData(this),
            dataType : 'JSON',
            contentType : false,
            cache : false,
            processData : false,
            beforeSend : function(){
                $('#spinner').show();
            },
            complete : function(){
                $('#spinner').hide();
            },
            success : function(data){
                $('#form_tambahtopik').trigger("reset");
                swal(data);
            }, 
            error : function(data){
                console.log(data);
            }
        });
    });

    $('#form_edittopik').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('main/alumniedittopik_action') ?>',
            type : 'POST',
            data : new FormData(this),
            dataType : 'JSON',
            contentType : false,
            cache : false,
            processData : false,
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
            url: 'listtopik/'+pagno,
            type: 'GET',
            dataType: 'json',
            success: function(response){
            $('#pagination').html(response.pagination);
            createTable(response.result,response.row);
            }
        });
    }

    function createTable(result,sno){
        sno = Number(sno);
        $('#postsList tbody').empty();
        for(index in result){
            var nama_kategoritopik = result[index].nama_kategoritopik;
            var tahun_lulus = result[index].tahun_lulus;
            var judul_topik = result[index].judul_topik;
            var hak_akses = result[index].hak_akses;
            var nama_alumni = result[index].nama_alumni;
            var id_topik = result[index].id_topik;
            var tanggal = result[index].tanggal;
            var total_dilihat = result[index].total_dilihat;

            sno+=1;

            var tr = '<tr>';
            tr += '<th scope="row">'+ sno +'</th>';
            tr += '<td>[<span style="color: blue;"><b>'+nama_kategoritopik+'</b></span>] -  <b>';
            tr += '<a href="<?php echo base_url('main/bacatopik/') ?>'+id_topik+'" id="populer">'+judul_topik+' </a></b> <br>';
            tr += '<small style="font-size: 12px;">'+nama_alumni+' | Dibuat '+tanggal+' , Telah dilihat '+total_dilihat+' Kali</small></td>';
            if(hak_akses == "private"){

            tr += '<td style="font-size: 15px;"><i class="fas fa-user-shield"></i> PRIVATE</td>';

            }else{

            tr += '<td style="font-size: 15px;"><i class="fas fa-users"></i> PUBLIC</td>';

            }
            tr += '<td style="font-size: 15px;">'+tahun_lulus+'</td>'
            tr += '</tr>';
            $('#postsList tbody').append(tr);

        }
    }

    $('#form_diskusi').submit(function(e){
        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('main/tambahdiskusi') ?>',
            type : 'POST',
            data : new FormData(this),
            dataType : 'JSON',
            contentType : false,
            cache : false,
            processData : false,
            beforeSend : function(){
                $('#spinner').show();
            },
            complete : function(){
                $('#spinner').hide();
            },
            success : function(data){

                $('#total_komentar').text('');
                $('#form_diskusi').trigger("reset");
                $('#list_diskusi li').remove();

                var html = '';

                html += '<ul class="list-group list-group-flush" id="list_diskusi">'
                for (let i=0; i<data.diskusi.length; i++){

                    html += '<li class="list-group-item"><i class="fas fa-user"></i> '+data.diskusi[i].nama_alumni+' , <small class="text-muted">Commented On '+data.diskusi[i].tanggal+' </small></li>';
                    html += '<li class="list-group-item">';
                    html += '<div class="row">';
                    html += '<div class="col-2">';
                    html += '<img id="image-diskusi" src="<?php echo base_url('assets/user/img/') ?>'+data.diskusi[i].foto_alumni+'" alt="" class="img-fluid rounded-circle" width="80px">';
                    html += '</div>';
                    html += '<div class="col-9">';
                    html += '<p style="font-size: 14px;">'+data.diskusi[i].isi_diskusi+'</p>';
                    if(data.diskusi[i].lampiran_file != "kosong"){

                        html += '<small>Lampiran file : </small>';
                        html += '<small><a href="<?php echo base_url('main/downloadfiletopik ?data=') ?>'+data.diskusi[i].lampiran_file+'">'+data.diskusi[i].lampiran_file+'</a></small>';

                    }

                    html += '</div></div></li>';
                }

                html += '</ul>';

                $('#konten-diskusi').append(html);
                $('#total_komentar').text(data.totalkomentar);
            }
        });
    });

});
</script>
</body>

</html>