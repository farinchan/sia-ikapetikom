<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="exampleModalLabel"><?php echo $nama; ?></h5>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<div class="row">
<?php $i=1; foreach ($data as $x): ?>
<?php if($x->type == "foto"){ ?>
<div class="col-sm-6 playful">
<a href="<?php echo base_url('assets/galeri/'.$x->file) ?>" class="fancybox" data-fancybox="images" rel="gallery1">
<figure class="softeffect">
<img src="<?php echo base_url('assets/galeri/'.$x->file) ?>" class="img-responsive" alt="Sea Caves - Apostle Islands"/>
<figcaption>
<h4></h4>
</figcaption>
</figure> </a>
</div>
<?php }else{ ?>
<?php
$video_id = explode("?v=", $x->file);
$video_id = $video_id[1];
?>
<div class="col-sm-6 playful">
<a data-fancybox data-src="<?php echo base_url('assets/galeri/'.$x->file) ?>" href="javascript:;" >
<figure class="softeffect">
<img src="https://img.youtube.com/vi/<?php echo $video_id; ?>/0.jpg" class="img-responsive" alt="Sea Caves - Apostle Islands">
<figcaption>
<h4>Title</h4>
<p>Description</p>
</figcaption>
</figure>
</a>
</div>
<?php } ?>
<?php endforeach; ?>
</div>
</div>
</div>
