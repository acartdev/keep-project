<?php
require_once("controller.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new Controller;
    if (isset($_FILES['img'])) {
        $targetDirectory = "uploads/"; //
        $originalFilename = $_FILES["img"]["name"];
        $extension = pathinfo($originalFilename, PATHINFO_EXTENSION);
        $newFilename = uniqid() . "_" . time() . "." . $extension;
        $targetPath = $targetDirectory . $newFilename;
        if (isset($_GET['editProjimg'])) {
            $id = $_GET['editProjimg'];
            echo $conn->editImg('projects', 'proj_id', $id, $targetPath);
        } else if (isset($_FILES['editTeacherImg'])) {
            $id = $_GET['editTeacherImg'];
            echo $conn->editImg('teacher', 'tea_id', $id, $targetPath);
        } else if (isset($_FILES['editUserImg'])) {
            $id = $_GET['editUserImg'];
            echo $conn->editImg('users', 'id', $id, $targetPath);
        } else {
            move_uploaded_file($_FILES['img']['tmp_name'], "../" . $targetPath);
            $response = array(
                'img' => $targetPath
            );
            echo json_encode($response);
        }
    } else if (isset($_FILES['images'])) {
        $targetDirectory = '../images/banner/';


        foreach ($_FILES['images']['name'] as $key => $name) {
            $uniqueFilename = time() . '_' . $name;
            $targetFile = $targetDirectory . $uniqueFilename;
            // echo $targetFile;
            move_uploaded_file($_FILES['images']['tmp_name'][$key],  $targetFile);
        }
        echo json_encode(array("status" => "success", "msg" => "เพิ่มรูปภาพแบร์นเนอร์สำเร็จ!!", "title" => "เพิ่มรูปภาพ"));
    }
}
