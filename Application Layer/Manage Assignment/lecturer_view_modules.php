<!-- assessment-list-view.php -->

<!DOCTYPE html>
<html>
<head>
    <?php include "../includes/header.php"; ?>
    <?php include "../includes/lecturer-navbar.php"; ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
    <title>Assessment List</title>
</head>
<body style="background-color: lightblue">
    <div class="container">
        <div class="row">
            <h1>List Of Assessments</h1>
            <hr>
            <div class="panel panel-primary filterable" style="border-color: #00bdaa;">
                <div class="panel-heading" style="background-color: #00bdaa;">
                    <h3 class="panel-title">Assessments</h3>
                </div>
                <table class="table">
                    <thead>
                        <tr class="filters">
                            <th><input type="text" class="form-control" placeholder="Assessment Name" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Module" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Description" disabled></th>
                            <th><input type="text" class="form-control" placeholder="Deadline" disabled></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $output; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
