<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Travolo - Travel Agency & Tour Booking HTML Template - Home One</title>
  <meta name="author" content="vecuro">
  <meta name="description" content="Travolo -  Travel Agency & Tour Booking HTML Template">
  <meta name="keywords" content="Travolo -  Travel Agency & Tour Booking HTML Template">
  <meta name="robots" content="INDEX,FOLLOW">

  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Favicons - Place favicon.ico in the root directory -->
  <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/favicons/favicon.png">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="theme-color" content="#ffffff">

  <!--==============================
      Google Fonts
  ============================== -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!--==============================
        All CSS File
    ============================== -->
  <!-- Bootstrap -->
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/css/app.min.css"> -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
  <!-- Fontawesome Icon -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fontawesome.min.css">
  <!-- Magnific Popup -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/magnific-popup.min.css">
  <!-- Slick Slider -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/slick.min.css">
  <!-- Theme Custom CSS -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>

<body>

  <!--********************************
    Code Start From Here 
    ******************************** -->

  <!--==============================
      Mobile Menu
    ============================== -->
  <div class="vs-menu-wrapper">
    <div class="vs-menu-area text-center">
      <button class="vs-menu-toggle"><i class="fal fa-times"></i></button>
      <div class="mobile-logo">
        <a href="index.html"><img src="assets/img/logo.svg" alt="Travolo"></a>
      </div>
      <div class="vs-mobile-menu">
        <ul>
          <li class="menu-item-has-children">
            <a href="index.html">Home</a>
            <ul class="sub-menu">
              <li><a href="index.html">Home One</a></li>
              <li><a href="index-2.html">Home Two</a></li>
              <li><a href="index-3.html">Home Three</a></li>
              <li><a href="index-4.html">Home Four</a></li>
              <li><a href="index-5.html">Home Five</a></li>
              <li><a href="index-6.html">Home Six</a></li>
            </ul>
          </li>
          <li class="menu-item-has-children">
            <a href="#">Destinations</a>
            <ul class="sub-menu">
              <li><a href="destinations.html">Destinations</a></li>
              <li><a href="destination-details.html">Destinations Details</a></li>
            </ul>
          </li>
          <li class="menu-item-has-children">
            <a href="#">Pages</a>
            <ul class="sub-menu">
              <li><a href="about.html">About Us</a></li>
              <li><a href="tours.html">Tours List</a></li>
              <li><a href="tour-booking.html">Tour Booking</a></li>
              <li><a href="destinations.html">Destinations</a></li>
              <li><a href="destination-details.html">Destinations Details</a></li>
              <li><a href="error.html">Error</a></li>
            </ul>
          </li>
          <li class="menu-item-has-children">
            <a href="#">Tours</a>
            <ul class="sub-menu">
              <li><a href="tours.html">Tours List</a></li>
              <li><a href="tour-booking.html">Tour Booking</a></li>
            </ul>
          </li>
          <li class="menu-item-has-children">
            <a href="#">Shop</a>
            <ul class="sub-menu">
              <li><a href="shop.html">Shop</a></li>
              <li><a href="shop-details.html">Shop Details</a></li>
              <li><a href="cart.html">Cart</a></li>
              <li><a href="checkout.html">Checkout</a></li>
            </ul>
          </li>
          <li class="menu-item-has-children">
            <a href="#">Blog</a>
            <ul class="sub-menu">
              <li><a href="blog.html">Blog List</a></li>
              <li><a href="blog-grid.html">Blog Grid</a></li>
              <li><a href="blog-details.html">Blog Details</a></li>
            </ul>
          </li>
          <li>
            <a href="contact.html">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!--==============================
      Popup Search Box
    ============================== -->
  <div class="popup-search-box d-none d-lg-block  ">
    <button class="searchClose"><i class="fal fa-times"></i></button>
    <form action="#">
      <input type="text" class="border-theme" placeholder="What are you looking for">
      <button type="submit"><i class="fal fa-search"></i></button>
    </form>
  </div>

  <!--==============================
      Header Area
    ==============================-->
  <header class="vs-header header-layout1">
    <div class="container">
      <div class="header-top">
        <div class="row justify-content-between align-items-center">
          <div class="col d-none d-lg-block">
            <ul class="header-contact">
              <li><i class="fas fa-envelope"></i> <a href="mailto:info@travolo.com">info@travolo.com</a>
              </li>
              <li><i class="fas fa-phone-alt"></i> <a href="tel:02073885619">020 7388 5619</a></li>
            </ul>
          </div>
          <div class="col-auto">
            <div class="header-social">
              <a href="#"><i class="fab fa-facebook-f"></i></a>
              <a href="#"><i class="fab fa-instagram"></i></a>
              <a href="#"><i class="fab fa-pinterest-p"></i></a>
              <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
          </div>
          <div class="col-auto d-flex ">
            <div class="header-dropdown">
              <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-bs-toggle="dropdown"
                aria-expanded="false">English</a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                <li>
                  <a href="#">German</a>
                  <a href="#">French</a>
                  <a href="#">Italian</a>
                  <a href="#">Latvian</a>
                  <a href="#">Spanish</a>
                  <a href="#">Greek</a>
                </li>
              </ul>
            </div>
            <a class="user-btn" href="sign-up.html"><i class="far fa-user-circle"></i></a>
          </div>
        </div>
      </div>
    </div>
    <div class="sticky-wrapper">
      <div class="sticky-active">
        <div class="container position-relative z-index-common">
          <div class="row align-items-center justify-content-between">
            <div class="col-auto">
              <div class="vs-logo">
                <a href="index.html"><img src="assets/img/logo.svg" alt="logo"></a>
              </div>
            </div>
            <div class="col text-end text-xl-center">
              <nav class="main-menu  menu-style1 d-none d-lg-block">
                <ul>
                  <li class="menu-item-has-children">
                    <a href="#">Home</a>
                    <ul class="sub-menu">
                      <li><a href="index.html">Home One</a></li>
                      <li><a href="index-2.html">Home Two</a></li>
                      <li><a href="index-3.html">Home Three</a></li>
                      <li><a href="index-4.html">Home Four</a></li>
                      <li><a href="index-5.html">Home Five</a></li>
                      <li><a href="index-6.html">Home Six</a></li>
                    </ul>
                  </li>
                  <li class="menu-item-has-children">
                    <a href="#">Destinations</a>
                    <ul class="sub-menu">
                      <li><a href="destinations.html">Destinations</a></li>
                      <li><a href="destination-details.html">Destinations Details</a></li>
                    </ul>
                  </li>
                  <li class="menu-item-has-children mega-menu-wrap">
                    <a href="#">Pages</a>
                    <ul class="mega-menu">
                      <li>
                        <a href="shop.html">Pagelist 1</a>
                        <ul>
                          <li><a href="index.html">Home One</a></li>
                          <li><a href="index-2.html">Home Two</a></li>
                          <li><a href="index-3.html">Home Three</a></li>
                          <li><a href="index-4.html">Home Four</a></li>
                          <li><a href="index-5.html">Home Five</a></li>
                          <li><a href="index-6.html">Home Six</a></li>
                        </ul>
                      </li>
                      <li>
                        <a href="#">Pagelist 2</a>
                        <ul>
                          <li><a href="about.html">About Us</a></li>
                          <li><a href="destinations.html">Destinations</a></li>
                          <li><a href="destination-details.html">Destinations Details</a></li>
                          <li><a href="tours.html">Tours List</a></li>
                          <li><a href="tour-booking.html">Tour Booking</a></li>
                        </ul>
                      </li>
                      <li>
                        <a href="#">Pagelist 3</a>
                        <ul>
                          <li><a href="shop.html">Shop</a></li>
                          <li><a href="shop-details.html">Shop Details</a></li>
                          <li><a href="cart.html">Cart</a></li>
                          <li><a href="checkout.html">Checkout</a></li>
                          <li><a href="blog.html">Blog List</a></li>
                        </ul>
                      </li>
                      <li>
                        <a href="#">Pagelist 4</a>
                        <ul>
                          <li><a href="blog-grid.html">Blog Grid</a></li>
                          <li><a href="blog-details.html">Blog Details</a></li>
                          <li><a href="error.html">Error Page</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li class="menu-item-has-children">
                    <a href="#">Tours</a>
                    <ul class="sub-menu">
                      <li><a href="tours.html">Tours List</a></li>
                      <li><a href="tour-booking.html">Tour Booking</a></li>
                    </ul>
                  </li>
                  <li class="menu-item-has-children">
                    <a href="#">Shop</a>
                    <ul class="sub-menu">
                      <li><a href="shop.html">Shop</a></li>
                      <li><a href="shop-details.html">Shop Details</a></li>
                      <li><a href="cart.html">Cart</a></li>
                      <li><a href="checkout.html">Checkout</a></li>
                    </ul>
                  </li>
                  <li class="menu-item-has-children">
                    <a href="#">Blog</a>
                    <ul class="sub-menu">
                      <li><a href="blog.html">Blog List</a></li>
                      <li><a href="blog-grid.html">Blog Grid</a></li>
                      <li><a href="blog-details.html">Blog Details</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="contact.html">Contact</a>
                  </li>
                </ul>
              </nav>
              <button class="vs-menu-toggle d-inline-block d-lg-none"><i class="fal fa-bars"></i></button>
            </div>
            <div class="col-auto d-none d-xl-block">
              <div class="header-btns">
                <button class="searchBoxTggler"><i class="fal fa-search"></i></button>
                <button class="sideCartToggler"><i class="fal fa-shopping-bag"></i><span
                    class="button-badge">2</span></button>
                <button class="sideMenuToggler"><i class="fal fa-bars"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>