<!doctype html>
<!-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> -->
<html>

<head>

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-0M5J29J5Y3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-0M5J29J5Y3');
  </script>

  <meta charset="utf-8">
  <meta name="description" content="Website Resmi Direktorat PEPPD Kementerian PPN/Bappanes">
  <meta name="keywords"
    content="PEPPD, direktorat PEPPD, Bappenas, Pemantauan Evaluasi Pengendalian Pembangunan Daerah">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Direktorat PEPPD Bappenas">

  <!-- CSRF Token -->
  <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->

  <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/img/favicon-bappenas.ico" type="image/x-icon">

  <title>
    Kementerian PPN/BAPPENAS :: Pemantauan Evaluasi, Dan Pengendalian Pembangunan Daerah
  </title>

  <!-- Bootstrap CSS -->
  <link href="<?= base_url(); ?>assets/assets/bootstrap-4.6.0-dist/css/bootstrap.min.css" rel="stylesheet"
    type="text/css" />

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
    type="text/css" />

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet"
    type="text/css" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Hind+Madurai:wght@500;600&family=Varela+Round&display=swap"
    rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Monda:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intro.js@7.2.0/minified/introjs.min.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">


  <link rel="stylesheet"
    href="<?= base_url() ?>assets/plugins/owlcarousel2/docs/assets/owlcarousel/assets/owl.carousel.min.css">
  <link rel="stylesheet"
    href="<?= base_url() ?>assets/plugins/owlcarousel2/docs/assets/owlcarousel/assets/owl.theme.default.min.css">

  <!-- Zircosadmin asset -->
  <!-- <link href="<?= base_url(); ?>assets/zircosadmin/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
  <!-- <link href="<?= base_url(); ?>assets/zircosadmin/assets/css/core.css" rel="stylesheet" type="text/css" /> -->
  <!-- <link href="<?= base_url(); ?>assets/zircosadmin/assets/css/components.css" rel="stylesheet" type="text/css" /> -->
  <!-- <link href="<?= base_url(); ?>assets/zircosadmin/assets/css/icons.css" rel="stylesheet" type="text/css" /> -->
  <!-- <link href="<?= base_url(); ?>assets/zircosadmin/assets/css/pages.css" rel="stylesheet" type="text/css" /> -->
  <!-- <link href="<?= base_url(); ?>assets/zircosadmin/assets/css/menu.css" rel="stylesheet" type="text/css" /> -->
  <!-- <link href="<?= base_url(); ?>assets/zircosadmin/assets/css/responsive.css" rel="stylesheet" type="text/css" /> -->

  <!-- <script src="<?= base_url(); ?>assets/zircosadmin/assets/js/modernizr.min.js"></script> -->
  <!-- End zircosadmin asset -->

  <!-- Animate Style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <!-- End Animate Style -->

  <!-- Maps API -->
  <script src="https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.js"></script>
  <link href="https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.css" rel="stylesheet" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  
  <!-- End Maps API -->

  <!-- style -->
  <style>
    
    @media (max-width: 575px) {
      .dekstop {
        display: none !important;
      }

      .mobile {
        display: block !important;
      }

      .card-infograph {
        margin: 0 5px 1px 2px;
        height: 360px;
        border-radius: 10px;
        border: 1px solid black;
      }

      .card-image {
        width: 50%;
      }

      .row-infograph {
        overflow-x: none;
        flex-wrap: nowrap;
        font-family: 'Monda', sans-serif;
      }

      .card-infograph {
        margin: 0 5px 3px 2px;
        height: 225px;
        border-radius: 10px;
        border: 1px solid black;
      }

      .infograph-title-text {
        font-family: 'Monda', sans-serif;
        font-size: 10px;
        text-align: center;
        line-height: 1;
      }

      .infograph-body-text {
        display: flex;
        font-size: 9px;
        align-items: center;
      }

      .button-detail-infograph {
        margin-top: 0.5rem;
        font-size: 0.7rem;
        background-color: #0D4A82;
        color: white;
        border: 1px solid black;
        transition: all 300ms ease;
        padding: 0.5% 10%;
      }

      .button-detail-infograph:hover {
        background-color: white;
        color: black;
        text-decoration: none;
      }

      .card-activity {
        height: 8rem;
        padding-top: 0px;
      }


      .card-text {
        font-size: 0.8rem;
      }

      .card-text-activity {
        text-align: center;
        font-size: 0.8rem;
      }

      .box-img-activity {
        padding: 0;
      }

      .text-activity {
        font-size: 0.5rem;
        font-weight: 600;
      }

      .img-news {
        height: 10rem;
      }

      .title-news {
        font-size: 0.7rem;
      }

      .text-news {
        font-size: 0.5rem;
      }

      .img-publication {
        height: 11rem;
        width: 8rem;
      }

      .text-footer {
        font-size: 0.5rem;
      }

      .col-footer-2 {
        padding-left: 12%;
      }
    }

    @media(min-width: 360px) {
      .card-infograph {
        margin: 0 5px 1px 2px;
        height: 275px;
        border-radius: 10px;
        border: 1px solid black;
      }
    }

    @media(min-width: 375px) {
      .dekstop {
        display: none !important;
      }

      .mobile {
        display: block !important;
      }

      .card-infograph {
        margin: 0 5px 1px 2px;
        height: 275px;
        border-radius: 10px;
        border: 1px solid black;
      }

      .card-activity {
        height: 12rem;
        padding-top: 0px;
      }

      .text-activity {
        font-size: 0.65rem;
        font-weight: 600;
      }

      .img-publication {
        height: 19rem;
        width: 14rem;
      }
    }

    @media (min-width: 575px) {
      .dekstop {
        display: none !important;
      }

      .mobile {
        display: block !important;
      }

      .card-text {
        font-size: 0.8rem;
      }

      .card-text-activity {
        text-align: center;
        font-size: 0.8rem;
      }


      .card-infograph {
        margin: 0 5px 3px 2px;
        height: 300px;
        border-radius: 10px;
        border: 1px solid black;
      }

      .infograph-title-text {
        font-family: 'Monda', sans-serif;
        font-size: 14px;
        text-align: center;
      }

      .infograph-body-text {
        display: flex;
        font-size: 13px;
        align-items: center;
      }

      .button-detail-infograph {
        margin-top: 0.5rem;
        font-size: 0.7rem;
        background-color: #0D4A82;
        color: white;
        border: 1px solid black;
        transition: all 300ms ease;
        padding: 0.5% 10%;
      }

      .button-detail-infograph:hover {
        background-color: white;
        color: black;
        text-decoration: none;
      }


      .card-activity {
        height: 13rem;
        padding-top: 0px;
      }

      .text-activity {
        font-size: 1rem;
        font-weight: 600;
      }

      .img-publication {
        height: 19rem;
        width: 14rem;
      }

      .text-footer {
        font-size: 0.5rem;
      }

      .card-image {
        width: 40%;
      }

      .col-footer-2 {
        padding-left: 8%;
      }
    }

    @media (min-width: 768px) {
      .dekstop {
        display: none !important;
      }

      .mobile {
        display: block !important;
      }

      .card-infograph {
        margin: 0 5px 1px 2px;
        height: 215px;
        border-radius: 10px;
        border: 1px solid black;
      }

      .row-infograph {
        overflow-x: none;
        flex-wrap: nowrap;
        font-family: 'Monda', sans-serif;
      }

      .card-infograph {
        margin: 0 5px 3px 2px;
        height: 280px;
        border-radius: 10px;
        border: 1px solid black;
      }

      .infograph-title-text {
        font-family: 'Monda', sans-serif;
        font-size: 14px;
        text-align: center;
      }

      .card-image {
        width: 50%;
      }

      .infograph-body-text {
        display: flex;
        font-size: 14px;
        align-items: center;
      }

      .button-detail-infograph {
        margin-top: 0.5rem;
        font-size: 0.7rem;
        background-color: #0D4A82;
        color: white;
        border: 1px solid black;
        transition: all 300ms ease;
        padding: 0.5% 10%;
      }

      .button-detail-infograph:hover {
        background-color: white;
        color: black;
        text-decoration: none;
      }

      .card-activity {
        height: 9rem;
        padding-top: 0px;
      }

      .card-text {
        font-size: 0.8rem;
      }

      .card-text-activity {
        text-align: center;
        font-size: 0.8rem;
      }

      .box-img-activity {
        padding: 0;
      }

      .text-activity {
        font-size: 0.5rem;
        font-weight: 600;
      }

      .img-news {
        height: 9rem;
      }

      .title-news {
        font-size: 0.75rem;
      }

      .text-news {
        font-size: 0.6rem;
      }

      .img-publication {
        height: 13rem;
        width: 9rem;
      }

      .text-footer {
        font-size: 0.6rem;
      }

      .row-footer-menu {
        float: left;
      }

      .row-footer-social-media {
        float: left;
      }

      .col-footer-2 {
        padding-left: 6%;
      }
    }

    @media (min-width: 992px) {
      .dekstop {
        display: block !important;
      }

      .mobile {
        display: none !important;
      }

      .navbar {
        font-size: 0.7rem;
      }

      .row-infograph {
        overflow-x: none;
        flex-wrap: nowrap;
        font-family: 'Monda', sans-serif;
      }

      .card-infograph {
        margin: 0 5px 3px 2px;
        height: 300px;
        border-radius: 10px;
        border: 1px solid black;
      }

      .infograph-title-text {
        font-family: 'Monda', sans-serif;
        font-size: 14px;
        text-align: center;
      }

      .infograph-body-text {
        display: flex;
        font-size: 13px;
        align-items: center;
      }

      .button-detail-infograph {
        margin-top: 0.5rem;
        font-size: 0.7rem;
        background-color: #0D4A82;
        color: white;
        border: 1px solid black;
        transition: all 300ms ease;
        padding: 0.5% 10%;
      }

      .button-detail-infograph:hover {
        background-color: white;
        color: black;
        text-decoration: none;
      }


      .card-activity {
        height: 6rem;
        padding-top: 0px;
      }

      .text-activity {
        font-size: 0.65rem;
        font-weight: 500;
      }

      .box-icon-activity {
        padding: 10px;
        padding-left: 20px;
      }

      .box-text-activity {
        padding-top: 17px;
        padding-right: 23px;
      }

      .img-news {
        height: 10rem;
      }

      .title-news {
        font-size: 0.8rem;
      }

      .text-news {
        font-size: 0.6rem;
      }

      .img-publication {
        height: 11rem;
        width: 7.5rem;
      }

      .text-footer {
        font-size: 0.55rem;
      }

      .row-footer-menu {
        float: right;
      }

      .row-footer-social-media {
        float: right;
      }
    }

    @media (min-width: 1024px) {
      .text-activity {
        font-size: 0.65rem;
        font-weight: 500;
      }

      .card-infograph {
        margin: 0 5px 3px 2px;
        height: 350px;
        border-radius: 10px;
        border: 1px solid black;
      }

      .card-article:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, .12), 0 4px 8px rgba(0, 0, 0, .06);
      }


      .box-icon-activity {
        padding: 10px;
        padding-left: 25px;
      }

      .box-text-activity {
        padding-top: 15px;
        padding-right: 30px;
      }
    }

    @media (min-width: 1200px) {
      .dekstop {
        display: block !important;
      }

      .mobile {
        display: none !important;
      }

      .navbar {
        font-size: 0.9rem;
      }

      .card-infograph {
        margin: 0 5px 1px 2px;
        height: 285px;
        border-radius: 10px;
        border: 1px solid black;
      }

      .card-activity {
        height: 7rem;
      }

      .text-activity {
        font-size: 0.85rem;
        font-weight: 500;
      }

      .box-icon-activity {
        padding: 10px;
        padding-left: 30px;
      }

      .box-text-activity {
        padding-top: 20px;
        padding-right: 45px;
      }

      .box-img-news {
        display: flex;
        justify-content: center;
        transition: 0.5s all ease-in-out;
      }

      .box-img-news:hover {
        transform: scale(1.2);
      }

      .img-news {
        /* height: 11.5rem; */
        /* width: auto !important; */
      }

      .title-news {
        font-size: 1rem;
      }

      .text-news {
        font-size: 0.8rem;
      }

      .img-publication {
        height: 14.5rem;
        width: 11rem;
      }

      .text-footer {
        font-size: 0.7rem;
      }

      .row-footer-menu {
        float: right;
      }

      .row-footer-social-media {
        float: right;
      }
    }

    @media(min-width: 1330px) {

      .card-infograph {
        margin: 0 5px 1px 2px;
        height: 210px;
        border-radius: 10px;
        border: 1px solid black;
      }

      .card-activity {
        height: 8.5rem;
        padding-top: 0px;
      }

      .card-infograph {
        margin: 0 5px 3px 2px;
        height: 280px;
        border-radius: 10px;
        border: 1px solid black;
      }

      .text-activity {
        margin-top: 15px;
        font-size: 0.9rem;
        font-weight: 500;
      }

      .box-icon-activity {
        padding: 10px;
        padding-left: 30px;
      }

      .box-text-activity {
        padding-top: 20px;
        padding-right: 40px;
      }

      .card-text {
        font-size: 0.8rem;
      }
      

      .card-text-activity {
        text-align: center;
        font-size: 0.8rem;
      }
    }

    @media (min-width: 1550px) {
      .card-infograph {
        margin: 0 5px 3px 2px;
        height: 280px;
        border-radius: 10px;
        border: 1px solid black;
      }

      .infograph-title-text {
        font-family: 'Monda', sans-serif;
        font-size: 14px;
        text-align: center;
      }

      .infograph-body-text {
        display: flex;
        font-size: 14px;
        align-items: center;
      }

      .card-activity {
        height: 8rem;
        padding-top: 0px;
      }

      .text-activity {
        margin-top: 4px;
        font-size: 0.9rem;
        font-weight: 600;
      }

      .box-icon-activity {
        padding: 10px;
        padding-left: 60px;
      }

      .box-text-activity {
        padding-top: 40px;
        padding-right: 50px;
      }
    }

    @media (min-width: 1800px) {
      .card-activity {
        height: 10rem;
        padding-top: 0px;
      }

      .text-activity {
        font-size: 1rem;
        font-weight: 600;
      }

      .box-icon-activity {
        padding: 10px;
        padding-left: 70px;
      }

      .box-text-activity {
        padding-top: 40px;
        padding-right: 50px;
      }
    }

    section {
      margin-top: 1rem;
    }

    .navbar {
      font-family: "Open Sans", sans-serif;
      font-weight: 600;
      line-height: 18px;
      color: #0d4a82;
    }

    .card {
      font-family: Arial, Helvetica, sans-serif;
      font-weight: 400;
      font-size: 12px;
      color: #0d4a82;
    }

    .card-activity-menu {
      height: 15rem;
    }

    .text-activity-menu {
      font-size: 0.9rem;
    }

    .card-activity {
      border: none;
      background: white;
      color: black;
      padding: 10px;
      font-size: 16px;
      border: black solid 1px;
      border-radius: 5px;
      position: relative;
      box-sizing: border-box;
      transition: all 500ms ease;
    }

    /* Ghost Button */
    .card-activity:hover {
      color: white;
      border: white solid 1px;
      background: #1f3984;
    }

    .infograph-more {
      min-width: 80px;
      min-height: 80px;
      border-radius: 100%;
      border: 1px solid black;
      align-self: center;
    }

    .infograph-more:hover {
      color: white;
      border: white solid 1px;
      background: #1f3984;
    }

    .img-application {
      position: relative;
    }

    .img-application a {
      position: absolute;
      top: 0;
      bottom: 0;
      right: 0;
      left: 0;
      background-color: rgba(0, 0, 0, 0.3);
      opacity: 0;
      transition: opacity 0.3s;
    }

    .img-application a:hover {
      opacity: 1;
    }

    .img-publication-box {
      position: relative;
    }

    .img-publication-box a {
      position: absolute;
      top: 0;
      bottom: 0;
      right: 0;
      left: 0;
      background-color: rgba(0, 0, 0, 0.3);
      opacity: 0;
      transition: opacity 0.3s;
    }

    .img-publication-box a:hover {
      opacity: 1;
    }

    .icon-message-delete {
      color: transparent;
    }

    .icon-message-delete:hover {
      color: red;
    }

    .icon-message-reply {
      color: transparent;
    }

    .icon-message-reply:hover {
      color: blue;
    }

    footer {
      font-family: Arial, Helvetica, sans-serif;
      font-weight: 400;
      font-size: 12px;
      color: #0d4a82;
    }

    .logoBar {
      display: none !important;
    }

    .button-read-more {
      margin-top: 0.5rem;
      font-size: 0.7rem;
      background-color: #0D4A82;
      color: white;
      border: 1px solid black;
      padding: 0.5% 1.5%;
      transition: all 300ms ease;
    }

    .button-read-more:hover {
      background-color: white;
      color: black;
      text-decoration: none;
    }

    .btn-download-publication {
      padding: 0.5% 1.5%;
      border: 1px solid black;
      border-radius: 0px;
      background-color: #0D4A82;
      margin-top: 5px;
      font-size: 0.9rem;
      width: -webkit-fill-available;
      color: white;
      transition: all 300ms ease;
      text-align: center;
    }

    .btn-download-publication:hover {
      background-color: white;
      color: black;
      text-decoration: none;
    }

    .btn-download-publication:hover .page-hint-unduh-publikasi {
      background-color: black;
      color: white;
    }

    mark {
      line-height: 2.3rem;
    }

    #menuSearch>.card-body {
      border: 1px solid black;
    }

    #menuSearch:hover {
      background-color: #0D4A82;
    }

    #menuSearch>.card-body:hover {
      border: 1px solid white;
      color: white;
    }

    #menuFile>.card-body {
      border: 1px solid black;
    }

    #menuFile>.card-body:hover {
      background-color: #0D4A82;
      border: 1px solid black;
      color: white;
    }

    /* infograph page start */

    /**
* Set rules for how the map overlays
* (information box and legend) will be displayed
* on the page. */
    .map-overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      background: #fff;
      margin-left: 20px;
      font-family: Arial, sans-serif;
      border-radius: 3px;
      padding-left: 3px;
      padding-right: 3px;
      box-shadow: 0 0 0 2px rgb(0 0 0 / 10%);
    }

    #features {
      top: 0;
      height: 20px;
      margin-top: 20px;
    }

    .map-legend {
      position: absolute;
      bottom: 0;
      left: 0;
      background: #fff;
      margin-left: 20px;
      font-family: Arial, sans-serif;
      border-radius: 3px;
      padding-left: 3px;
      padding-right: 3px;
      box-shadow: 0 0 0 2px rgb(0 0 0 / 10%);
      height: 40px;
      width: 100px;
    }

    .map-description {
      position: absolute;
      bottom: 0;
      right: 0;
      background: #fff;
      margin-right: 20px;
      font-family: Arial, sans-serif;
      border-radius: 3px;
      padding-left: 3px;
      padding-right: 3px;
      box-shadow: 0 0 0 2px rgb(0 0 0 / 10%);
      height: 40px;
      width: 100px;
    }

    /* infograph end */

    /* #menuFile:hover {
      background-color: #0D4A82;
    } */

    /* .publication-scroll::-webkit-scrollbar {
      width: 70px;
      display: none;
    } */

    .buttons-indikator:hover {
      background-color: #c4c4c4;
    }

    .buttons-indikator-2:hover {
      background-color: #c4c4c4;
    }

    .button-change-chart:hover {
      background-color: #c4c4c4;
    }

    .highcharts-credits {
      display: none;
    }
  </style>
  <!-- End Style -->

  <!-- script -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="<?= base_url(); ?>assets/assets/bootstrap-4.6.0-dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

  <!-- Zircosadmin asset -->
  <!-- jQuery  -->
  <!-- <script src="<?= base_url(); ?>assets/zircosadmin/assets/js/jquery.min.js"></script> -->
  <!-- <script src="<?= base_url(); ?>assets/zircosadmin/assets/js/bootstrap.min.js"></script> -->
  <!-- <script src="<?= base_url(); ?>assets/zircosadmin/assets/js/detect.js"></script> -->
  <!-- <script src="<?= base_url(); ?>assets/zircosadmin/assets/js/fastclick.js"></script> -->
  <!-- <script src="<?= base_url(); ?>assets/zircosadmin/assets/js/jquery.blockUI.js"></script> -->
  <!-- <script src="<?= base_url(); ?>assets/zircosadmin/assets/js/waves.js"></script> -->
  <!-- <script src="<?= base_url(); ?>assets/zircosadmin/assets/js/jquery.slimscroll.js"></script> -->
  <!-- <script src="<?= base_url(); ?>assets/zircosadmin/assets/js/jquery.scrollTo.min.js"></script> -->

  <!-- Count down js -->
  <!-- <script src="<?= base_url(); ?>assets/zircosadmin/plugins/count-down/jquery.lwtCountdown-1.0.js"></script> -->

  <!-- App js -->
  <!-- <script src="<?= base_url(); ?>assets/zircosadmin/assets/js/jquery.core.js"></script> -->
  <!-- <script src="<?= base_url(); ?>assets/zircosadmin/assets/js/jquery.app.js"></script> -->
  <!-- End zircosadmin asset -->
  
  <script>introJs().start();</script>

