<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <ol>
                <li><a href="<?php echo base_url('main/') ?>">Home</a></li>
                <li>Galeri</li>
            </ol>
            <?php $this->load->view('user/partisi/cariberita.php') ?>
        </div>
    </div>
</section>
<section class="inner-page">
    <div class="container">
        <h2 style="margin-top: -30px;" id="title-konten"><?php echo $judul_kegiatan; ?></h2>
        <div class="row mt-5">
            <?php foreach ($data as $x): ?>
            <?php if($x->type == "foto"){ ?>            
            <div class="col-lg-3 col-md-6" >                
                <div class="playful">
                    <a href="<?php echo base_url('assets/galeri/'.$x->file); ?>" class="fancybox" data-fancybox="images" rel="gallery1">
                        <figure class="softeffect">
                        <img src="<?php echo base_url('assets/galeri/'.$x->file) ?>" class="img-responsive" alt="Sea Caves - Apostle Islands"/>
                        </figure>
                    </a>
                </div>
            </div>
            <?php }else{ ?>
                <div class="col-lg-3 col-md-6 playful">
                    <a data-fancybox data-src="<?php echo $x->file;?>" href="javascript:;" >
                        <figure class="softeffect">
                        <img src="https://img.youtube.com/vi/<?php echo getYouTubeVideoId($x->file); ?>/0.jpg" class="img-responsive" alt="Sea Caves - Apostle Islands">
                        </figure>
                    </a>
                </div>
            <?php } ?>
            <?php endforeach; ?>
        </div>    
    </div>
</section>

<?php
function getYouTubeVideoId($pageVideUrl) {
    $link = $pageVideUrl;
    $video_id = explode("?v=", $link);
    if (!isset($video_id[1])) {
        $video_id = explode("youtu.be/", $link);
    }
    $youtubeID = $video_id[1];
    if (empty($video_id[1])) $video_id = explode("/v/", $link);
    $video_id = explode("&", $video_id[1]);
    $youtubeVideoID = $video_id[0];
    if ($youtubeVideoID) {
        return $youtubeVideoID;
    } else {
        return false;
    }
}
?>
