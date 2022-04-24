<?php

session_start();

if(!isset($_SESSION['loggedin'])){
  echo('Vous devez vous connecter dabord!');
  header('refresh:2;url=Connection.php');
  exit();
}

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Mon Compte</title>
  <link href="style/home.css" rel="stylesheet" type="text/css">
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
  <script src='https://use.fontawesome.com/releases/v5.0.8/js/all.js'></script>
</head>
</head>

<body class="sidebar-is-reduced">

  <div class="logoutbtn"><a href="logout.php"><button>Déconnection</button></a></div>


</body>

<h1 class="page-title">Compte Epitech</h1>
<div class="page-content">Bienvenue, <em>
    <?=$_SESSION['name']?>
  </em></div>



<!-- partial -->

<script>
  let Dashboard = (() => {
    let global = {
      tooltipOptions: {
        placement: "right"
      },

      menuClass: ".c-menu"
    };


    let menuChangeActive = el => {
      let hasSubmenu = $(el).hasClass("has-submenu");
      $(global.menuClass + " .is-active").removeClass("is-active");
      $(el).addClass("is-active");

      // if (hasSubmenu) {
      // 	$(el).find("ul").slideDown();
      // }
    };

    let sidebarChangeWidth = () => {
      let $menuItemsTitle = $("li .menu-item__title");

      $("body").toggleClass("sidebar-is-reduced sidebar-is-expanded");
      $(".hamburger-toggle").toggleClass("is-opened");

      if ($("body").hasClass("sidebar-is-expanded")) {
        $('[data-toggle="tooltip"]').tooltip("destroy");
      } else {
        $('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
      }

    };

    return {
      init: () => {
        $(".js-hamburger").on("click", sidebarChangeWidth);

        $(".js-menu li").on("click", e => {
          menuChangeActive(e.currentTarget);
        });

        $('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
      }
    };

  })();

  Dashboard.init();
</script>

</body>

</html>