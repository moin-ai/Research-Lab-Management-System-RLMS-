<?php
namespace BusinessServiceLayer\Controller\ManageAssignment;

use ApplicationLayer\ManageAssignment\AssessmentView;

class AssessmentController {
    public function index() {
        $moduleDetails = $this->getModuleDetails();
        $view = new AssessmentView($moduleDetails);
        $view->render();
    }

    private function getModuleDetails() {
        include "../db_handler.php";

        if (isset($_GET['id'])) {
            $module = mysqli_real_escape_string($conn, $_GET['id']);
            $sql = "SELECT * FROM module WHERE module_code = '$module'";
            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

            while ($row = mysqli_fetch_array($result)) {
                $mcode = $row['module_code'];
                $mname = $row['module_name'];
            }

            return compact('mcode', 'mname');
        }

        return null;
    }

    public function processFormSubmission() {
        if (isset($_POST['submit'])) {
            include "../db_handler.php";

            $aname1 = mysqli_real_escape_string($conn, $_POST['aname']);
            $adesc = mysqli_real_escape_string($conn, $_POST['description']);
            $adeadline1 = mysqli_real_escape_string($conn, $_POST['adeadline']);

            // Assuming 'lecturers' is an array
            $lecturers = isset($_POST['lecturers']) ? $_POST['lecturers'] : array();

            $lid = mysqli_insert_id($conn);

            // Insert the assessment record
            $query = "INSERT INTO assessment (module_code, name, description, deadline, markers) VALUES ('$mcode', '$aname1', '$adesc', '$adeadline1', '" . implode(', ', $lecturers) . "')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $id = mysqli_insert_id($conn);

                if (isset($_POST['sname']) && isset($_POST['sdesc']) && isset($_POST['sdeadline'])) {
                    foreach ($_POST['sname'] as $key => $value) {
                        $asdname = mysqli_real_escape_string($conn, $_POST['sname'][$key]);
                        $asdesc = mysqli_real_escape_string($conn, $_POST['sdesc'][$key]);
                        $sdeadline1 = mysqli_real_escape_string($conn, $_POST['sdeadline'][$key]);

                        $query = "INSERT INTO assessment (assessment_code, module_code, name, description, deadline, markers, sub_assessment, sub_assessment_description, sub_assessment_deadline) VALUES ('$id', '$mcode', '$aname1', '$adesc', '$adeadline1', '" . implode(', ', $lecturers) . "', '$asdname', '$asdesc', '$sdeadline1')";

                        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
                    }
                }

                if ($result) {
                    // Update module with the latest assessment id
                    $get = "SELECT assessment1, assessment2, assessment3 FROM module WHERE module_code = '$mcode'";
                    $got = mysqli_query($conn, $get) or die(mysqli_error($conn));

                    while ($row = mysqli_fetch_array($got)) {
                        $a1set = $row['assessment1'];
                        $a2set = $row['assessment2'];
                        $a3set = $row['assessment3'];
                    }

                    if ($a1set == "") {
                        $sql = "UPDATE module SET assessment1 = '$id' WHERE module_code = '$mcode'";
                        $result1 = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    } elseif ($a2set == "") {
                        $sql = "UPDATE module SET assessment2 = '$id' WHERE module_code = '$mcode'";
                        $result1 = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    } elseif ($a3set == "") {
                        $sql = "UPDATE module SET assessment3 = '$id' WHERE module_code = '$mcode'";
                        $result1 = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                    }

                    mysqli_close($conn);
                    echo '<script type="text/javascript">','YNconfirm();','</script>';
                }
            }
        }
    }

    // Add other controller logic as needed
}

$assessmentController = new AssessmentController();

// Check if the form was submitted
if (isset($_POST['submit'])) {
    $assessmentController->processFormSubmission();
} else {
    // If not, display the main page
    $assessmentController->index();
}
