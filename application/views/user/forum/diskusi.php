<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
                <li>Forum Alumni</li>
            </ol>
            <?php $this->load->view('user/partisi/cariberita.php') ?>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <h2 style="margin-top: -30px;">Forum Diskusi</h2>
        <div class="row">                
            <div class="col-sm-8" >                
                <section id="team" class="team section-bg" style="background-color: white;" >
                    <table class="table table-responsive" id="postsList">
                        <thead>
                            <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul Topik</th>
                            <th scope="col">Tipe Diskusi</th>
                            <th scope="col">Alumni</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <div id='pagination'></div>
                </section>
            </div>
            <?php $this->load->view('user/forum/info_topik.php'); ?>
            </div>
        </div>    
    </div>
</section>
