<?php

namespace ApplicationLayer\Student;

class StudentViewAssignment
{
    public function render($moduleDetails, $assignments)
    {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
            <title>List Of Assessments</title>
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
                                    <th><input type="text" class="form-control" placeholder="Submit Assignment" disabled></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($assignments as $assignment) {
                                    ?>
                                    <tr>
                                        <td><?= $assignment['name'] ?></td>
                                        <td><?= $assignment['module_name'] ?></td>
                                        <td><?= $assignment['description'] ?></td>
                                        <td><?= $assignment['deadline'] ?></td>
                                        <td>
                                            <a href="submit.php?id=<?= $assignment["assessment_code"] ?>" class="btn btn-primary">Submit</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
    }
}
