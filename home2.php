<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <!-- Google Fonts -->
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Lato&family=Yusei+Magic&display=swap" rel="stylesheet">

        <!-- ICONO Font Awesome -->
        <script src="https://kit.fontawesome.com/9f429f9981.js" crossorigin="anonymous"></script>

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="sass/custom.css">
        
		<title>Sloan</title>
		<link rel="shortcut icon" href="img/Logo.png">
	</head>
	<body style="font-family: 'Lato', sans-serif;">

        <!-- Contenedor #1 -->
        <div class="container-fluid">
            <!-- NAVBAR -->
            <div class="row bg-warning">
                <div class="col-12">
                    <nav class="navbar navbar-dark align-items-center">
                        <h2 class="text-white h1 text-center">Sloan</h2>
                        <button class="navbar-toggler border-white" 
                            type="button" 
                            data-toggle="collapse" 
                            data-target="#navbarSupportedContent" 
                            aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse text-right" id="navbarSupportedContent">
                            <ul class="navbar-nav text-center">
                                <li><div class="dropdown-divider"></div></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="cruds2/devoluciones.php">Devoluciones</a></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="cruds2/prestamo.php">Préstamos</a></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="cruds2/inciencia.php">Incidencias</a></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="cruds2/inventario.php">Inventario</a></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="#Tut">Tutoriales</a></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="cruds2/usuarios.php">Usuarios</a></li>
                                <li><div class="dropdown-divider"></div></li>
                                <li class="nav-item"><a class="nav-link text-white h6" href="index.php">Salir</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>   

        <!-- CARRUSEL CON BOTON DE BUSQUEDA -->
        <div class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/Fondo.jpeg" class="d-block w-100" alt="Imagen Carrusel">
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h1 class="display-2 text-white mb-5">Bienvenido</h1>
                    <div class="input-group mb-3">
                        <span class="input-group-text mb-5" id="basic-addon1"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control mb-5" placeholder="Buscar">
                    </div>
                    <button type="button" class="btn btn-warning text-white btn-lg mb-5 shadow">Buscar</button>
                </div>
            </div>
        </div>

        <!-- Contenedor #2 -->
        <div class="container-fluid">
            <!-- OPCIONES -->
            <div class="row pt-5" style="font-family: 'Yusei Magic', sans-serif;">
                <div class="col-12">
                    <div class="container bg-white border shadow p-3 mb-5 bg-white rounded">
                        <div class="row text-center pt-4 pb-lg-4">
                            <div class="col-12 col-md-6 col-lg-4">
                                <h2 class="pb-2"><a href="cruds2/devoluciones.php" class="text-info text-decoration-none">Devoluciones</a></h2>
                                <p class="text-secondary h6">Úsalo para tener</p>
                                <p class="text-secondary h6">un registro de las </p>
                                <p class="text-secondary h6">devoluciones</p>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <h2 class="pb-2"><a href="cruds2/prestamo.php" class="text-primary text-decoration-none">Préstamos</a></h2>
                                <p class="text-secondary h6">Podras generar</p>
                                <p class="text-secondary h6">préstamos de</p>
                                <p class="text-secondary h6">artículos audiovisuales</p>
                            </div>

                            <div class="col-12 col-md-12 col-lg-4">
                                <h2 class="pb-2"><a href="cruds2/inciencia.php" class="text-success text-decoration-none">Incidencias </a></h2>
                                <p class="text-secondary h6">Generá informes y</p>
                                <p class="text-secondary h6">lleva un registro de</p>
                                <p class="text-secondary h6">tus incidencias</p>
                            </div>
                        </div> 
                        <div class="row text-center pb-4">
                            <div class="col-lg-6 col-md-6">
                                <h2 class="pb-2"><a href="cruds2/inventario.php" class="text-warning text-decoration-none">Inventario</a></h2>
                                <p class="text-secondary h6">Podras</p>
                                <p class="text-secondary h6">checkear</p>
                                <p class="text-secondary h6">tu inventario</p>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <h2 class="pb-2"><a href="cruds2/usuarios.php" class="text-danger text-decoration-none">Usuarios</a></h2>
                                <p class="text-secondary h6">Úsalo para</p>
                                <p class="text-secondary h6">crear nuevos</p>
                                <p class="text-secondary h6">prestadores</p>
                            </div>
                        </div>         
                    </div> 
                </div>
            </div>

            <!-- TITULO TUTORIALES -->
            <div class="row text-center" id="Tut">
                <div class="col-lg-4 col-1"></div>
                <div class="col-lg-4 col-10 bg-danger">
                    <h2 class="text-white display-4 pt-4 pb-4 shadow">Tutoriales</h2>
                </div>
                <div class="col-lg-4 col-1"></div>
            </div>

            <!-- VIDEO TUTORIALES -->
            <div class="row bg-info pt-3">
                <!-- Video #1 -->
                <div class="col-sm-6 col-lg-4 p-3 text-center">
                    <label class="h5 pb-1"><strong>Como generar un préstamo</strong></label>
                    <a href="https://www.youtube.com/watch?v=IYod0Jk0R8M" target="_blank" title="Como generar un préstamo">
                        <div class="card text-dark fw-bold bg-dark mb-3">
                            <img src="https://i.ytimg.com/vi/IYod0Jk0R8M/hqdefault.jpg" alt="Video tutorial 1" class="card-img">
                        </div>
                    </a>
                </div>
                <!-- Video #2 -->
                <div class="col-sm-6 col-lg-4 p-3 text-center">
                    <label class="h5 pb-1"><strong>Cómo generar una devolución</strong></label>
                    <a href="https://www.youtube.com/watch?v=62YKHF_VPDA" target="_blank" title="Cómo generar una devolución">
                        <div class="card text-dark fw-bold bg-dark mb-3">
                            <img src="https://i.ytimg.com/vi/62YKHF_VPDA/hqdefault.jpg" alt="Video tutorial 1" class="card-img">
                        </div>
                    </a>
                </div>
                <!-- Video #3 -->
                <div class="col-sm-6 col-lg-4 p-3 text-center">
                    <label class="h5 pb-1"><strong>Cómo compartir un informe</strong></label>
                    <a href="https://www.youtube.com/watch?v=7LuyOWcjhAk" target="_blank" title="Cómo compartir un informe">
                        <div class="card text-dark fw-bold bg-dark mb-3">
                            <img src="https://i.ytimg.com/vi/7LuyOWcjhAk/hqdefault.jpg" alt="Video tutorial 1" class="card-img">
                        </div>
                    </a>
                </div>
                <!-- Video #4 -->
                <div class="col-sm-6 col-lg-4 p-3 text-center">
                    <label class="h5 pb-1"><strong>Cómo administrar inventario</strong></label>
                    <a href="https://www.youtube.com/watch?v=tF88eNhNSb4" target="_blank" title="Cómo administrar inventarioo">
                        <div class="card text-dark fw-bold bg-dark mb-3">
                            <img src="https://i.ytimg.com/vi/tF88eNhNSb4/hqdefault.jpg" alt="Video tutorial 1" class="card-img">
                        </div>
                    </a>
                </div>
                <!-- Video #5 -->
                <div class="col-sm-6 col-lg-4 p-3 text-center">
                    <label class="h5 pb-1"><strong>Cómo administrar usuarios</strong></label>
                    <a href="https://www.youtube.com/watch?v=D3oNv8gSy6U" target="_blank" title="Cómo administrar usuarios">
                        <div class="card text-dark fw-bold bg-dark mb-3">
                            <img src="https://i.ytimg.com/vi/D3oNv8gSy6U/hqdefault.jpg" alt="Video tutorial 1" class="card-img">
                        </div>
                    </a>
                </div>
                <!-- Video #6 -->
                <div class="col-sm-6 col-lg-4 p-3 text-center">
                    <label class="h5 pb-1"><strong>Cómo cambiar mi contraseña</strong></label>
                    <a href="https://www.youtube.com/watch?v=ch-a51yE8_k" target="_blank" title="Cómo cambiar mi contraseña">
                        <div class="card text-dark fw-bold bg-dark mb-3">
                            <img src="https://i.ytimg.com/vi/ch-a51yE8_k/hqdefault.jpg" alt="Video tutorial 1" class="card-img">
                        </div>
                    </a>
                </div>     
            </div>

            <!-- PIE -->
            <!-- <div class="row border">
                <div class="col-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 bg-white text-light text-center h6">
                                Todos los derechos reservados
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

		<!-- Scripts de Bootstrap -->
		<script type="text/javascript" src="js/jquery-3.5.1.slim.min.js"></script>
		<script type="text/javascript" src="js/popper.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</body>
</html>