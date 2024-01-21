<?php
// AssessmentListController.php

include "../db_handler.php";

class AssessmentListController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function generateAssessmentList() {
        $output = '';
        
        if (isset($_GET['id'])) {
            $module = mysqli_real_escape_string($this->conn, $_GET['id']);
        
            $sql = "SELECT * FROM module WHERE module_code = '$module'";
            $result = mysqli_query($this->conn, $sql) or die(mysqli_error($this->conn));
        
            while ($row = mysqli_fetch_array($result)) {
                $mcode = $row['module_code'];
                $mname = $row['module_name'];
            }
        }
        
        if (isset($_POST["query"])) {
            $search = mysqli_real_escape_string($this->conn, $_POST["query"]);
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
        
        $result = mysqli_query($this->conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $output .= '
                    <tr>
                        <td>' . $row["name"] . '</td>
                        <td>' . $row["module_name"] . '</td>
                        <td>' . $row["description"] . '</td>
                        <td>' . $row["deadline"] . '</td>
                    </tr>
                ';
            }
        }
        
        return $output;
    }

    public function exportToCSV() {
        if (isset($_POST["export"])) {
            $result = "SELECT * FROM assessment";
            $row = mysqli_query($this->conn, $result) or die(mysqli_error($this->conn));
        
            $fp = fopen('../spreadsheets/assessments.csv', 'w');
        
            while ($val = mysqli_fetch_array($row, MYSQLI_ASSOC)) {
                fputcsv($fp, $val);
            }
            fclose($fp);
        }
    }
}

// Create an instance of the controller
$assessmentListController = new AssessmentListController($conn);

// Generate Assessment List
$output = $assessmentListController->generateAssessmentList();

// Export to CSV
$assessmentListController->exportToCSV();
?>
