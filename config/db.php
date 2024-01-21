<?php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "project");
class Service
{
    public $conn = null;
    public function __construct()
    {
        $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die(mysqli_error($this->conn));
        mysqli_set_charset($this->conn, "utf8");
        // mysqli_close($this->conn);
    }
    public function select($table, $col = [], $where = "1")
    {
        $arg = $col ? implode(',', $col) : "*";
        $sql = "select $arg from $table where $where";
        $query = mysqli_query($this->conn, $sql);
        if ($query) {
            return $query;
        } else {
            die("Query failed: " . mysqli_error($this->conn));
        }
    }
    public function insert($table, $value)
    {
        $sql = "insert into $table (" . implode(',', array_keys($value)) . ") values";
        $sql .= "('" . implode("','", array_values($value)) . "');";
        $query = mysqli_query($this->conn, $sql);
        if ($query) {
            return $query;
        } else {
            die("Query failed: " . mysqli_error($this->conn));
        }
    }
    public function update($table, $col, $where)
    {
        foreach ($col as $cols => $value) {
            $value = "$value";
            $update[] = "$cols = '$value'";
        }
        $arg = implode(',', $update);
        $sql = "update $table set $arg where $where";
        $query = mysqli_query($this->conn, $sql);
        if ($query) {
            return $query;
        } else {
            die("Query failed: " . mysqli_error($this->conn));
        }
    }
    public function delete($table, $where)
    {
        $sql = "delete from $table where $where";
        $query = mysqli_query($this->conn, $sql);
        if ($query) {
            return $query;
        } else {
            die("Query failed: " . mysqli_error($this->conn));
        }
    }
    public function show_order($where = "1")
    {
        $sql = "select *,order_bill.id AS order_id from order_bill inner join user on user.id = order_bill.user_id where $where";
        $query = mysqli_query($this->conn, $sql);
        if ($query) {
            return $query;
        } else {
            die("Query failed: " . mysqli_error($this->conn));
        }
    }
    public function show_order_detail($where = "1")
    {
        $sql = "select *,order_bill.id AS order_id from order_bill inner join order_detail on (order_bill.id = order_detail.order_id) ";
        $sql .= "inner join food on (food.id = order_detail.food_id) where $where";
        $query = mysqli_query($this->conn, $sql);
        if ($query) {
            return $query;
        } else {
            die("Query failed: " . mysqli_error($this->conn));
        }
    }
}
