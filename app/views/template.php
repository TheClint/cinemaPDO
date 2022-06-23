<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title?></title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/style.css">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/490620123f.js" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="../../public/js/script.js"></script>

</head>
<!-- création du template qui sera commun à la plupart des pages qui se chargeront dynamiquement avec la variable $contenu -->
<body class="position-relative">
    <header class="sticky-top">
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
              <figure>
                  <img src="./public/img/logo/logo-cineallo.png" alt="logo de la bobine cineallo">
              </figure>   

          <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link active" href="index.php">Accueil
                  <span class="visually-hidden">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?action=listFilms">Films</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?action=listActeurs">Acteurs</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?action=listGenres">Genres</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?action=listRealisateurs">Réalisateurs</a>
              </li>
            </ul>
            <form class="d-flex">
              <input class="form-control me-sm-2" type="text" placeholder="Search">
              <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
    </header>
    <main>
        <div class="contain p-3">
            <?=$contenu?>
        </div>
    </main>

    <footer class="fixed-bottom">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-center">
        <div class="container-fluid">

          <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mx-auto">
              <li class="nav-item">
                <a class="nav-link" href="#">Conditions générales de ventes</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Mentions légales</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </footer>
    
</body>
</html>