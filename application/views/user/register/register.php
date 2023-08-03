<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('user/partisi/head.php') ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dropzone.css">
<style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
<body>

<?php $this->load->view('user/partisi/navbar.php') ?>

<main id="main">
<?php echo $content; ?>
</main>

<?php $this->load->view('user/partisi/footer.php') ?>
<?php $this->load->view('user/partisi/js.php') ?>
<script src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOuJ6qY0cm0rtDK9_zjqposXbNwQwUE_4"></script>
<script>
        var map;
        var marker;

        function initMap() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                var initialLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                map = new google.maps.Map(document.getElementById('map'), {
                    center: initialLocation,
                    zoom: 13
                });

                marker = new google.maps.Marker({
                    position: initialLocation,
                    map: map,
                    draggable: true,
                    icon: "<?php echo base_url(); ?>assets/user/placeholder.png"
                });

                google.maps.event.addListener(marker, 'dragend', function () {
                    updateMarkerPosition(marker.getPosition());
                });
            });
        } else {
            // Handle jika geolocation tidak didukung oleh browser
            var initialLocation = { lat: -6.175392, lng: 106.827153 };

            map = new google.maps.Map(document.getElementById('map'), {
                center: initialLocation,
                zoom: 13
            });

            marker = new google.maps.Marker({
                position: initialLocation,
                map: map,
                draggable: true
            });

            google.maps.event.addListener(marker, 'dragend', function () {
                updateMarkerPosition(marker.getPosition());
            });
        }
        }

        function updateMarkerPosition(latLng) {
            console.log("Latitude : " + latLng.lat() + " Longtitude : " + latLng.lng());
            document.getElementById('latitude').value = latLng.lat();
            document.getElementById('longitude').value = latLng.lng();
        }

        google.maps.event.addDomListener(window, 'load', initMap);
    </script>

<script>
    $("#textarea_diskusi").each(function () {
    this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
    }).on("input", function () {
    this.style.height = "auto";
    this.style.height = (this.scrollHeight) + "px";
    });

    $(document).on('click', '.toggle-password', function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $("#password");
    input.attr('type') === 'password' ? input.attr('type','text') : input.attr('type','password')
    });
</script>


<script>
    $(document).ready(function(){
        $('#spinner').hide();

        $('body').on("change","#combobox_provinsi",function(){
            $('#combobox_kabupaten').empty().append('<option value="">Pilih Kabupaten</option>');
            var id = $(this).val();
            var data = "id="+id+"&data=kabupaten";
            console.log( data);
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('main/get_data_wilayah') ?>',
                data: data,
                success: function(hasil) {
                    console.log("Kabupaten = " + hasil);
                    var data = JSON.parse(hasil);
                    console.log("yahaha");
                    var list_kabupaten = "";
                    for (let i=0; i<data.kabupaten.length; i++){
                        list_kabupaten += '<option value='+data.kabupaten[i].kode+'>'+data.kabupaten[i].nama+'</option>';
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
                        list_kecamatan += '<option value='+data.kecamatan[i].kode+'>'+data.kecamatan[i].nama+'</option>';
                    }
                    $('#combobox_kecamatan').append(list_kecamatan);
                }
            });
		});


        $('#register_form').submit(function(e){
            e.preventDefault();
            $.ajax({
                url : '<?php echo base_url('main/registeralumni_action') ?>',
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

    });
</script>

</body>

</html>