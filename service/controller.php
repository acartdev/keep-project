<?php

require_once("../config/db.php");
class Controller extends Service
{


    public function editFile($table, $field, $id, $targetPath)
    {


        $exist = mysqli_fetch_assoc($this->select("$table", ['file'], "$field = '$id'"));
        $files = $exist['file'];
        if (!empty($files) && file_exists("../$files")) {
            if (unlink("../$files")) {
                move_uploaded_file($_FILES['file']['tmp_name'], "../" . $targetPath);
                $response = array(
                    'file' => $targetPath
                );
                return json_encode($response);
            } else {
                return json_encode(array("file" => $files));
            }
        } else {
            return json_encode(array("file" => $files));
        }
    }
    public function editImg($table, $field, $id, $targetPath)
    {


        $exist = mysqli_fetch_assoc($this->select("$table", ['img'], "$field = '$id'"));
        $files = $exist['img'];
        if (!empty($files) && file_exists("../$files")) {
            if (unlink("../$files")) {
                move_uploaded_file($_FILES['img']['tmp_name'], "../" . $targetPath);
                $response = array(
                    'img' => $targetPath
                );
                return json_encode($response);
            } else {
                return json_encode(array("img" => $files));
            }
        } else {
            return json_encode(array("img" => $files));
        }
    }
    public function updateUser($id, $data)
    {
        if (array_key_exists("id", $data)) {
            unset($data["id"]);
            $query = $this->update("users", $data, "id = '$id'");
        }
        return $query ? true : false;
    }
    public function updateTeacher($id, $data)
    {
        if (array_key_exists("tea_id", $data)) {
            unset($data["tea_id"]);
            $query = $this->update("teacher", $data, "tea_id = '$id'");
        }
        return $query ? true : false;
    }
    public function getUser($id)
    {
        $query = $this->select("users", [], "id = '$id'");
        return $query ? $query : false;
    }

    public function getTeacher($id)
    {
        $query = $this->select("teacher", [], "tea_id = '$id'");
        return $query ? $query : false;
    }
    public function getProduct($id)
    {
        $query = $this->select("product", [], "project_id = '$id'");
        return $query ? $query : false;
    }
    public function getProject($id)
    {
        $query = $this->select("projects", [], "proj_id = '$id'");
        return $query ? $query : false;
    }
    public function deleteProject($id)
    {
        $checkImg = $this->select("projects", ['img', "file"], " proj_id = '$id'");
        $row = mysqli_fetch_assoc($checkImg);
        if ($row) {
            unlink("../" . $row["img"]);
            unlink("../" . $row["file"]);
        }
        $query = $this->delete("projects",  "proj_id = '$id'");
        $prod = $this->delete("product", "project_id = '$id'");
        return $query && $prod ? true : false;
    }

