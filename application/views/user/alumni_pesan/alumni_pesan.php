<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('user/partisi/head.php') ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dropzone.css">

<body>

<?php $this->load->view('user/partisi/navbar.php') ?>

<main id="main">
<?php echo $content; ?>
</main>

<?php $this->load->view('user/partisi/footer.php') ?>
<?php $this->load->view('user/partisi/js.php') ?>
<script src="<?php echo base_url(); ?>assets/js/dropzone.js"></script>

<script>
$("#textarea_pesan").each(function () {
  this.setAttribute("style", "height:" + (this.scrollHeight) + "px;overflow-y:hidden;");
}).on("input", function () {
  this.style.height = "auto";
  this.style.height = (this.scrollHeight) + "px";
});

$(document).ready(function(){
    $('#spinner').hide();

    $('#form_pesan').submit(function(e){
      e.preventDefault();

      $.ajax({
          url : '<?php echo base_url('main/kirim_pesan_action'); ?>',
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
            
            $('#form_pesan').trigger("reset");
            $('#list_pesan li').remove();
            
            var html = "";

            html += '<ul class="list-group list-group-flush" id="list_pesan">';

            for (let k=0; k<data.data_penerima.length; k++){

              for (let i=0; i<data.data_profil.length; i++){

                for (let j=0; j<data.list_pesan.length; j++){

                    html += '<li class="list-group-item"><i class="fas fa-user"></i> ';
                    
                    if(data.list_pesan[j].nisn_pengirim == data.data_profil[i].nisn){

                      html += data.data_profil[i].nama_alumni;

                    }else{

                      html += data.data_penerima[k].nama_alumni;

                    }

                    html += '<small class="text-muted">, Dikirim ';
                    html += data.list_pesan[j].tanggal;
                    html += '</small></li>';

                    html += '<li class="list-group-item"><div class="row"><div class="col-2">';
                    
                    if(data.list_pesan[j].nisn_pengirim == data.data_profil[i].nisn){

                      html += '<img id="image-diskusi" src="<?php echo base_url(); ?>assets/user/img/'+data.data_profil[i].foto_alumni+'" alt="" class="img-fluid rounded-circle" width="80px">'

                    }else{

                      html += '<img id="image-diskusi" src="<?php echo base_url(); ?>assets/user/img/'+data.data_penerima[k].foto_alumni+'" alt="" class="img-fluid rounded-circle" width="80px">'


                    }

                    html += '</div>';
                    html += '<div class="col-9">';
                    html += '<p style="font-size: 14px;">'+data.list_pesan[j].isi_pesan+'</p>';
                    
                    if(data.list_pesan[j].lampiran_file == "kosong"){

                    }else{

                      html += '<small>Lampiran file : </small>';
                      html += '<small><a href="<?php echo base_url('main/downloadfile?data='); ?>'+data.list_pesan[j].lampiran_file+'">'+data.list_pesan[j].lampiran_file+'</a></small>';

                    }

                    html += '</div></div></li>'
                }

              }

            }

            html += '</ul>';

            $('#konten_pesan').append(html);

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