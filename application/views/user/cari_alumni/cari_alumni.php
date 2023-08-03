<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('user/partisi/head.php') ?>
<?php $this->load->view('user/partisi/datatables_css'); ?>
<body>

<?php $this->load->view('user/partisi/navbar.php') ?>

<main id="main">
<?php echo $content; ?>
</main>

<?php $this->load->view('user/partisi/footer.php') ?>
<?php $this->load->view('user/partisi/js.php') ?>
<?php $this->load->view('user/partisi/datatables_js'); ?>
<script>
// $('body').on("change","#combobox_provinsi",function(){
//     $('#combobox_kabupaten').empty().append('<option value="">Pilih Kabupaten</option>');
//     var id = $(this).val();
//     var data = "id="+id+"&data=kabupaten";
//     $.ajax({
//         type: 'POST',
//         url: '<?php echo base_url('main/get_data_wilayah') ?>',
//         data: data,
//         success: function(hasil) {
//             var data = JSON.parse(hasil);
//             var list_kabupaten = "";
//             for (let i=0; i<data.kabupaten.length; i++){
//                 list_kabupaten += '<option value='+data.kabupaten[i].kode+'>'+data.kabupaten[i].nama+'</option>';
//             }
//             $('#combobox_kabupaten').append(list_kabupaten);
//         }
//     });
// });

// $('body').on("change","#combobox_kabupaten",function(){
//     $('#combobox_kecamatan').empty().append('<option value="">Pilih Kecamatan</option>');
//     var id = $(this).val();
//     var data = "id="+id+"&data=kecamatan";
//     $.ajax({
//         type: 'POST',
//         url: "<?php echo base_url('main/get_data_wilayah') ?>",
//         data: data,
//         success: function(hasil) {
//             var data = JSON.parse(hasil);
//             var list_kecamatan = "";
//             for (let i=0; i<data.kecamatan.length; i++){
//                 list_kecamatan += '<option value='+data.kecamatan[i].kode+'>'+data.kecamatan[i].nama+'</option>';
//             }
//             $('#combobox_kecamatan').append(list_kecamatan);
//         }
//     });
// });

$('#list_alumni').DataTable({
    "processing" : true,
    "serverSide" : true,
    "responsive" : true,
    "order" : [],
    "ajax" : {
        'url' : '<?php echo base_url('main/listalumni') ?>',
        'type' : 'POST'
    },
    "columnDefs":[
        {
            'target':[0],
            'orderable':false
        }
    ]
});


$('#filter_alumni').hide();
$('#spinner').hide();

$('#filteralumni_form').submit(function(e){
    e.preventDefault();

    $.ajax({
        url : '<?php echo base_url('main/filteralumni') ?>',
        data : $('#filteralumni_form').serialize(),
        type : 'POST',
        beforeSend : function(){
            $('#spinner').show();
        },
        complete : function(){
            $('#spinner').hide();
        },
        success : function(data){
            $('#list_alumni').hide();
            $('#list_alumni').DataTable().destroy();

            $('#filter_alumni').show();
            $("#filter_alumni").find("tr:gt(0)").remove(); 
            var result = JSON.parse(data);
            
            for (let i=0; i<result.list_alumni.length; i++){
                $('#filter_alumni').append('<tr><td>' + result.list_alumni[i].nama_alumni + '</td><td>' + result.list_alumni[i].tahun_lulus + "</td><td> " + result.list_alumni[i].status_alumni + '</td><td>' + result.list_alumni[i].detail_status + '</td><td>' + '<center><a href="<?php echo base_url('main/lihatprofil/') ?>'+result.list_alumni[i].nisn+'"><span class="badge bg-primary">Lihat</span></a></center>' + '</td></tr>');
            }
        }
    });
});

</script>
</body>
</html>