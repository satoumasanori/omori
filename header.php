<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>omori</title>
  <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/top.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/base_style.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/responsive.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/hamburger.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/customize.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/eventcard.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/slide.css">
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>

<body>
  <header>
    <div class="header-content">
      <div class="logo">
        <a href="<?php echo home_url(); ?>#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.png" alt=""></a>
      </div>
        <div class="sp-logo">
        <a href="<?php echo home_url(); ?>#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/sp-logo.png" alt=""></a>
      </div>
      <div class="hamburger-menu">
        <span class="hamburger-line blue"></span>
        <span class="hamburger-line pink"></span>
        <span class="hamburger-text">MENU</span>
      </div>
      <div class="menu" >
        <a href="<?php echo home_url(); ?>#event">
          <div class="menu-item-ele">
          <div class="menu-item-ele-up">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/header/Group 63.png" class="menu-item-ele-icon"></img>
            <p>大森のイベント</p>
          </div>
          <div class="menu-item-ele-down">
            <p>• EVENT</p>
          </div>
        </div>
        </a>
        <a href="<?php echo home_url(); ?>#quiz">
        <div class="menu-item-ele" id>
          <div class="menu-item-ele-up">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/header/Group 64.png" class="menu-item-ele-icon"></img>
            <p>今日の質問</p>
          </div>
          <div class="menu-item-ele-down">
            <p>• QUIZ</p>
          </div>
        </div>
        </a>
        <a href="<?php echo home_url(); ?>#platforms">
        <div class="menu-item-ele">
          <div class="menu-item-ele-up">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/header/Group 65.png" class="menu-item-ele-icon"></img>
            <p>大森ナレッジバンク</p>
          </div>
          <div class="menu-item-ele-down">
            <p>• PLATFORMS</p>
          </div>
        </div>
        </a>
        <a href="<?php echo home_url(); ?>#picture">
        <div class="menu-item-ele">
          <div class="menu-item-ele-up">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/header/Group 66.png" class="menu-item-ele-icon"></img>
            <p>大森図鑑</p>
          </div>
          <div class="menu-item-ele-down">
            <p>• PICTURE BOOK</p>
          </div>
        </div>
        </a>
        <a href="<?php echo home_url(); ?>#history">
        <div class="menu-item-ele">
          <div class="menu-item-ele-up">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/header/Group 67.png" class="menu-item-ele-icon"></img>
            <p>大森の歴史</p>
          </div>
          <div class="menu-item-ele-down">
            <p>• HISTORY</p>
          </div>
        </div>
        </a>
        <a href="<?php echo home_url(); ?>#ofc">
        <div class="menu-item-ele">
          <div class="menu-item-ele-up">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/header/Group 68.png" class="menu-item-ele-icon"></img>
            <p>OFCとは</p>
          </div>
          <div class="menu-item-ele-down">
            <p>• OFC</p>
          </div>
        </div>
        </a>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/contact.png" class="btn-contact" alt="">
      </div>
    </div>
  </header>