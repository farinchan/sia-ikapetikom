<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('user/partisi/head.php'); ?>
<body>

<?php $this->load->view('user/partisi/navbar.php') ?>

<main id="main">
<?php echo $content; ?>
</main>

<?php $this->load->view('user/partisi/footer.php') ?>
<?php $this->load->view('user/partisi/js.php') ?>
<script>
$('#pagination').on('click','a',function(e){
    e.preventDefault(); 
    var pageno = $(this).attr('data-ci-pagination-page');
    loadPagination(pageno);
});

loadPagination(0);

function loadPagination(pagno){
    $.ajax({
        url: 'listtraceralumni/'+pagno,
        type: 'GET',
        dataType: 'json',
        success: function(response){
        $('#pagination').html(response.pagination);
        createList(response.result,response.row);
        }
    });
}

function createList(result,sno){
    sno = Number(sno);
    $('#datatracer').empty();
    for(index in result){
        var judul_tracer = result[index].judul_tracer;
        var isi_tracer = result[index].isi_tracer;
        var gambar_tracer = result[index].gambar_tracer;
        var tanggal_posting = result[index].tanggal_posting;
        var total_dilihat = result[index].total_dilihat;
        var id_tracer = result[index].id_tracer;

        sno+=1;
        var html = '';
        var OriginalString = removeTags(isi_tracer);
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        const Datetime = new Date(tanggal_posting);

        html += '<div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">';
        html += '<div class="member"><div class="member-img">';
        html += '<img src="<?php echo base_url('assets/tracer/') ?>'+gambar_tracer+'" class="img-fluid" alt="">';
        html += '<div class="social">';

        html += '<a href="https://twitter.com/share?url=<?php echo base_url('main/bacatracer/'); ?>'+id_tracer+'"><i class="fab fa-twitter-square"></i></a>';
        html += '<a href="https://www.facebook.com/sharer.php?s=100&amp;p[title]='+judul_tracer+'&amp;p[url]=<?php echo base_url('main/bacatracer/'); ?>'+id_tracer+'"&amp;&p[images][0]=<?php echo base_url('assets/tracer/');?>'+gambar_tracer+'"><i class="fab fa-facebook-square"></i></a>';
        html += '<a target="BLANK" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url('main/bacatracer/'); ?>'+id_tracer+'"&title='+judul_tracer+'"><i class="fab fa-linkedin"></i></a>';

        html += '</div></div>';
        html += '<div class="member-info" >';
        html += '<a href="<?php echo base_url('main/bacatracer/') ?>'+id_tracer+'" id="populer">'+judul_tracer+'</a>';
        html += '<span id="card-donasi"><i class="far fa-calendar-alt"></i> '+Datetime.getDate()+' '+monthNames[Datetime.getMonth()]+' '+Datetime.getFullYear()+' &bull; <i class="fas fa-bolt"></i> dilihat '+total_dilihat+'</span>';
        html += '<p style="font-style:normal;">'+OriginalString.substr(0, 70)+'...</p>';
        html += '</div></div></div>';

        $('#datatracer').append(html);

    }
}

function removeTags(str) {
    if ((str===null) || (str===''))
    return false;
    else
    str = str.toString();
    return str.replace( /(<([^>]+)>)/ig, '');
}


</script>
</body>

</html>