<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
                <li>Pencarian Alumni</li>
            </ol>
            <?php $this->load->view('user/partisi/cariberita.php') ?>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <h2 style="margin-top: -30px;">Pencarian Alumni</h2>
        <div class="row">                
            <div class="col-sm-8" >                
                <section id="team" class="team section-bg" style="background-color: white;" >
                    <div data-aos="fade-up" style="margin-top: -20px;">    
                        <form id="filteralumni_form" method="post">
                        <!-- <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Provinsi</label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example" required name="provinsi" id="combobox_provinsi">
                                    <option value="">Pilih Provinsi</option>
                                    <?php foreach ($provinsi as $list_provinsi): ?>
                                    <option value="<?php echo $list_provinsi->kode; ?>"><?php echo $list_provinsi->nama; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Kabupaten</label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example" required name="kabupaten" id="combobox_kabupaten" required>
                                    <option value="">Pilih Kabupaten</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Kecamatan</label>
                            <div class="col-sm-10">
                                <select class="form-select" aria-label="Default select example" required name="kecamatan" id="combobox_kecamatan" required>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                            </div>
                        </div> -->

                            <div class="mb-3 row">
                                <label for="nama_alumni" class="col-sm-2 col-form-label">Nama Alumni</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_alumni" required name="nama_alumni">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Tahun Lulus</label>
                                <div class="col-sm-10">
                                    <select class="form-select" aria-label="Default select example" required name="tahun_lulus" id="tahun_lulus">
                                        <option value="">Pilih Tahun</option>
                                        <?php foreach ($tahunlulus as $x){ ?>
                                        <option value="<?php echo $x->tahun_lulus ?>"><?php echo $x->tahun_lulus; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Filter</button>
                        </form>
                        <br><br>                    
                        <table class="table table-bordered" id="list_alumni">
                            <thead>
                                <tr>
                                <th scope="col">Nama Alumni</th>
                                <th scope="col">Kelulusan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Satuan Kerja / Kampus</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        
                        <table class="table table-bordered" id="filter_alumni">
                            <thead>
                                <tr>
                                <th scope="col">Nama Alumni</th>
                                <th scope="col">Kelulusan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Satuan Kerja / Kampus</th>
                                <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </section>
                </div>

                <div class="col-sm-4">
                    <?php $this->load->view('user/cari_alumni/sidebar.php') ?>                       
                </div>
            </div>
        </div>    
    </div>
</section>