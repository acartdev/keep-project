<?php
session_start();
require_once("controller.php");
$conn = new Controller;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_GET["edituser"])) {
        $postData = $_POST['data'];
        $id = $postData['id'];
        $query = $conn->updateUser($id, $postData);
        if ($query) {
            echo json_encode(array('status' => 'success', 'msg' => 'แก้ไขข้อมูลสำเร็จ กรุณาให้ผู้ใช้เข้าสู่ระบบใหม่อีกครั้ง!', "title" => "แก้ไขข้อมูลสำเร็จ!"));
            // $conn->logout();
        } else {
            echo json_encode(array('status' => 'error', 'msg' => 'เกิดข้อผิดพลาดในการแก้ไขข้อมูล!!', "title" => "แก้ไขข้อมูลไม่สำเร็จ!!"));
        }
    }
    if (isset($_GET["editProject"])) {
        $postData = $_POST['data'];
        $id = $postData['proj_id'];
        $query = $conn->editProject($id, $postData);
        // print_r($postData['id']);
        // print_r($postData['prod']);
        if ($query) {
            echo json_encode(array('status' => 'success', 'msg' => 'แก้ไขข้อมูลโครงงานสำเร็จ!', "title" => "แก้ไขข้อมูลสำเร็จ!"));
        } else {
            echo json_encode(array('status' => 'error', 'msg' => 'เกิดข้อผิดพลาดในการแก้ไขข้อมูลโครงงาน!!', "title" => "แก้ไขข้อมูลไม่สำเร็จ!!"));
        }
    }
    if (isset($_GET["editteacher"])) {
        $postData = $_POST['data'];
        $id = $postData['tea_id'];
        $query = $conn->updateTeacher($id, $postData);
        if ($query) {
            echo json_encode(array('status' => 'success', 'msg' => 'แก้ไขข้อมูลครูที่ปึกษาสำเร็จ!', "title" => "แก้ไขข้อมูลสำเร็จ!"));
        } else {
            echo json_encode(array('status' => 'error', 'msg' => 'เกิดข้อผิดพลาดในการแก้ไขข้อมูล!!', "title" => "แก้ไขข้อมูลไม่สำเร็จ!!"));
        }
    }
    if (isset($_GET['addProject'])) {
        $conn->addProject();
    }
    if (isset($_GET['register'])) {
        $conn->register();
    }
    if (isset($_GET['adminregis'])) {
        $conn->registerAdmin();
    }
    if (isset($_GET['login'])) {
        $conn->login();
    }
    if (isset($_GET['logout'])) {
        $conn->logout();
    }
    if (isset($_GET['addteacher'])) {
        $conn->addTeacher();
    }
} else if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (isset($_GET["deleteBan"])) {
        $dir = $_GET['path'];
        if (unlink("../" . $dir)) {
            echo json_encode(array('status' => 'success', 'msg' => 'ลบรูปภาพแบร์นเนอณ์สำเร็จ!!', 'title' => 'ลบรูปภาพ?'));
        } else {
            echo json_encode(array('status' => 'error', 'msg' => 'ลบรูปภาพแบร์นเนอณ์ไม่สำเร็จ!!', 'title' => 'ลบรูปภาพ?'));
        }
    }
    if (isset($_GET["getteacher"])) {
        $query = $conn->getTeacher($_GET['id']);
        if ($query) {
            $row = mysqli_fetch_assoc($query);
        }
        echo json_encode($row);
    }
    if (isset($_GET["getuser"])) {
        $query = $conn->getUser($_GET['id']);
        if ($query) {
            $row = mysqli_fetch_assoc($query);
        }
        echo json_encode($row);
    }

    if (isset($_GET['getproj'])) {
        $query = $conn->getProject($_GET['id']);
        if ($query) {
            $row = mysqli_fetch_assoc($query);
        }
        echo json_encode($row);
    }
    if (isset($_GET['deletetea'])) {
        $query = $conn->deleteTeacher($_GET['id']);
        if ($query) {

            echo json_encode(array('status' => 'success', 'msg' => 'ลบข้อมูลครูที่ปรึกษาสำเร็จ!', "title" => "ลบข้อมูลสำเร็จ!"));
        } else {
            echo json_encode(array('status' => 'error', 'msg' => 'เกิดข้อผิดพลากในการลบข้อมูลครูที่ปรึกษา!', "title" => "ลบข้อมูลไม่สำเร็จ!"));
        }
    }
    if (isset($_GET['deleteuser'])) {
        $query = $conn->deleteUser($_GET['id']);
        if ($query) {

            echo json_encode(array('status' => 'success', 'msg' => 'ลบข้อมูลผู้ใช้งานสำเร็จ!', "title" => "ลบข้อมูลสำเร็จ!"));
        } else {
            echo json_encode(array('status' => 'error', 'msg' => 'เกิดข้อผิดพลากในการลบข้อมูลผู้ใช้งาน!', "title" => "ลบข้อมูลไม่สำเร็จ!"));
        }
    }
    if (isset($_GET['deletepro'])) {
        $query = $conn->deleteProject($_GET['id']);
        if ($query) {

            echo json_encode(array('status' => 'success', 'msg' => 'ลบข้อโครงงาน/วิจัยสำเร็จ!', "title" => "ลบข้อมูลสำเร็จ!"));
        } else {
            echo json_encode(array('status' => 'error', 'msg' => 'เกิดข้อผิดพลากในการลบโครงงาน/วิจัย!', "title" => "ลบข้อมูลไม่สำเร็จ!"));
        }
    }
    if (isset($_GET['getprod'])) {
        $query = $conn->getProduct($_GET['id']);
        $response = array();
        if ($query) {


            while ($row = mysqli_fetch_assoc($query)) {
                $response[] = $row;
            }
        }
        echo json_encode($response);
    }
}
