<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Diskusi : <?php echo $nama_topik; ?></h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Isi Diskusi</li>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/ModulForum/data') ?>">Kontribusi Topik</a></li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <section class="content">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                <div class="card-header">
                    <h6>Pembuat Topik : <?php echo $nama_alumni; ?></h6>
                </div>
                <div class="card-body">

                <?php foreach ($detail_topik as $x): ?>
                <div class="tab-pane" id="timeline">
                    <div class="timeline timeline-inverse">
                      <div class="time-label">
                        <span class="bg-success">
                          Dibuat <?php echo $tgl_topik_dibuat; ?>
                        </span>
                      </div>
                      <div>
                        <?php if($x->lampiran_file == "kosong"){ ?>
                        <i class="fas fa-envelope bg-primary"></i>
                        <?php }else{ ?>
                        <i class="fas fa-file-alt bg-primary"></i>
                        <?php } ?>
                        <div class="timeline-item">
                          <span class="time"><i class="far fa-eye"></i> dilihat <?php echo $x->total_dilihat; ?> kali</span>
                          <h3 class="timeline-header"><a href="<?php echo base_url('admin/ModulAlumni/lihat/'.$x->nisn); ?>"><img src="<?php echo base_url('assets/user/img/'.$foto_alumni); ?>" alt="" class="rounded-circle" srcset="" width="30px"> <?php echo $nama_alumni; ?></a> <i>mengatakan</i></h3>
                          <div class="timeline-body">
                            <?php echo $x->isi_topik; ?>
                            <br><br>

                            <?php if($x->lampiran_file != "kosong"): ?>
                            Lampiran File <a href="<?php echo base_url('main/downloadfiletopik?data='.$x->lampiran_file);?>"><?php echo $x->lampiran_file; ?></a>
                            <?php endif; ?>

                          </div>
                          <div class="timeline-footer">
                            <a href="<?php echo base_url('admin/ModulAlumni/edittopik/'.$x->nisn.'/'.$x->id_topik) ?>" class="btn btn-secondary btn-sm">Edit</a>
                            <a target="_BLANK" href="<?php echo base_url('main/bacatopik/'.$x->id_topik) ?>" class="btn btn-info btn-sm">Lihat</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endforeach; ?>

                <div class="tab-pane" id="timeline">
                    <div class="timeline timeline-inverse" id="isi_diskusi">
                    </div>
                </div>
                <div id='pagination'></div>
                </div>
            </div>
            </div>
            <input type="hidden" id="tot_diskusi" value=" <?php echo $total_diskusi; ?>">
      </div>
    </div>
    </section>
</div>