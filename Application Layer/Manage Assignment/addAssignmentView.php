<?php
namespace ApplicationLayer\ManageAssignment;

class AssessmentView {
    private $moduleDetails;
    
    public function __construct($moduleDetails) {
        $this->moduleDetails = $moduleDetails;
    }

    public function render() {
        include "../includes/header.php";
        include "../includes/lecturer-navbar.php";
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <!-- Include your head content here -->
        </head>
        <body onload="SetDate();" style="background-color:lightblue">
            <!-- Include the rest of your HTML/PHP content here -->
            <div id="wrapper">
                <div id="page-wrapper">
                    <div class="container-fluid">
                        <!-- Your existing HTML/PHP content -->
                        <h1>Add Assessment</h1>
                        <?php
                        $this->renderModuleDetails();
                        ?>
                    </div>
                </div>
            </div>
            <!-- Include your JavaScript and CSS links here -->
        </body>
        </html>
        <?php
    }

    private function renderModuleDetails() {
        // Render module details
        if ($this->moduleDetails) {
            ?>
            <div class="row">
                <div class="col-md-9 personal-info">
                    <h3 style="text-align: center;">Assessment Information</h3>
                    <!-- Render the rest of the module details -->
                </div>
            </div>
            <?php
        }
    }
}
