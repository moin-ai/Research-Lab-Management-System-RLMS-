

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css?<?php echo time(); ?> /">
    <link rel="stylesheet" href="css/style1.css?<?php echo time(); ?> /">
    <link rel="stylesheet" href="css/tile.css?<?php echo time(); ?> /">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
    <title>Home</title>
</head>
<body style="background-color:lightblue">
    <br><br><br><br>
    <div class="container">
        <div class="wrapper">
            <h1>Welcome <?php /* Output lecturer name here */ ?></h1>
            <hr><br><br>
            <div style="text-align:center;">
                <h1>Assignments</h1>
                <button type="button" class="btn btn-info"><a href="../lecturer/admin-view-modules.php">Add Assignments</a></button>
                <button type="button" class="btn btn-primary"><a href="../lecturer/view-assessments.php">View Assignments</a></button>
                <button type="button" class="btn btn-info"><a href="../student/uploads/view-submit-assessments.php">View submitted assignments</a></button>
            </div><br>
            <div class="col-md-6">
                <br><br>
            </div>
        </div>
        <hr>
    </div>

    <style type="text/css">
        /* Your CSS styles here */
    </style>

    <script type="text/javascript">
        // Your JavaScript code here
    </script>
</body>
</html>
