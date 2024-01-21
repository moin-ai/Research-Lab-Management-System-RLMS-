<?php

class StudentAssignmentController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Function to fetch assignments for a specific student from the database
    public function fetchStudentAssignments($studentID) {
        $query = "SELECT * FROM assignment 
                  INNER JOIN submission ON assignment.assignmentID = submission.assignmentID
                  WHERE submission.studentID = :studentID";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':studentID', $studentID);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Function to submit an assignment
    public function submitAssignment($data) {
        // Extract data from the input
        $assignmentID = $data['assignmentID'];
        $studentID = $data['studentID'];
        $dueDate = $data['dueDate'];
        // Add more fields as needed

        // Check if the assignment is not already submitted
        $existingSubmissionQuery = "SELECT * FROM submission WHERE assignmentID = :assignmentID AND studentID = :studentID";
        $existingSubmissionStmt = $this->db->prepare($existingSubmissionQuery);
        $existingSubmissionStmt->bindParam(':assignmentID', $assignmentID);
        $existingSubmissionStmt->bindParam(':studentID', $studentID);
        $existingSubmissionStmt->execute();

        if ($existingSubmissionStmt->rowCount() > 0) {
            // Assignment already submitted, you can handle this case as needed
            return "Assignment already submitted";
        }

        // If not already submitted, insert the submission into the database
        $insertSubmissionQuery = "INSERT INTO submission (assignmentID, studentID, due_date) VALUES (:assignmentID, :studentID, :dueDate)";
        $insertSubmissionStmt = $this->db->prepare($insertSubmissionQuery);
        $insertSubmissionStmt->bindParam(':assignmentID', $assignmentID);
        $insertSubmissionStmt->bindParam(':studentID', $studentID);
        $insertSubmissionStmt->bindParam(':dueDate', $dueDate);
        // Bind more parameters if needed
        $insertSubmissionStmt->execute();

        // Add any additional logic needed for submission (e.g., file upload)

        return "Assignment submitted successfully";
    }
}

?>
