<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require('connection.php');
    
    // Prepare an insert statement
    $sql = "INSERT INTO `2020` (`date`, `ownername`, email, dog, breed, place, distance) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssssssd", $date, $ownername, $email, $dog, $breed, $place, $distance);
        
        // Set parameters
        $date = $_POST['date'];
        $ownername = $_POST['ownername'];
        $email = $_POST['email'];
        $dog = $_POST['dog'];
        $breed = $_POST['breed'];

        if ($breed == "breed-other") {
            $breed = $_POST['breed-other'];
        }

        $place = $_POST['place'];
        $distance = $_POST['distance'];
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)) {
            $dbresult = "<div class=\"alert alert-success\" role=\"alert\">Turen er blitt registrert. Du kan se den i resultatlisten.</div>";
        } else {
            $dberror = mysqli_error($conn);
            $dbresult = "<div class=\"alert alert-warning\" role=\"alert\">Noe gikk galt. Vennligst ta kontakt med administrator.<br>Error: $sql. $dberror</div>";
        }
    } else {
        $dberror = mysqli_error($conn);
        $dbresult = "<div class=\"alert alert-warning\" role=\"alert\">Noe gikk galt. Vennligst ta kontakt med administrator.<br>Error: $sql. $dberror</div>";
    }
    
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="no">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<title>Turhund 2020</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <div class="container" id="tur-form">
            <h2>Turregistrering</h2>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo $dbresult;
            }
            ?>

            <form method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md">
                        <label for="date">Dato</label>
                        <input id="date" class="form-control" type="date" name="date" required>
                    </div>
                    <div class="form-group col-md">
                        <label for="hund">Navn på hunden</label>
                        <input id="hund" class="form-control" type="text" name="dog" required>
                    </div>
                    <div class="col-md">
                        <legend class="col-form-label">Rase</legend>
                        <div class="form-check">
                            <input id="breed" class="form-check-input" type="radio" name="breed" value="Berner sennenhund" required>
                            <label for="breed" class="form-check-label">Berner sennenhund</label>
                        </div>
                        <div class="form-check">
                            <input id="breed" class="form-check-input" type="radio" name="breed" value="Bernermix" required>
                            <label for="breed" class="form-check-label">Bernermix</label>
                        </div>
                        <div class="form-check">
                            <input id="breed" class="form-check-input" type="radio" name="breed" value="breed-other" required>
                            <label for="breed" class="form-check-label">
                                <input class="form-control form-control-sm" type="text" name="breed-other" placeholder="Annen">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="ownername">Navnet ditt</label>                       
                    <input id="ownername" class="form-control" type="text" name="ownername" required>
                </div>
                <div class="form-group">
                    <label for="email">E-postadresse</label>
                    <input id="email" class="form-control" type="email" name="email" required>
                </div>
                <div class="form-row">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="område">Hvor gikk turen?</label>
                            <input id="område" class="form-control" type="text" name="place" required>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label for="km">Hvor langt gikk dere?</label>
                            <div class="input-group">
                                <input class="form-control" type="number" name="distance" step="0.1" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="distanse">km</span>
                                </div>
                            </div>
                            <small class="form-text text-muted">Turens lengde i kilometer med maks én desimal, f.eks: 3,5.</small>
                        </div>
                    </div>
                </div>
                <input class="btn btn-primary btn-lg btn-block" type="submit" name="Submit" value="Send inn">
            </form>
        </div>
    </main>
    <?php include('footer.html'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>