<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('user/partisi/head.php'); ?>
<?php $this->load->view('user/partisi/datatables_css'); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dropzone.css">
<body>

<?php $this->load->view('user/partisi/navbar.php') ?>

<main id="main">
<?php echo $content; ?>
</main>
<input type="hidden" id="id_donasi" value="<?php echo $this->uri->segment(3); ?>">
<?php $this->load->view('user/partisi/footer.php') ?>
<?php $this->load->view('user/partisi/js.php') ?>
<script src="https://unpkg.com/@develoka/angka-rupiah-js/index.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>
<?php $this->load->view('user/partisi/datatables_js'); ?>
<script>
    $('#DonaturList').DataTable();
    $('#pagination_doa').on('click','a',function(e){
        e.preventDefault(); 
        var pageno = $(this).attr('data-ci-pagination-page');
        loadPageDoa(pageno);
    });

    loadPageDoa(0);

    function loadPageDoa(pagno){
        var id_donasi = $('#id_donasi').val();
        $.ajax({
            url: '<?php echo base_url('main/')?>doadonatur/'+pagno,
            type: 'GET',
            dataType : 'Json',
            data : {'id':id_donasi},
            success: function(response){
            $('#pagination_doa').html(response.pagination);
            createListDoa(response.result,response.row);
                console.log(response.result);
            }
        });
    }

    function createListDoa(result,sno){
        sno = Number(sno);
        $('#data_doa').empty();

        for(index in result){
            var tanggal_bayar = result[index].tanggal_bayar;
            var nama_alumni = result[index].nama_alumni;
            var total_donasi = result[index].total_donasi;
            var tahun_lulus = result[index].tahun_lulus;
            var id_donasi = result[index].id_donasi;
            var doadonatur = result[index].doa_donatur;

            const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            const Datetime = new Date(tanggal_bayar);
            var html = '';
            html += '<li class="list-group-item d-flex justify-content-between align-items-center"><small class="text-muted" style="font-size: 12px;">';
            html += +Datetime.getDate()+' '+monthNames[Datetime.getMonth()]+' '+Datetime.getFullYear()+'<br>';
            html += '<small style="font-size: 15px; color: black;">'+nama_alumni+' (Angkatan '+tahun_lulus+')<br>';
            html += '<small>'+doadonatur+'</small>';
            html += '</small></small><span class="badge bg-primary rounded-pill">'+toRupiah(total_donasi)+'</span></li>';


            $('#data_doa').append(html);

        }

    }

</script>
</body>

</html>