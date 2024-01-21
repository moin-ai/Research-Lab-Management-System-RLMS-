<!DOCTYPE html>
<html>
  <?php 
    include "../includes/header.php";
    include "../includes/lecturer-navbar.php";
    include "../db_handler.php";
  ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
    <title></title>
</head>
<body style="background-color:lightblue">
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
                    <?php
$output = '';
if (isset($_GET['id'])) {
    $module = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM module WHERE module_code = '$module'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    while ($row = mysqli_fetch_array($result)) {
        $mcode = $row['module_code'];
        $mname = $row['module_name'];
    }
}

if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($conn, $_POST["query"]);
    $query = "
        SELECT a.*, m.module_name 
        FROM assessment a
        INNER JOIN module m ON a.module_code = m.module_code
        WHERE a.name LIKE '%" . $search . "%'
    ";
} else {
    $query = "
        SELECT a.*, m.module_name 
        FROM assessment a
        INNER JOIN module m ON a.module_code = m.module_code
        ORDER BY a.assessment_code ASC
    ";
}

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $assessment = $row["name"];

        $output .= '
            <tr>
                <td>' . $row["name"] . '</td>
                <td>' . $row["module_name"] . '</td>
                <td>' . $row["description"] . '</td>
                <td>' . $row["deadline"] . '</td>
            </tr>
        ';
    }
    echo $output;
}
?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<style type="text/css">
    .filterable {
    margin-top: 15px;
    }
    .filterable .panel-heading .pull-right {
        margin-top: -20px;
    }
    .filterable .filters input[disabled] {
        background-color: transparent;
        border: none;
        cursor: auto;
        box-shadow: none;
        padding: 0;
        height: auto;
    }
    .filterable .filters input[disabled]::-webkit-input-placeholder {
        color: #333;
    }
    .filterable .filters input[disabled]::-moz-placeholder {
        color: #333;
    }
    .filterable .filters input[disabled]:-ms-input-placeholder {
        color: #333;
    }
</style>


<?php 
   if(isset($_POST["export"])){
      $result = "SELECT * FROM assessment";
      $row = mysqli_query($conn, $result) or die(mysqli_error($conn));

      $fp = fopen('../spreadsheets/assessments.csv', 'w');

      while($val = mysqli_fetch_array($row, MYSQLI_ASSOC)){
          fputcsv($fp, $val);
      }
      fclose($fp); 
    }  
?>