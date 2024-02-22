<!-- Footer -->
<footer class="text-light text-lg-start mt-4" style="background-color: #1f3984">
  <!-- Grid container -->
  <div class="container-fluid p-4 text-footer" style="width: 70%">
    <!--Grid row-->
    <div class="row">
      <!--Grid column-->
      <div class="col-md-12 col-lg-5">
        <h6 class="text-uppercase">
          DIREKTORAT PEPPD
          <br />KEMENTERIAN PPN/BAPPENAS
        </h6>
        <p>
          Gedung Bappenas Lantai 9 Jl. H.R. Rasuna Said Kuningan, Setiabudi
          Jakarta Selatan 12950
          <br />
          <b>Email : </b>dit.peppd@bappenas.go.id
          <br />
          <!-- <b>Email 2 : </b>ppd@bappenas.go.id -->
          <b>Telp : </b>021-50927413
        </p>
      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-md-12 col-lg-7 col-footer-2">
        <!-- <div class="row row-footer-menu">
              <ul class="list-unstyled list-inline my-2">
                <li class="list-inline-item">
                  <a href="#!" class="text-light text-right">BERANDA</a>
                </li>
                <li class="list-inline-item">
                  <a href="#!" class="text-light">PEDOMAN</a>
                </li>
                <li class="list-inline-item">
                  <a href="#!" class="text-light">PUBLIKASI</a>
                </li>
                <li class="list-inline-item">
                  <a href="#!" class="text-light">KEGIATAN</a>
                </li>
                <li class="list-inline-item">
                  <a href="#!" class="text-light">APLIKASI KAMI</a>
                </li>
                <li class="list-inline-item">
                  <a href="#!" class="text-light">HUBUNGI KAMI</a>
                </li>
              </ul>
            </div> -->
        <div class="row row-footer-social-media">
          <ul class="list-unstyled list-inline my-2 text-left">
            <li class="list-inline-item">
              <a href="https://www.bappenas.go.id/id/" target="_blank" rel="noopener" class="text-light">BAPPENAS RI</a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.youtube.com/channel/UCj4_ZZiINMVsvIFh7U76LFg" target="_blank" rel="noopener"
                class="text-light">
                <i class="fa fa-youtube" aria-hidden="true"></i>
                YOUTUBE
              </a>
            </li>
            <li class="list-inline-item">
              <a href="https://www.instagram.com/dit.peppdbappenas/?igshid=70wk1y0qlcm4" target="_blank" rel="noopener"
                class="text-light">
                <i class="fa fa-instagram" aria-hidden="true"></i>
                INSTAGRAM
              </a>
            </li>
          </ul>
        </div>
      </div>
      <!--Grid column-->
    </div>
    <!--Grid row-->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
    PEPPD © 2021 -
    <?php echo date("Y"); ?> Copyright
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->

<script src="https://cdn.jsdelivr.net/npm/intro.js@7.2.0/intro.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/owlcarousel2/docs/assets/vendors/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/owlcarousel2/docs/assets/owlcarousel/owl.carousel.js"></script>
<script>
  var owl = $('.owl-carousel');
  owl.owlCarousel({
    dots: false,
    margin: 10,
    responsiveClass: true,
    responsive: {
      0: {
        items: 1,
        loop: true
      },
      600: {
        items: 2,
        loop: true
      },
      1000: {
        items: 3,
        loop: true
      }
    },
    autoplay: true,
    autoplayTimeout: 1500,
    autoplayHoverPause: true

  });
  $('.play').on('click', function () {
    owl.trigger('play.owl.autoplay', [1000])
  })
  $('.stop').on('click', function () {
    owl.trigger('stop.owl.autoplay')
  })
</script>
<script>
  $(window).resize(function () {
    if ($(window).width() >= 992) {
      $(".dekstop-screen-lg-8").addClass("col-lg-8");
      $(".dekstop-screen-lg-4").addClass("col-lg-4");
    } else {
      $(".dekstop-screen-lg-8").removeClass("col-lg-8");
      $(".dekstop-screen-lg-4").removeClass("col-lg-4");
    }
  });
</script>

<!-- <script>
      window.addEventListener("scroll", (event) => {
        let scrollY = this.scrollY;
        console.log(scrollY);
        if (scrollY >= 860) {
          // console.log("sticky");
          // $("#search-box").css({
          //   "position": "sticky",
          //   "top": "0";
          // });
          document.getElementById("search-box").style.position = "sticky";
          document.getElementById("search-box").style.top = "20px";
          document.getElementById("search-box").style.marginRight = "0";
        } else {
          document.getElementById("search-box").style.position = "fixed";
          document.getElementById("search-box").style.width = "auto";
          document.getElementById("search-box").style.top = "110px";
          document.getElementById("search-box").style.marginRight = "75px";
        }
      });
    </script> -->
</body>

</html>