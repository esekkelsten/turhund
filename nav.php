<?php

$rootURL = "http://localhost:8888/turliste";

?>    
    <div class="container" id="tur-nav">
        <nav class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo $rootURL; ?>/index.php">Hjem</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo $rootURL; ?>/submit.php">Skjema</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo $rootURL; ?>/table.php">Resultater</a>
            </li>
            <li class="nav-item">
            <a class="nav-link active" href="<?php echo $rootURL; ?>/admin/admintable.php">Admintabell</a>
        </li>
        </nav>
    </div>