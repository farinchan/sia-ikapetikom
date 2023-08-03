<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin/partisi/head.php'); ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php $this->load->view('admin/partisi/navbar.php'); ?>
<?php $this->load->view('admin/partisi/sidebar.php'); ?>

<?php echo $content; ?>
<div class="modal fade" id="ModalEditFotoAlumni" data-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Foto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_update_foto" method="post">
          <div class="mb-0">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="myFile" required>
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
            <input type="hidden" name="nisn">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_gambar"></span> Edit
        </button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalHapusAlumni" data-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Hapus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="form_hapus_alumni" method="post">
          <div class="mb-0">
            <input type="hidden" name="nisn">
            Anda Yakin Ingin Menghapus Akun Ini ?
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner_hapus"></span> Hapus
        </button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php $this->load->view('admin/partisi/footer.php') ?>
</div>
<?php $this->load->view('admin/partisi/js.php') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
<script>
    if (document.getElementById('latitude') != null) {
        var latitude = document.getElementById('latitude').value;
        var longitude = document.getElementById('longitude').value;

        

        var map = L.map('map').setView([latitude, longitude], 13); // Koordinat default Jakarta, bisa disesuaikan

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);
        var customIcon = L.icon({
            iconUrl: "<?php echo base_url(); ?>assets/user/placeholder.png", // Ubah path sesuai dengan lokasi gambar ikon marker Anda
            iconSize: [42, 42], // Ukuran ikon marker
            iconAnchor: [16, 32] // Posisi anchor ikon marker
        });
        var marker = L.marker([latitude, longitude], { draggable: true, icon: customIcon }).addTo(map); // Ganti latitude dan longitude dengan koordinat yang diinginkan
        marker.on('dragend', function (e) {
            var latLng = e.target.getLatLng();
            console.log("Latitude : " + latLng.lat + " longitude : " + latLng.lng);
            document.getElementById('latitude').value = latLng.lat;
            document.getElementById('longitude').value = latLng.lng;
        });
    }
 </script>

