<?php
require_once("controller.php");
$conn = new Controller;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // print_r($_FILES['file']);
    if (isset($_FILES['file'])) {
        $targetDirectory = "uploads/"; //
        $originalFilename = $_FILES["file"]["name"];
        $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);
        $newFilename = uniqid() . "_" . time() . "." . $extension;
        $targetPath = $targetDirectory . $newFilename;
        if (isset($_GET['editProjfile'])) {
            $id = $_GET['editProjfile'];
            echo $conn->editFile('projects', 'proj_id', $id, $targetPath);
        } else {
            move_uploaded_file($_FILES['file']['tmp_name'], "../" . $targetPath);
            $response = array(
                'file' => $targetPath
            );
            echo json_encode($response);
        }
    }
}
