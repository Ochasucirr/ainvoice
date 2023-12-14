<!-- Halaman Landing Page -->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSS -->
    <linkhref="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css"rel="stylesheet"/>
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/landingpage.css" />
    <!-- Icon nya judul -->

    
    <!-- Judul halaman -->
    <!-- Mengambil dari controller  -->
    <title><?= $title; ?></title>
  </head>
  <body>

<!-- Navbar  -->
<nav>
  <div class="nav__logo">AInvoice</div>
    <ul class="nav__links">
      <li class="link"><a href="#home">HOME</a></li>
      <li class="link"><a href="#about">ABOUT</a></li>
      <li class="link"><a href="#jobdesc">JOBDESC</a></li>
    </ul>
  <a href="<?= base_url('auth/'); ?>"><button class="btn" style="font-weight: bold;">LOGIN</button></a>
</nav>
<br>
<!-- Home -->
<section id="home">
  <header class="section__container header__container">
    <h1 class="section__header">PROCUREMENT EFISHERY<br /></h1>
    <center>
    <h2>Departemen strategic sourcing, dalam unit bisnis procurement<br />yang bertanggung jawab kepada procurement manager</h2>
    <!-- spasi -->
    <br />
    <a href="#about"><button class="btn" style="font-weight: bold;">ABOUT</button></a>
    <!-- gambar home -->
    <img class="feeder" src="<?= base_url('assets/'); ?>img/header.png" alt="header" /></center>
  </header>
</section>

<!-- About -->
<section id="about" class="section__container booking__container">
    <div class="booking__nav">
      <span class="section__header" style="font-weight: bold;">About</span>
      
    </div>
    <div>
    <!-- Struktur Organisasi -->
    <img src="<?= base_url('SO.png'); ?>">
    </div>

</section>

<!-- Job Description -->
<section id="jobdesc" class="subscribe">
  <div class="section__container subscribe__container">
    <h2 class="section__header">Job Description</h2>
  </div>
</section>
<section class="memories">
    <div class="section__container">
    <div class="memories__grid">

    <?php $i = 1; ?>
     <?php foreach ($datadivisi as $dd) : ?>

        <!-- Card Jobdesc -->
          <div class="memories__card">
          <img src="<?= base_url('assets/img/admin/') . $dd['gambar']; ?>" class="card-img" style="width: 270px; height:210px;">
            <h4><?= $dd['judul_jobdesc']; ?></h4>
            <p>
            <?= $dd['deskripsi']; ?>
            </p>
          </div>

      <?php $i++ ?>
    <?php endforeach; ?>
      
    </div>
  </div>
  <br><br>
</section>

<div class="keempat">
<div id="particles-js"></div>
  <script type="text/javascript" src="particles.js"></script>
  <script type="text/javascript" src="app.js"></script>
</div>
</div>

<!-- Activity Procurement -->
<section class="subscribe1">
  <div class="section__container">
    <center><h2 class="section__header_baru">Location eFishery</h2></center>
    
    <!-- Maps -->
    <br>
    <div class="maps">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.2385451121186!2d107.6333658748956!3d-6.861989667135588!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e77f69edf551%3A0x14c495539fc36585!2seFishery%20Head%20Office!5e0!3m2!1sid!2sid!4v1691650244772!5m2!1sid!2sid" width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    
    <!-- Aktifitas Procurement -->
  <br><br>
  </div>
</section>

<!-- Footer -->
<footer class="footer">
      <div class="section__container footer__container">
        <div class="footer__col">
          <h3>AInvoice</h3>
          <p>
            AInvoice (automation invoice) merupakan aplikasi yang dibangun
            untuk memudahkan procurement staff membuat invoice secara otomatis
            khususnya pada TRX B2C Agen PT Multidaya Teknologi Nusantara (eFishery)
          </p>
        </div>
        <div class="footer__col">
          <h4>INFORMATION</h4>
          <a href="#home"><p>Home</p></a> 
          <a href="#about"><p>About</p></a>
          <a href="#jobdesc"><p>Jobdesc</p></a>
        </div>
        <div class="footer__col">
          <h4>CONTACT</h4>
          <p>Support</p>
          <p>Media</p>
          <p>Socials</p>
        </div>
      </div>
      <div class="section__container footer__bar">
        <br>
        <h5>Copyright © PT Multidaya Teknologi Nusantara (eFishery) <?= date('Y'); ?></h5>
        <div class="socials">
          <span><a href=""><i class="ri-facebook-fill"></i></a></span>
          <span><a href=""><i class="ri-twitter-fill"></i></a></span>
          <span><a href=""><i class="ri-instagram-line"></i></a></span>
          <span><a href=""><i class="ri-youtube-fill"></i></a></span>
        </div>
      </div>
</footer>

  </body>
</html>