    public function deleteTeacher($id)
    {
        $checkImg = $this->select("teacher", ['img'], " tea_id = '$id'");
        $row = mysqli_fetch_assoc($checkImg);
        if ($row) {
            unlink("../" . $row["img"]);
        }
        $query = $this->delete("teacher",  "tea_id = '$id'");

        return $query  ? true : false;
    }
    public function deleteUser($id)
    {
        $checkImg = $this->select("users", ['img'], " id = '$id'");
        $row = mysqli_fetch_assoc($checkImg);
        if ($row) {
            unlink("../" . $row["img"]);
        }
        $query = $this->delete("users",  "id = '$id'");

        return $query  ? true : false;
    }
    public function addTeacher()
    {
        $postData = $_POST['data'];
        $id = $postData['tea_id'];
        $exits = $this->select("teacher", ["tea_id"], "tea_id = '$id'");
        if (mysqli_num_rows($exits) > 0) {
            echo json_encode(array("title" => "ไม่สำเร็จ!!", "msg" => "ครูที่ปรึกษานี้มีอยู่แล้ว กรุณาตรวจสอบรหัสครู!", "status" => "error"));
        } else {
            $stmt = $this->insert("teacher", $postData);
            if ($stmt) {
                echo json_encode(array("title" => "สำเร็จ!!", "msg" => "ครูที่ปรึกษาได้ทำการเพิ่มแล้ว", "status" => "success"));
            } else {
                echo json_encode(array("title" => "ไม่สำเร็จ!!", "msg" => "เกิดข้อผิดพลาด ไม่สามารถเพิ่มครูที่ปรึกษาได้!", "status" => "error"));
            }
        }
    }
    public function logout()
    {
        if (!empty($_SESSION['id'])) {
            unset($_SESSION['id']);
            unset($_SESSION['name']);
            unset($_SESSION['lastname']);
            unset($_SESSION['dept']);
            unset($_SESSION['edl']);
            unset($_SESSION['role']);
            unset($_SESSION['img']);
            session_destroy();
        }
    }
    public function login()
    {
        $postData = $_POST['data'];

        $id = $postData["id"];
        $password = $postData["password"];
        $exits = $this->select("users", [], "id = '$id'");
        $numRows = mysqli_num_rows($exits);
        if ($numRows > 0) {
            $row = mysqli_fetch_assoc($exits);
            if (password_verify($password, $row["password"])) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['dept'] = $row['dept'];
                $_SESSION['edl'] = $row['edl'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['img'] = $row['img'];
                echo json_encode(array("title" => "เข้าสู่ระบบสำเร็จ!!", "msg" => "ท่านได้เข้าสู่ระบบสำเร็จแล็ว!", "status" => "success"));
            } else {

                echo json_encode(array("title" => "รหัสผ่านไม่ถูกต้อง!!", "msg" => "เกิดข้อผิดพลาดในการเข้าสู่ระบบ กรุณาตรวจสอบรหัสผ่าน!", "status" => "error"));
            }
        } else {
            echo json_encode(array("title" => "ไม่พบบัญชีผู้ใช้!!", "msg" => "บัญชีผู้ใช้นี้ยังไม่ถูกลงทะเบียน!!", "status" => "error"));
        }
    }
    public function register()
    {
        $formData = $_POST["data"];
        $id = $formData['id'];
        $exits = $this->select("users", ["id"], "id = '$id'");
        if (mysqli_num_rows($exits) > 0) {
            echo json_encode(array("title" => "ไม่สำเร็จ!!", "msg" => "ผู้ใช้นี้มีอยู่แล้วกรุณาตรวจสอบรหัสนักเรียน/นักศึกษาของท่าน!", "status" => "error", "link" => true));
        } else {
            $formData['password'] = password_hash($formData['password'], PASSWORD_DEFAULT);
            $stmt = $this->insert("users", $formData);
            if ($stmt) {
                echo json_encode(array("title" => "สำเร็จ!!", "msg" => "ท่านได้สมัครสามาชิกสำเร็จแล้ว!", "status" => "success", "link" => false));
            } else {
                echo json_encode(array("title" => "ไม่สำเร็จ!!", "msg" => "สมัครสามาชิกไม่สำเร็จกรุณาตรวจสอบข้อผิดพลาด!", "status" => "error", "link" => false));
            }
        }
    }
    public function registerAdmin()
    {
        $formData = $_POST["data"];
        $id = $formData['id'];
        $exits = $this->select("users", ["id"], "id = '$id'");
        if (mysqli_num_rows($exits) > 0) {
            echo json_encode(array("title" => "ไม่สำเร็จ!!", "msg" => "ผู้ใช้นี้มีอยู่แล้วกรุณาตรวจสอบ username!", "status" => "error", "link" => true));
        } else {
            $formData['role'] = "admin";
            $formData['password'] = password_hash($formData['password'], PASSWORD_DEFAULT);
            $stmt = $this->insert("users", $formData);
            if ($stmt) {
                echo json_encode(array("title" => "สำเร็จ!!", "msg" => "ท่านได้สมัครสามาชิกสำเร็จแล้ว!", "status" => "success", "link" => false));
            } else {
                echo json_encode(array("title" => "ไม่สำเร็จ!!", "msg" => "สมัครสามาชิกไม่สำเร็จกรุณาตรวจสอบข้อผิดพลาด!", "status" => "error", "link" => false));
            }
        }
    }
    public function addProject()
    {
        $edl = "";

        $postData = $_POST['data'];
        $proj_edl = $postData['proj_edl'];
        switch ($proj_edl) {
            case 'ปวช.3':
                $edl = 'ช3';
                break;
            case 'ปวส.2':
                $edl = 'ส2';
                break;
            case 'ปริญญาตรี':
                $edl = 'ป.ตรี';
                break;
        }
        $amout_proj = $this->select("projects", ["proj_id"], "proj_edl = '$proj_edl'");
        $counter = mysqli_num_rows($amout_proj) + 1;
        if ($counter <= 0) $counter = 1;
        $project_id = $postData['year'] . $edl . "0" . $postData['room'] . "_" . $counter;
        $postData['proj_id'] = $project_id;
        foreach ($postData['prod'] as $value) {
            $stmt = array("user_name" => $value, "project_id" => $project_id);
            $this->insert("product", $stmt);
        }
        if (array_key_exists('prod', $postData) && array_key_exists('room', $postData)) {
            unset($postData['prod']);
            unset($postData['room']);
            $query = $this->insert('projects', $postData);
            if ($query) {
                echo json_encode(array("title" => "สำเร็จ!!", "msg" => "เพิ่มโครงงานสำเร็จแล้ว!", "status" => "success"));
            } else {
                echo json_encode(array("title" => "ไม่สำเร็จ!!", "msg" => "เกิดข้อผิดพลาด ในการเพิ่มโครงงาน!", "status" => "error"));
            }
        }
    }
    public function editProject($id, $postData)
    {

        $stmt = array_combine($postData['id'], $postData['prod']);
        // print_r($postData);
        foreach ($stmt as $key => $value) {

            $prod =  $this->update("product", ["user_name" => $value], " id = $key ");
        }
        if (array_key_exists('prod', $postData) && array_key_exists('id', $postData)) {
            unset($postData['prod']);
            unset($postData['id']);
            $query = $this->update('projects', $postData, "proj_id = '$id'");
        }
        return $query && $prod  ? true : false;
    }
}
