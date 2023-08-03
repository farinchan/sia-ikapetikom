<?php $this->load->view('user/partisi/datatables_css'); ?>

<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
                <li><a href="<?php echo base_url('main/profil'); ?>">Dashboard Alumni</a></li>
                <li>List Topik Anda</li>
            </ol><br>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Cari Kegiatan" aria-label="Search"><br>
                <button class="btn btn-outline-info" type="submit">Cari</button>
            </form>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <h2 style="margin-top: -30px;">List Topik Anda </h2>
        <div class="row">                

            <section id="team" class="team section-bg" style="background-color: white;" >
                <div data-aos="fade-up" style="margin-top: -20px;">    
                    <div class="card">
                        <div class="card-header" style="background-color: white;">
                            <?php echo $total_published; ?> Topik <span class="badge bg-success">Dibuka</span>  | <?php echo $total_unpublished; ?> Topik <span class="badge bg-danger">Ditutup</span>
                        </div>
                        <div class="card-body">
                        
                            <table class="table table-bordered responsive" id="list_topik">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Judul Topik</th>
                                        <th scope="col">Kategori Topik</th>
                                        <th scope="col">Hak Akses</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Dilihat</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach ($list_topik as $list): ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $list->judul_topik; ?></td>
                                            <td><?php echo " - ".strtoupper($list->nama_kategoritopik)." - "; ?></td>
                                            <td>
                                                <?php if($list->hak_akses == "public"){echo "Publik";}else{echo "Alumni ".$list->tahun_lulus; } ?>
                                            </td>
                                            <td>
                                                <?php if($list->status_topik == "Y"){echo "<i style='color:green;'>Dibuka</i>"; }else{echo "<i style='color:red;'>Ditutup</i>"; } ?>
                                            </td>
                                            <td><?php echo $list->total_dilihat." dilihat"; ?></td>
                                            <td><center><a href="<?php echo base_url('main/alumniedittopik/'.$list->id_topik); ?>" ><span class="badge bg-primary"><i class="fas fa-edit"></i></span></a> <a href="<?php echo base_url('main/bacatopik/'.$list->id_topik) ?>" ><span class="badge bg-success"><i class="fas fa-eye"></i></span></a> <a href="<?php echo base_url('main/hapustopik/'.$list->id_topik) ?>" onclick="return confirm('yakin mau menghapus topik ini ?')"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a></center></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>  
                     
         </div>
        </div>    
    </div>
</section>