<script>
    $(document).ready(function(){
        $('#spinner').hide();
        $('#spinner_gambar').hide();
        $('#spinner_hapus').hide();
        $('#isi_berita').summernote({
            placeholder: 'Tulis Isi Berita Disini',
            height: 400,
            dialogsInBody: true,
            dialogsFade: false
        });

        $('#TahunLulus').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            
        });

        $('#list_alumni').DataTable({
            "processing" : true,
            "serverSide" : true,
            "responsive" : true,
            "order" : [],
            "ajax" : {
                'url' : '<?php echo base_url('admin/ModulAlumni/listalumni') ?>',
                'type' : 'POST'
            },
            "columnDefs":[
                {
                    'target':[0],
                    'orderable':false
                }
            ]
        });

        $('#acc_alumni').DataTable({
            "processing" : true,
            "serverSide" : true,
            "responsive" : true,
            "order" : [],
            "ajax" : {
                'url' : '<?php echo base_url('admin/ModulAlumni/listalumni_acc') ?>',
                'type' : 'POST'
            },
            "columnDefs":[
                {
                    'target':[0],
                    'orderable':false
                }
            ]
        });

        $('#tambah_tahun').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : '<?php echo base_url('admin/ModulAlumni/tambahtahun_action') ?>',
                type : 'POST',
                data : $('#tambah_tahun').serialize(),
                beforeSend : function(){
                    $('#spinner').show();
                },
                complete : function(){
                    $('#spinner').hide();
                },
                success : function(data){
                    swal(data);
                    $('#tambah_tahun').trigger("reset");
                }
            });
        });

        $('body').on("change","#combobox_provinsi",function(){
            $('#combobox_kabupaten').empty().append('<option value="">Pilih Kabupaten</option>');
            var id = $(this).val();
            var data = "id="+id+"&data=kabupaten";
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('main/get_data_wilayah') ?>',
                data: data,
                success: function(hasil) {
                var data = JSON.parse(hasil);
                var list_kabupaten = "";
                for (let i=0; i<data.kabupaten.length; i++){
                    list_kabupaten += '<option value='+data.kabupaten[i].kode+'>'+data.kabupaten[i].nama.toUpperCase()+'</option>';
                }
                $('#combobox_kabupaten').append(list_kabupaten);
                }
            });
        });

        $('body').on("change","#combobox_kabupaten",function(){
            $('#combobox_kecamatan').empty().append('<option value="">Pilih Kecamatan</option>');
            var id = $(this).val();
            var data = "id="+id+"&data=kecamatan";
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('main/get_data_wilayah') ?>",
                data: data,
                success: function(hasil) {
                    var data = JSON.parse(hasil);
                    var list_kecamatan = "";
                    for (let i=0; i<data.kecamatan.length; i++){
                        list_kecamatan += '<option value='+data.kecamatan[i].kode+'>'+data.kecamatan[i].nama.toUpperCase()+'</option>';
                    }
                    $('#combobox_kecamatan').append(list_kecamatan);
                }
            });
        });

        $(document).on('click', '.toggle-password', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $("#password");
            input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
        });
      
        $(function () {
            bsCustomFileInput.init();
        });

        $('#updateprofilalumni_form').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : '<?php echo base_url('admin/ModulAlumni/updateprofilalumni_action'); ?>',
                type: 'POST',
                data : $('#updateprofilalumni_form').serialize(),
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

        $('#foto_alumni').on('click', function(e){
            e.preventDefault();
            $('#ModalEditFotoAlumni').modal('show');
            var nisn = $(this).data('nisn');
            $('[name="nisn"]').val(nisn);
        });

        $('#hapus_alumni').on('click', function(e){
            e.preventDefault();
            $('#ModalHapusAlumni').modal('show');
            var nisn = $(this).data('nisn');
            $('[name="nisn"]').val(nisn);
        });

        $('#form_update_foto').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : '<?php echo base_url('admin/ModulAlumni/updatefotoprofil_alumni') ?>',
                type : 'POST',
                data : new FormData(this),
                dataType : 'JSON',
                contentType : false,
                cache : false,
                processData : false,
                beforeSend : function(){
                    $('#spinner_gambar').show();
                },
                complete : function(){
                    $('#spinner_gambar').hide();
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

        $('#form_hapus_alumni').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : '<?php echo base_url('admin/ModulAlumni/hapusalumni') ?>',
                type : 'POST',
                data : $('#form_hapus_alumni').serialize(),
                beforeSend : function(){
                    $('#spinner_gambar').show();
                },
                complete : function(){
                    $('#spinner_gambar').hide();
                },
                success : function(data){
                    swal(data)
                    .then((value) => {
                        window.location.href = '<?php echo base_url('admin/ModulAlumni/data'); ?>'
                    });
                }, 
                error : function(data){
                    console.log(data);
                }
            });
        });

        $('#register_form').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : '<?php echo base_url('admin/ModulAlumni/tambahalumni_action') ?>',
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
                    $('#register_form').trigger("reset");
                    swal(data);
                }, 
                error : function(data){
                    console.log(data);
                }
            });
        });

        $('#editberita_form').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : '<?php echo base_url('admin/ModulAlumni/editberita_action'); ?>',
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
                    $('#editberita_form').trigger("reset");
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

        $('#form_edittopik').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : '<?php echo base_url('admin/ModulAlumni/alumniedittopik_action') ?>',
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

        $('#excel').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : '<?php echo base_url('admin/ModulAlumni/importalumni') ?>',
                type : 'POST',
                data : new FormData(this),
                dataType : 'JSON',
                contentType : false,
                cache : false,
                processData : false,
                beforeSend : function(){
                    $('#spinner').show();
                    $('#submit').hide();
                },
                complete : function(){
                    $('#spinner').hide();
                    $('#submit').show();
                },
                success : function(data, xhr){
                    swal(data)
                    .then((value) => {
                    location.reload();
                    });
                }, 
                error: function(xhr, status, error) {
                    alert("Error Kode : "+xhr.status+"; Ada NISN yang duplicate antara tabel alumni yang di database dan table di file excle");
                }
            });
        });

    });
</script>
</body>
</html>
