<?php
class DBController
{
    private $host = "localhost";
    private $user = "root";
    private $password = "mysqlKHANH1104";
    private $database = "cvbuilderDB";
    private $port = 3306;
    private $conn;

    function __construct()
    {
        $this->conn = $this->connectDB();
    }

    function __destruct()
    {
        $this->conn->close();
    }

    function closeDB()
    {
        unset($this->conn);
    }

    private function connectDB()
    {
        $conn = mysqli_connect($this->host, $this->user, $this->password, $this->database, $this->port);
        return $conn;
    }

    public function runQuery($query, $param_type, $param_value_array)
    {
        $sql = $this->conn->prepare($query);

        if ($param_type && $param_value_array) {
            $this->bindQueryParams($sql, $param_type, $param_value_array);
        }

        $sql->execute();
        $result = $sql->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }

        if (!empty($resultset)) {
            return $resultset;
        } else {
            return 0;
        }
    }

    public function runQueryJSON($query, $param_type, $param_value_array)
    {
        try {
            $sql = $this->conn->prepare($query);

            if ($param_type && $param_value_array) {
                $this->bindQueryParams($sql, $param_type, $param_value_array);
            }

            $sql->execute();
            $result = $sql->get_result();
            $resultset = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $resultset[] = $row;
                }
            }
            successResponse($resultset, "Successfully");
        } catch (Exception $e) {
            errorResponse($e->getMessage());
        }
    }


    private function bindQueryParams($sql, $param_type, $param_value_array)
    {
        $param_value_reference[] = &$param_type;
        for ($i = 0; $i < count($param_value_array); $i++) {
            $param_value_reference[] = &$param_value_array[$i];
        }
        call_user_func_array(
            array(
                $sql,
                'bind_param'
            ),
            $param_value_reference
        );
    }

    public function runQueryNoResult($query, $param_type, $param_value_array)
    {
        try {
            $sql = $this->conn->prepare($query);
            $this->bindQueryParams($sql, $param_type, $param_value_array);
            $sql->execute();
            successResponse("", "Successfully");
        } catch (Exception $e) {
            errorResponse($e->getMessage());
        }
    }

    public function runQueryNoResult2($query, $param_type, $param_value_array)
    {
        try {
            $sql = $this->conn->prepare($query);
            $this->bindQueryParams($sql, $param_type, $param_value_array);
            $sql->execute();
            // successResponse("", "Successfully");
        } catch (Exception $e) {
            errorResponse($e->getMessage());
        }
    }
}

function validate_data($data)
{
    $data = trim($data);
    return $data;
}

function errorResponse($message)
{
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(array('error' => $message));
}

function successResponse($data, $message)
{
    http_response_code(200);
    header('Content-Type: application/json');
    echo json_encode(array('data' => $data, 'message' => $message));
}
