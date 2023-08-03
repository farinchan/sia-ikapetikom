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
<script src="https://unpkg.com/@develoka/angka-rupiah-js/index.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>
<script src="<?php echo base_url('assets/js/number_format.js') ?>"></script>

<script>
$(document).ready(function(){

    $("#textarea_diskusi").each(function () {
        this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
        }).on("input", function () {
        this.style.height = "auto";
        this.style.height = (this.scrollHeight) + "px";
    });

    $('#pagination').on('click','a',function(e){
        e.preventDefault(); 
        var pageno = $(this).attr('data-ci-pagination-page');
        loadPagination(pageno);
    });

    loadPagination(0);

    function loadPagination(pagno){
        $.ajax({
            url: 'listdonasi/'+pagno,
            type: 'GET',
            dataType: 'json',
            success: function(response){
            $('#pagination').html(response.pagination);
            createList(response.result,response.row);
            }
        });
    }

    function createList(result,sno){
        sno = Number(sno);
        $('#datadonasi').empty();
        for(index in result){
            var judul_donasi = result[index].judul_donasi;
            var tanggal_donasidibuat = result[index].tanggal_donasidibuat;
            var total_dilihat = result[index].total_dilihat;
            var donasi_dibuka = result[index].donasi_dibuka;
            var donasi_ditutup = result[index].donasi_ditutup;
            var target_dana = result[index].target_dana;
            var id_donasi = result[index].id_donasi;
            var gambar_donasi = result[index].gambar_donasi;
            var donasi_terkumpul = result[index].donasi_terkumpul;

            if(donasi_terkumpul == null){
                donasi_terkumpul = 0;
            }

            var progress = (donasi_terkumpul / target_dana) * 100;

            var x;
            var html = '';
            const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            const Datetime = new Date(tanggal_donasidibuat);

            html += '<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">';
            html += '<div class="member"><div class="member-img">';
            html += '<img src="<?php echo base_url('assets/donasi/img/'); ?>'+gambar_donasi+'" class="img-fluid" alt="">';
            html += '<div class="social">';
            html += '</div></div>';
            html += '<div class="member-info">';
            html += '<h4>'+judul_donasi+'</h4>'
            html += '<span id="card-donasi"><i class="far fa-calendar-alt"></i> '+Datetime.getDate()+' '+monthNames[Datetime.getMonth()]+' '+Datetime.getFullYear()+' &bull; <i class="fas fa-bolt"></i> dilihat '+total_dilihat+'</span>';
            html += '<div class="progress mt-4" style="height: 8px;"><div class="progress-bar" role="progressbar" style="width: '+progress+'%;" aria-valuenow="'+progress+'" aria-valuemin="0" aria-valuemax="100"></div></div>';
            html += '<div class="row">';
            html += '<div class="col">';
            html += '<small class="text-muted">Terkumpul</small><br>';
            html += '<small style="color: blue;">'+toRupiah(donasi_terkumpul)+'</small>';
            html += '</div>';
            html += '<div class="col">';
            html += '<small class="text-muted" style="float: right;">Durasi</small><br>';
            if(DateDiff(donasi_ditutup) >= 0){
                html += '<small class="text-black" style="float: right;">'+DateDiff(donasi_ditutup)+' Hari lagi</small>';
            }else{
                html += '<small class="text-black" style="float: right;">Ditutup</small>';
            }
            html += '</div>';
            html += '</div>';
            html += '</div>';
            html += '<div class="card-footer auto"><div class="d-grid gap-2"><a href="<?php echo base_url('main/detaildonasi/') ?>'+id_donasi+'" type="button" class="btn btn-primary">Donasi Sekarang</a></div></div>';
            html += '</div></div>';

            $('#datadonasi').append(html);

        }
    }


    function DateDiff(date){
        var now = moment(new Date()); //todays date
        var end = moment(date); // another date
        return [
            end.diff(now, 'days'),
        ];
    }


    $('#spinner').hide();

    $('#bayar_donasi').submit(function(e){

        e.preventDefault();
        $.ajax({
            url : '<?php echo base_url('main/bayardonasi_action'); ?>',
            type : 'POST',
            data : new FormData(this),
            dataType : 'JSON',
            contentType : false,
            cache : false,
            processData : false,
            beforeSend : function(){
                $('#spinner').show();
                $('#tombol_submit').hide();
            },
            complete : function(){
                $('#spinner').hide();
                $('#tombol_submit').show();
            },
            success : function(data){
                $('#bayar_donasi').trigger("reset");
                swal(data);
                
            }, 
            error : function(data){
                console.log(data);
            }
        });

    });

});
</script>
</body>

</html>