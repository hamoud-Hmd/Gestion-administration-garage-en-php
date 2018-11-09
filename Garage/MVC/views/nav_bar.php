<?php
$pages = [
       'home' => [
           'title' => 'Mon Garage',
           'href' => ''
       ],
       'addCar' => [
           'title' => 'Ajout de véhicule',
           'href' => '/car/add'
       ],
       'authentication' => [
           'title' => 'Création et Connection',
           'href' => '/user/create'
       ],
       'reservation' => [
           'title' => 'Réservation',
           'href' => '/resa/create'
       ],
       'disconnect' => [
           'title' => 'Déconnexion',
           'href' => '/user/deconnexion'
       ]
   ];?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Site dynamique en POO</a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <?php
            foreach ($pages as $key => $value) {
                $classe = (isset($_GET['menu']) && !empty($_GET['menu']) && $_GET['menu'] == $key) ? 'active' : '';
                ?>
                <li class="nav-item <?php echo $classe; ?>">
                    <a class="nav-link" href="/index.php<?php echo $value['href'] ?>?menu=<?php echo $key; ?>">
                        <?php echo $value['title']; ?>
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</nav>
