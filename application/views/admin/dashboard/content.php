<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            </div>
        </div>
        </div>
    </div>

    <section class="content">
    <div class="content">
      <div class="container-fluid">

      <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Alumni</span>
                <span class="info-box-number">
                  <?php echo $totalalumni; ?>
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-newspaper"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Berita</span>
                <span class="info-box-number"><?php echo $totalberita; ?></span>
              </div>
            </div>
          </div>

          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-comment-dots"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Topik</span>
                <span class="info-box-number"><?php echo $totaltopik; ?></span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-hand-holding-usd"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Donasi</span>
                <span class="info-box-number"><?php echo $totaldonasi; ?></span>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Log Login Alumni</h3>
                </div>
              </div>
              <div class="card-body">

              <table class="table" id="Loglogin">
                <thead>
                    <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Kelulusan</th>
                    <th scope="col">Last Login</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                </table>

              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Transaksi Baru</h3>
                </div>
              </div>

              <div class="card-body">

              <table class="table table-responsive">
                <thead>
                    <tr>
                    <th scope="col">Donatur</th>
                    <th scope="col">Nama Donasi</th>
                    <th scope="col">Tgl Transaksi</th>
                    <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transaksi as $x): ?>
                    <?php
                        $originalDate = $x->tanggal_bayar;
                        $newDate = date("d F Y", strtotime($originalDate));
                    ?>
                    <tr>
                        <td><?php echo "<a style='color:black' href='".base_url('admin/moduldonasi/detail/'.$x->id_donasi.'/'.$x->id_transaksi)."'>$x->nama_alumni</a>"; ?></td>
                        <td><?php echo substr($x->judul_donasi, 0, 30)."..." ?></td>
                        <td><?php echo $x->tanggal_bayar; ?></td>
                        <td><?php echo "Rp. ".number_format($x->total_donasi, 2, ',', '.'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                </table>

              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
    </section>
</div>