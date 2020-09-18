<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/6d51a6bb69.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Geostar&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Monoton&display=swap" rel="stylesheet">
    <link rel="icon" href="./img/mars.png">
    <title>Inversiones y Construcciones Suramérica</title>

  <style>

    #login-menu {
      right: 0 !important;
      left: auto !important;
      position: absolute !important;
    }
    body{
      font-family: 'Roboto', serif;
      background: url(img/planet.jpg);
      width: 100%;
      height: 90%;
      background-repeat: no-repeat;
      background-position: center center;
      background-size: cover;
      background-attachment: fixed;
      color: white;
    }
    .row{
      margin-left: 0px !important;
      margin-right: 0px !important;
    }
    #testimonial {
      padding: 50px 0 30px 0;
      text-align:center;
    }
    #logo_system{
      font-family: 'Monoton', cursive;
      /* font-weight: bold; */
    }
    #walltop{
      background: url(img/wallpaper1.jpg);
      filter: opacity(0.9);
      background-color: #000;
      background-size: cover;
      height: 100px;
    }
    .navbar {
      font-family: 'Roboto', serif;
      margin-bottom: 0;
      background-color: #0a0a0a;
      z-index: 9999;
      border: 0;
      font-size: 14px !important;
      line-height: 1.42857143 !important;
      letter-spacing: 2px;
      border-radius: 0;
    }
    
    .navbar li a, .navbar .navbar-brand {
      color: #fff !important;
    }
  
    .navbar-nav li a:hover, .navbar-nav li.active a {
      color: #fff !important;
      background-color: #ff4500 !important;
    }
  
    .navbar-default .navbar-toggle {
      border-color: transparent;
      color: #ffffff !important;    
    }

    .dark{
      background-color: #0a0a0a;
    }

    .white{
      color: #ffffff;
    }

    .bombs:hover{
      transform:scale(1.15);
      transition: all 0.5s ease;
    }

    .underline{
      border-bottom: 6px solid ;
      margin-bottom: 25px;
      padding: 5px 0;
      max-width: 50%;
      min-width: 35%;
      display: inline-block;
    }
    
    .underline2{
      border-bottom: 6px solid ;
      margin-bottom: 25px;
      padding: 5px 0;
      max-width: 55%;
      min-width: 50%;
      display: inline-block;
    }
  </style>
  </head>

  <body id="mipagina" data-spy="scroll" target=".navbar" data-offset="50">

    <!-- IMAGEN DE TOPE -->

    <div id="walltop" class="w-100 text-center">
      <h1 class="display-3" id="logo_system" style="color: orangered">Mars <span class="display-4" style="color: white; font-family: 'Merriweather', serif;">&COPY;</span></h1>
    </div>

    <!-- NAVEGACION -->

    <nav class="navbar navbar-dark navbar-expand-md sticky-top flex-md-row-reverse" id="nave" role="navigation">
      <button class="nav navbar-toggler white" type="button" data-toggle="collapse" data-target="#NToggler" aria-controls="NToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <ul class="navbar-nav mr-0 my-auto">
        <li class="nav-item">
            
          @if (Route::has('login'))
            
            @auth
              <a class="nav-link mr-2" href="{{ url('/dashboard') }}">Inicio</a>
            @else
              <a class="nav-link mr-2" href="{{ route('login') }}">Ingresar</a>
            @endauth
            
          @endif
            
        </li>
      </ul>
      
      <div class="collapse navbar-collapse" id="NToggler">
        <ul class="navbar-nav mr-auto my-auto">
          <li class="nav-item">
            <a class="nav-link" href="#acerca">¿Quiénes somos?</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contacto">Contacto</a>
          </li>
        </ul>
      </div>
    </nav>

    <!-- CUERPO -->

    <section id="header">
      <div class="container py-4" id="acerca">
        <div class="row">
          <div class="col-md-6 pt-5">
            <div class="header-content-right px-3">
              <h1 class="display-4 text-center">Bienvenido a <span id="logo_system" style="color: orangered; font-size: 3.5rem">Mars </span><span class="display-4" style="color: white; font-family: 'Merriweather', serif;">&COPY;</span></h1>
              <p class="mt-5 text-justify">Mars, es el nuevo sistema de información en ambiente WEB desarrollado con VUE.js y Laravel para la administración del departamento de personal y el departamento de mantenimiento de la empresa Inversiones y Construcciones Suramérica, C.A.</p>
            </div>
          </div>
          <div class="col-md-6 pt-3 text-center bombs">
             <img src="./img/mars.png" style="width: 60%">
          </div>
        </div>
      </div>
    </section>
    
    <section id="testimonial" class="dark text-light py-5">
      <div class="container">
        <h2 class="text-center">¿Qué es Inversiones y Construcciones Suramérica?</h2>
        <p class="mb-2">
          La empresa Inversiones y Construcciones Suramérica C.A. surgió en el año 2014, desde este año su principal actividad se basa en servicios y construcciones civiles y metalmecánicas, servicios de mecánica de maquinaria pesada y vehículos en general.
        </p>
        <img src="./img/delivery-truck.png" class="pt-3" style="width: 13%">
        <img src="./img/construction-machine (1).png" class="pt-3" style="width: 13%">
        <img src="./img/forklift.png" class="pt-3" style="width: 10%">
        <img src="./img/factory1.png" class="pt-3" style="width: 10%">
        <img src="./img/worker1.png" class="pt-3" style="width: 10%">
        <img src="./img/union.png" class="pt-3" style="width: 10%">
        <img src="./img/brick.png" class="pt-3" style="width: 10%">
      </div>
    </section>
    
    <section id="info-one" class="py-5">
      <div class="container">
        <div class="row mt-2">
          <div class="col-md-6 mt-5 d-flex align-items-center text-center">
            <div class="info-left px-3">
              <h3>Parte de nuestra flota:</h3>
              <img class="img-fluid w-100 rounded" src="img/patio_3.jpg" style="height: 270px;">
              <img class="img-fluid w-100 mt-3 rounded" src="img/patio_4.jpg" style="height: 270px;">
            </div>
          </div>
          <div class="col-md-6 mt-5 text-justify text-center">
            <div class="info-right px-3">
              <h2 class="text-center underline2">Presidente</h2>
                <div class="text-center container container-fluid p-3">
                  <img class="rounded-circle bombs" src="./img/president.jpg" alt="Rostro" style="width: 60%">
                </div>
                <p>Gerardo Carrasquero, presidente de Inversiones y Construcciones Suramérica, C.A., 27 años de edad, ingeniero en mantenimineto industrial graduado en la Universidad Gran Mariscal de Ayacucho (UGMA).</p>
                <img src="./img/boss.png" class="pt-3" style="width: 20%">
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <section id="info-two">
      <div class="container">
        <div class="row my-5 jumbotron dark">
          <div class="col-md-6 text-center mb-5">
              <h2 class="px-3 underline">Misión</h2>          
            <p class="text-justify px-3">Inversiones y Construcciones Suramérica, C.A. es una empresa dedicada al mantenimiento, obras y servicios, en instalaciones industriales y no industriales, con excelente calidad, superando las expectativas de nuestros clientes, de manera eficiente y responsable con la seguridad, higiene y el medio ambiente.
            </p>
            <img src="./img/mission.png" style="width: 15%">
          </div>
          <div class="col-md-6 text-center">
            <h2 class="px-3 text-center underline">Visión</h2>
            <p class="text-justify px-3">Ser reconocida como la empresa líder especializada en mantenimiento y servicios integrales a nivel nacional con cultura de atención al cliente y crecimiento responsable de nuestra empresa.</p>
            <img src="./img/goal.png" class="pt-3" style="width: 20%">
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
      
    <footer class="row pt-3 dark">
      <div class="col-md-6">
        <div class="container text-center text-light py-md-3" id="contacto">
          <h2>Inversiones y Construcciones SURAMÉRICA, C.A.</h2>
          <h4>R.I.F.: J-40342702-0</h4>
          <p><span id="logo_system" style="color: orangered; font-size: 1.5rem">Mars</span> &COPY; v0.1</p>
        </div>
      </div>
      <div class="col-md-6 text-center py-md-3">
        <div class="container text-center text-light">
          <div>
            <div class="fa fa-compass d-inline py-auto" style="width: 25px; height: 25px;"></div>  
              <h6 class="d-inline py-auto pl-1">Manzana 4 Galpón N°3, Zona Industrial, Ciudad Anaco, Municipio Anaco, Estado Anzoátegui. Venezuela</h6>
            </div>
            <div>
              <div class="fa fa-phone d-inline py-auto" style="width: 25px; height: 25px;"></div>  
                <h6 class="d-inline py-auto pl-1">Teléfonos: (0282)4246775 / (0282)7884396 / 0416-0822092 / 0424-8019772 / 0416-9802012</h6>
            </div>
            <div>
              <div class="fa fa-at d-inline py-auto" style="width: 25px; height: 25px;"></div>  
                <h6 class="d-inline py-auto pl-1">E-mail: insuraca@gmail.com</h6>
              </div>
            </div>  
        </div>
        <div class="text-center w-100 pb-2">
          <a class="btn btn-dark border border-light rounded-circle" href="#mipagina">
            <i class="fa fa-arrow-up"></i>
          </a>
        </div> 
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script>
      $(document).ready(function(){

        $(".navbar a, footer a[href='#mipagina']").on('click', function(event) {

          // Make sure this.hash has a value before overriding default behavior
          if (this.hash !== "") {

            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
              scrollTop: $(hash).offset().top
            }, 900, "swing", function(){

              // Add hash (#) to URL when done scrolling (default click behavior)
              window.location.hash = hash;
              });
          }  // End if
        });
      });
    </script>
  </body>
</html>
