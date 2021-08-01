<?php

  // define the wp_mail_from callback
  function filter_wp_mail_from( $from_email ){
      return 'cyrill@adabs.ch';
  };
  add_filter( 'wp_mail_from', 'filter_wp_mail_from', 10, 1 );

  // define the wp_mail_from_name callback
  function filter_wp_mail_from_name( $from_name ){
      return 'Cyrill Lehmann';
  };
  add_filter( 'wp_mail_from_name', 'filter_wp_mail_from_name', 10, 1 );


  // define the wp_mail_original_content callback
  function filter_wp_mail_original_content( $content ){
      $header = '<h1>Header</h1>';
      $footer = '<h1>Footer</h1>';
      $table = '
        <html>
          <head>
            <style>
              body#emailbody{
                background: #eee;
              }
            </style>
          </head>
          <body id="emailbody">
            <table style="width:100%; border:none;">
              <thead>
                <tr>
                  <td style="width:5%;"></td>
                  <td style="width:90%; height:100px; background-color:#ffb700;">' . $header . '</td>
                  <td style="width:5%;"></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td style="width:5%;"></td>
                  <td style="width:90%; padding: 20px 0;">' . $content . '</td>
                  <td style="width:5%;"></td>
                </tr>
                <tr>
                  <td style="width:5%;"></td>
                  <td style="width:90%; padding: 20px 0;">' . $footer . '</td>
                  <td style="width:5%;"></td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td style="width:5%;"></td>
                  <td style="width:90%; border-top: solid #333 1px; padding:10px; text-align:center; vertical-align:middle;">
                    <p>Lehmann Webentwicklung – Kasernenstrasse 55 – 7000 Chur</p>
                  </td>
                  <td style="width:5%;"></td>
                </tr>
              </tfoot>
            </table>
          </body>
        </html>
      ';
      return $table;
  };
  add_filter( 'wp_mail_original_content', 'filter_wp_mail_original_content', 10, 1 );

    // <!-- Example of sending mail through filter -->
    // $to = 'cyrill@adabs.ch';
    // $subject = 'This is the subject line';
    // $message = '<h1>HTML Ipsum Presents</h1>
    //   <p><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. <em>Aenean ultricies mi vitae est.</em> Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, <code>commodo vitae</code>, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. <a href="#">Donec non enim</a> in turpis pulvinar facilisis. Ut felis.</p>
    //   <h2>Header Level 2</h2>
    //   <ol>
    //     <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
    //     <li>Aliquam tincidunt mauris eu risus.</li>
    //   </ol>
    //   <blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.</p></blockquote>
    //   <h3>Header Level 3</h3>
    //   <ul>
    //     <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
    //     <li>Aliquam tincidunt mauris eu risus.</li>
    //   </ul>
    //   <pre><code>
    //   #header h1 a {
    //     display: block;
    //     width: 300px;
    //     height: 80px;
    //   }
    //   </code></pre>';
    // $headers = ['Content-Type: text/html; charset=UTF-8'];
    // $message = apply_filters('wp_mail_original_content', $message);

    // wp_mail($to, $subject, $message, $headers);
