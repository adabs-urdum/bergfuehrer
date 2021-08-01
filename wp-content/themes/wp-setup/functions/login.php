<?php
  function my_login_logo_url() {
      return 'https://adabs.ch';
  }
  add_filter( 'login_headerurl', 'my_login_logo_url' );

  function my_login_logo_url_title() {
      return 'Your Site Name and Info';
  }
  add_filter( 'login_headertext', 'my_login_logo_url_title' );
