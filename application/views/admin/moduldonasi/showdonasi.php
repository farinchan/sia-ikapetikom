<?php foreach ($data as $x): ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Detail Donasi : <?php echo $namadonasi; ?></h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"><?php echo $namadonasi; ?></li>
                <?php if($x->status_pembayaran == "Y"){ ?>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/ModulDonasi/success/'.$x->id_donasi) ?>">Success Diproses</a></li>
                <?php }else if($x->status_pembayaran == "N"){ ?>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/ModulDonasi/process/'.$x->id_donasi) ?>">Perlu Diproses</a></li>
                <?php }else{ ?>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/ModulDonasi/hidden/'.$x->id_donasi) ?>">Tidak Diproses</a></li>
                <?php } ?>
                <li class="breadcrumb-item"><a href="<?php echo base_url('admin/ModulDonasi/kontribusi') ?>">Kontribusi Donasi</a></li>
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
                    <h6>Detail Transaksi</h6>
                </div>
                <div class="card-body">
                    <form id="update_statusbayar" method="post">
                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-lg-2 col-form-label" >Judul Donasi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="judul_donasi" name="judul_donasi" placeholder="Judul Donasi" readonly value="<?php echo $namadonasi; ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Nama Donatur</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_donatur" id="nama_donatur" readonly required value="<?php echo $x->nama_alumni; ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Tahun Kelulusan </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tahun_lulus" id="tahun_lulus"  readonly required value="<?php echo $x->tahun_lulus; ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Total Donasi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="total_donasi" id="total_donasi"  readonly required value="<?php echo "Rp. ".number_format($x->total_donasi, 2, ',', '.');  ?>">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Tipe Pembayaran</label>
                            <div class="col-sm-10">
                            <select class="form-control" aria-label="Default select example" disabled name="id_tipepembayaran" id="id_tipepembayaran" required>
                                <option value="<?php echo $x->id_tipepembayaran ?>"><?php echo $x->rekening; ?> A/N <?php echo $x->atas_nama; ?> (<?php echo $x->nama_tipepembayaran; ?>)</option>
                            </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Waktu Transaksi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="waktu_transaksi" id="waktu_transaksi"  readonly required value="<?php echo $x->tanggal_bayar  ?>">
                            </div>
                        </div>

                        <?php if($x->doa_donatur != "kosong"): ?>
                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Doa Donatur</label>
                            <div class="col-sm-10">
                                <textarea id="doa_donatur" class="form-control" name="doa_donatur" rows="3" readonly placeholder="Tuliskan Program Donasi"><?php echo $x->doa_donatur ?></textarea>
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Bukti Transfer</label>
                            <div class="col-sm-10">
                                <ol class="list-group list-group-numbered">
                                    <li class="list-group-item"><a target="_BLANK" href="<?php echo base_url('assets/donasi/file/'.$x->bukti_transfer) ?>"><?php echo $x->bukti_transfer; ?></a></li>
                                </ol>
                            </div>
                        </div>

                        <input type="hidden" name="id_transaksi" value="<?php echo $x->id_transaksi; ?>">

                        <div class="mb-3 row">
                            <label for="nama_alumni" class="col-sm-2 col-form-label">Status Pembayaran</label>
                            <div class="col-sm-10">
                            <select class="form-control" aria-label="Default select example" name="status_pembayaran" id="status_pembayaran" required>
                                <option value="Y" <?php if($x->status_pembayaran == "Y"){ ?> selected <?php } ?>>Pembayaran Ini Sudah Terverifikasi</option>
                                <option value="N" <?php if($x->status_pembayaran == "N"){ ?> selected <?php } ?>>Pembayaran Ini Belum Terverifikasi</option>
                                <option value="T" <?php if($x->status_pembayaran == "T"){ ?> selected <?php } ?>>Pembayaran Ini Tidak Terverifikasi</option>
                            </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" style="float: right; margin-left:10px;"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="spinner"></span> Perbaruhi</button>
                        <a type="button" href="<?php echo base_url('admin/ModulDonasi/hapustransaksi/'.$x->id_transaksi) ?>" onclick="return confirm('Anda Yakin Mau Menghapus Transaksi Ini ?')" class="btn btn-danger" style="float: right;"> Hapus</a>
                    </form>
                    <?php endforeach; ?>
                </div>
                </div>
            </div>
            </div>
      </div>
    </div>
    </section>
</div>
