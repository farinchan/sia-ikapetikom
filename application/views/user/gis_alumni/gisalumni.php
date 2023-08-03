<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('user/partisi/head.php') ?>

<body>

    <?php $this->load->view('user/partisi/navbar.php') ?>

    <main id="main">
        <?php $this->load->view('user/gis_alumni/map.php') ?>
    </main>

    <?php $this->load->view('user/partisi/footer.php') ?>
    <?php $this->load->view('user/partisi/js.php') ?>
    <script src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="<?= base_url() ?>assets/leaflet/leaflet-search/dist/leaflet-search.src.js"></script>
    <script>
        $(document).ready(function () {
            // Mengirim permintaan AJAX ke server saat halaman HTML pertama kali dimuat
            $.ajax({
                url: "<?php echo base_url(); ?>main/gisalumniget?filter=true",
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    var tahunkelulusan = <?php echo json_encode($lulus); ?>;

                    var map = L.map('map').setView([-0.36076903180249653, 117.42046949636378], 5);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '<a href="https://ikapetikom.or.id/">IKAPETIKOM</a> Ikatan Alumni Pendidkan Teknik Informatika dan Komputer',
                        maxZoom: 19,
                    }).addTo(map);

                    // START - MARKER UNTUK FUNGSI SEARCH
                    /*
                    note : jika ingin memakai fungsi search harap comment fitur group marker
                    */
                    // var markersLayer = new L.LayerGroup();
                    // map.addLayer(markersLayer);

                    // var controlSearch = new L.Control.Search({
                    //     position: 'topright',
                    //     layer: markersLayer,
                    //     initial: false,
                    //     zoom: 12,
                    //     marker: false
                    // });

                    // map.addControl(controlSearch);

                    // var UserMarker = L.icon({
                    //     iconUrl: '<?= base_url() ?>assets/user/placeholder.png',
                    //     iconSize: [28, 30], // size of the icon
                    // });
                    // tahunkelulusan.forEach(element => {
                    //     markersGroup = []
                    //     response[element.tahun_lulus].forEach(element => {
                    //         markersLayer.addLayer(L.marker(element["geometry"]["coordinates"], { title: element["properties"]["nama_alumni"], icon: UserMarker }).bindPopup(element["properties"]["popUp"]));
                    //     });
                    // });
                    // END - MARKER UNTUK FUNGSI SEARCH

                    var layerGroup = L.layerGroup().addTo(map);

                    function changeLayer(layerName) {
                        layerGroup.clearLayers();

                        if (layerName === 'layer1') {
                            layerGroup.addLayer(layer1);
                        } else if (layerName === 'layer2') {
                            layerGroup.addLayer(layer2);
                        } else if (layerName === 'layer3') {
                            layerGroup.addLayer(layer3);
                        }
                    }

                    var layer1 = L.marker([51.5, -0.09]).addTo(map);
                    var layer2 = L.circle([51.508, -0.11], { radius: 500 }).addTo(map);
                    var layer3 = L.polygon([
                        [51.509, -0.08],
                        [51.503, -0.06],
                        [51.51, -0.047]
                    ]).addTo(map);



                    // Tambahkan layer control
                    var baseLayers = {
                        'OpenStreetMap': L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '<a href="https://ikapetikom.or.id/">IKAPETIKOM</a> Ikatan Alumni Pendidkan Teknik Informatika dan Komputer',
                            maxZoom: 19,
                        }),
                        'OpenStreetMap.HOT': L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '<a href="https://ikapetikom.or.id/">IKAPETIKOM</a> Ikatan Alumni Pendidkan Teknik Informatika dan Komputer'
                        }),
                        'openTopoMap': L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '<a href="https://ikapetikom.or.id/">IKAPETIKOM</a> Ikatan Alumni Pendidkan Teknik Informatika dan Komputer'
                        })
                    };

                    var overlayLayers = {}

                    // START - MARKER UNTUK FUNGSI GROUP MARKER (Berdasarkan tahun Lulusan)
                    /*
                    note : jika ingin memakai fungsi group marker harap comment fitur search
                    */
                    var UserMarker = L.icon({
                        iconUrl: '<?= base_url() ?>assets/user/placeholder.png',
                        iconSize: [28, 30], // size of the icon
                    });
                    tahunkelulusan.forEach(element => {
                        markersGroup = []
                        response[element.tahun_lulus].forEach(element => {
                            console.log(element)
                            // console.log(element["geometry"]["coordinates"] + element["properties"]["popUp"]);
                            markersGroup.push(L.marker(element["geometry"]["coordinates"], { title: element["properties"]["nama_alumni"], icon: UserMarker }).bindPopup(element["properties"]["popUp"]));
                        });

                        var layer = L.layerGroup(markersGroup)
                        overlayLayers[' Lulusan ' + element.tahun_lulus] = layer;

                        map.addLayer(layer);
                    });
                    // END - MARKER UNTUK FUNGSI GROUP MARKER (Berdasarkan tahun Lulusan)

                    // START - MARKER UNTUK GEOCODER (Mencari dan Menadai Tempat)
                    var GeocoderCustomMarker = L.icon({
                        iconUrl: '<?= base_url() ?>assets/user/location-pin.png',
                        iconSize: [40, 35], // size of the icon
                    });

                    var geocoder = L.Control.geocoder({
                        defaultMarkGeocode: false,
                        collapsed: false,
                    }).on('markgeocode', function (e) {
                        var latlng = e.geocode.center;
                        var marker = L.marker(latlng, { icon: GeocoderCustomMarker }).addTo(map);
                        marker.bindPopup(e.geocode.html || e.geocode.name).openPopup();
                        map.setView(latlng);
                    });

                    geocoder.addTo(map);
                    // END - MARKER UNTUK GEOCODER (Mencari dan Menadai Tempat)

                    L.control.layers(baseLayers, overlayLayers).addTo(map);


                },
                error: function () {
                    // Menampilkan pesan kesalahan jika terjadi kesalahan pada permintaan
                    console.log('Terjadi kesalahan pada permintaan.');
                }
            });
        });


    </script>


</body>

</html>