</head>

<body style="background-color: #efefef">
  <div class="fixed-top">

    <div class="" style="background-color: #1f3984; color: white">
      <div class="container">
        <marquee behavior="scroll" direction="left" style="font-size: 14px; font-weight: 400; white-space: nowrap;">
          <span style="margin-right: 20%;">Direktorat Pemantauan, Evaluasi, dan Pengendalian Pembangunan
            Daerah&nbsp;&nbsp;&nbsp;Kementerian PPN/BAPPENAS</span>
          <a href="<?= base_url(); ?>news/<?php echo str_replace(" ", "-", $last_article[0]->slug); ?>"
            target="_blank"><span style="color: chartreuse; margin-right: 20%;"><i
                class="fa fa-exclamation-triangle"></i>
              <?php echo $last_article[0]->title; ?>
            </span></a>
          <a href="<?= base_url(); ?>file_publication/<?php echo str_replace(" ", "-", $last_guide[0]->name); ?>/<?php echo $last_guide[0]->file; ?>"
            target="_blank"><span style="color: springgreen; margin-right: 20%;"><i class="fa fa-book"></i>
              <?php echo $last_guide[0]->name; ?>
            </span></a>
        </marquee>
      </div>
    </div>

    <!-- <nav
        class="navbar navbar-expand-lg navbar-light bg-light shadow px-3 bg-white rounded"
        style="background-image: url({{ asset('images/img/bappenas_banner.png') }}); background-size: cover"
      > -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow px-3 bg-white rounded"
      style="background-image: url('<?= base_url(); ?>assets/images/img/bappenas_banner.png'); background-size: cover">
      <div class="container-fluid" style="width: 70%">
        <a class="navbar-brand" href="<?= base_url(); ?>"><img
            src="<?= base_url(); ?>assets/images/img/logo_bappenas_8.png" alt="LOGO-BAPPENAS" class="img-responsive"
            height="45" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a href="<?= base_url(); ?>" <?php echo ($this->uri->segment(1) == '' ? 'class="nav-link active"' : 'class="nav-link"'); ?>>Beranda</a>
            <a href="<?= base_url(); ?>news" <?php echo ($this->uri->segment(1) == 'news' ? 'class="nav-link active"' : 'class="nav-link"'); ?>>Berita</a>
            <a href="<?= base_url(); ?>publication" <?php echo ($this->uri->segment(1) == 'publication' ? 'class="nav-link active"' : 'class="nav-link"'); ?>>Publikasi</a>
            <a href="<?= base_url(); ?>kegiatan" <?php echo ($this->uri->segment(1) == 'kegiatan' ? 'class="nav-link active"' : 'class="nav-link"'); ?>>Kegiatan</a>
            <a href="<?= base_url(); ?>aplikasi" <?php echo ($this->uri->segment(1) == 'aplikasi' ? 'class="nav-link active"' : 'class="nav-link"'); ?>>Aplikasi</a>
            <a class="nav-link"
              href="https://docs.google.com/forms/d/e/1FAIpQLSfcACkyqgiSTD7QrSYHBXxg47xwenTZfi7ofACM598Kjg8Jzw/viewform?usp=pp_url"
              target="_blank" rel="noopener">Hubungi Kami</a>
            <!-- <a href="<?= base_url(); ?>karir" <?php echo ($this->uri->segment(1) == 'karir' ? 'class="nav-link active"' : 'class="nav-link"'); ?>>Karir</a> -->
          </div>
        </div>
      </div>
    </nav>

  </div>