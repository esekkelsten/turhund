<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="Description" content="Enter your description here"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style.css">
<title>Title</title>
</head>
<body>
    <?php include('../header.php'); ?>

    <main>
        <div class="container" id="tur-main">
            <h2>Admintabell</h2>

            <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                <div class="btn-group" role="group" aria-label="Last ned CSV">
                    <button class="btn btn-primary" value="export" type="submit">Last ned CSV</button>
                </div>         
            </form>

            <?php

                if(isset($_POST['export']))
                    {	
                        /* vars for export */
                        // database record to be exported
                        $db_record = '2020';
                        // optional where query
                        $where = 'WHERE 1 ORDER BY 1';
                        // filename for export
                        $csv_filename = 'db_export_'.$db_record.'_'.date('Y-m-d').'.csv';
                        // database variables
                        $database = "turhund";

                        include('../connection-php');

                        // create empty variable to be filled with export data
                        $csv_export = '';

                        // query to get data from database
                        $query = mysqli_query($conn, "SELECT * FROM ".$db_record." ".$where);
                        $field = mysqli_field_count($conn);

                        // create line with field names
                        for($i = 0; $i < $field; $i++) {
                            $csv_export.= mysqli_fetch_field_direct($query, $i)->name.';';
                        }

                        // newline (seems to work both on Linux & Windows servers)
                        $csv_export.= '
                        ';

                        // loop through database query and fill export variable
                        while($row = mysqli_fetch_array($query)) {
                            // create line with field values
                            for($i = 0; $i < $field; $i++) {
                                $csv_export.= '"'.$row[mysqli_fetch_field_direct($query, $i)->name].'";';
                            }
                            $csv_export.= '
                        ';
                        }

                        // Export the data and prompt a csv file for download
                        header('Content-Encoding: UTF-8');
                        header('Content-type: text/csv; charset=UTF-8');
                        header("Content-Disposition: attachment; filename=".$csv_filename."");
                        echo "\xEF\xBB\xBF"; // UTF-8 BOM
                        echo($csv_export);
                    }
            ?>

            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>Dato</th>
                        <th>Hund</th>
                        <th>Rase</th>
                        <th>Eier</th>
                        <th>E-post</th>
                        <th>Tursted</th>
                        <th>Distanse</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include('getadmintable.php'); ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include('../footer.html') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>