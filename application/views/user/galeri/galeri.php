<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('user/partisi/head.php'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<style>
.playful figure {
  cursor: pointer;
  float: left;
  margin: 10px 1%;
  max-height: 225px;
  max-width: 480px;
  overflow: hidden;
  position: relative;
  text-align: center;
  width: 100%;
}

.playful figure figcaption,
.playful figure figcaption > a {
  height: 100%;
  left: 0;
  position: absolute;
  top: 0;
  width: 100%;
}

.playful figure figcaption {
  backface-visibility: hidden;
  color: #fff;
  font-size: 1.25em;
  text-transform: uppercase;
}

.playful figure h4,
.playful figure p {
  margin: 0;
}

.playful figure h4 {
  color: #fff;
  font-size: 20px;
  font-weight: 800;
  word-spacing: -0.15em;
}

.playful figure p {
  font-size: 18px;
  font-weight: 100;
  color: #fff;
  letter-spacing: 1px;
}

.playful figure h2,
.playful figure p {
  margin: 0;
}

.playful figure.softeffect {
  background: none repeat scroll 0 0 #000000;
}

.playful figure.softeffect img {
  transition: opacity .35s ease 0s, transform .35s ease 0s;
}

figure.softeffect:hover img {
  opacity: 0.35;
  transform: scale(1);
}

.playful figure.softeffect figcaption:before,
.playful figure.softeffect p {
  opacity: 0;
  transition: opacity 0.35s ease 0s, transform 0.35s ease 0s;
}

.playful figure.softeffect h4 {
  opacity: 0;
  padding: 20% 0 20px;
  transition: opacity 0.35s ease 0s, transform 0.35s ease 0s;
}

.playful figure.softeffect p {
  margin: 0 auto;
  max-width: 200px;
  transform: scale(1.5);
}

.playful figure.softeffect:hover figcaption:before,
.playful figure.softeffect:hover p {
  opacity: 1;
  transform: scale(1);
}

.playful figure.softeffect:hover h4 {
  opacity: 1;
  transform: scale(1);
}

.playful figure img {
  display: block;
  max-width: 100%;
  min-height: 100%;
  opacity: 1;
  position: relative;
}

figure.softeffect {
  background: none repeat scroll 0 0 transparent;
}

figure.softeffect:hover {
  background: none repeat scroll 0 0 #000000;
  /* Cyan: #00aeef */
}

figure.softeffect img {
  transform: scale(1);
  transition: opacity .35s ease 0s, transform .35s ease 0s;
}

figure.softeffect:hover img {
  opacity: 0.40;
  transform: scale(1.15);
  filter: blur(2px);
}
</style>
<body>

<?php $this->load->view('user/partisi/navbar.php') ?>

<main id="main">
<?php echo $content; ?>
</main>

<?php $this->load->view('user/partisi/footer.php') ?>
<?php $this->load->view('user/partisi/js.php') ?>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

</body>

</html>