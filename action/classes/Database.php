<?php
class Database
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '123456';
    private $databaseName = 'saledb';
    private $charset = 'utf8';
    private $conn;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        if(!$this->conn){
            $this->conn = mysqli_connect($this->host,$this->username,$this->password,$this->databaseName);
            if (mysqli_connect_errno()) {
                echo 'Failed: '. mysqli_connect_error();
                die();
            }
            mysqli_set_charset($this->conn,$this->charset);
        }
    }
    public function disConnect()
    {
        if($this->conn){
            mysqli_close($this->conn);
        }
    }

    public function error()
    {
        if($this->conn)
            return mysqli_error($this->conn);
        else
            return false;
    }
    public function insert($table = '', $data = [])
    {
        $keys = '';
        $values= '';
        foreach ($data as $key => $value) {
            $keys .= ',' . $key;
            $values .= ',"' . mysqli_real_escape_string($this->conn,$value).'"';
        }
        $sql = 'INSERT INTO ' .$table . '(' . trim($keys,',') . ') VALUES (' . trim($values,',') . ')';
        return mysqli_query($this->conn,$sql);
    }
    
    public function insert2($table = '', $data = [])
    {
        $keys = '';
        $values= '';
        foreach ($data as $key => $value) {
            $keys .= ',' . $key;
            $values .= ',"' . mysqli_real_escape_string($this->conn,$value).'"';
        }
        $sql = 'INSERT INTO ' .$table . '(' . trim($keys,',') . ') VALUES (' . trim($values,',') . ')';
        if (mysqli_query($this->conn,$sql)) {
            return mysqli_insert_id($this->conn);
        }
        return false;
    }
    /**
     * update sửa dữ liệu
     * @param string $table tên bảng muốn sửa, array $data dữ liệu cần sửa, array|int $id điều kiện
     * @return boolean
     */
    public function update($table = '',$data = [], $id =[])
    {
        $content = '';
        if(is_integer($id))
            $where = 'id = '.$id;
        else if(is_array($id) && count($id)==1){
            $listKey = array_keys($id);
            $where = $listKey[0].'='.$id[$listKey[0]];
        }
        else
            die('Không thể có nhiều hơn 1 khóa chính và id truyền vào phải là số');
        foreach ($data as $key => $value) {
            $content .= ','. $key . '="' . mysqli_real_escape_string($this->conn,$value).'"';
        }
        $sql = 'UPDATE ' .$table .' SET '.trim($content,',') . ' WHERE ' . $where ;
        return mysqli_query($this->conn,$sql);
        //echo $sql;
    }
    /**
     * delete xóa dữ liệu
     * @param string $table tên bảng muốn xóa, array|int điều kiện
     * @return boolean
     */
    public function delete($table= '', $id = [])
    {
        $content = '';
        if(is_integer($id))
            $where = 'id = '.$id;
        else if(is_array($id) && count($id)==1){
            $listKey = array_keys($id);
            $where = $listKey[0].'='.$id[$listKey[0]];
        }
        else
            die('Không thể có nhiều hơn 1 khóa chính và id truyền vào phải là số');
        $sql = 'DELETE FROM ' . $table . ' WHERE '. $where;
        return mysqli_query($this->conn,$sql);
    }
    /**
     * getObject lấy hết dữ liệu trong bảng trả về mảng đối tượng
     * @param string $table tên bảng muốn lấy ra dữ liệu
     * @return array objetc
     */
    public function getObject($table = '')
    {
        $sql = 'SELECT * FROM '. $table;
        $data = null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row = mysqli_fetch_object($result)){
                $data[] = $row;
            }
            mysqli_free_result($result);
            return $data;
        }
        return false;
    }
    /**
     * getObject lấy hết dữ liệu trong bảng trả về mảng dữ liệu
     * @param string $table tên bảng muốn lấy dữ liệu
     * @return array
     */
    public function getArray($table = '')
    {
        $sql = 'SELECT * FROM '. $table;
        $data = null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            mysqli_free_result($result);
            return $data;
        }
        else
            return false;
    }
    /**
     * getRowObject lấy một dòng dữ liệu trong bảng trả về mảng dữ liệu
     * @param string $table tên bảng muốn lấy dữ liệu, array|int $id điều kiện
     * @return object
     */
    public function getRowObject($table = '', $id = [])
    {
        if(is_integer($id))
            $where = 'id = '.$id;
        else if(is_array($id) && count($id)==1){
            $listKey = array_keys($id);
            $where = $listKey[0].'='.$id[$listKey[0]];
        }
        else
            die('Không thể có nhiều hơn 1 khóa chính và id truyền vào phải là số');
        $sql = 'SELECT * FROM '. $table . ' WHERE '. $where;
        
        if($result = mysqli_query($this->conn,$sql)){
            $data = mysqli_fetch_object($result);
            mysqli_free_result($result);
            return $data;
        }
        else
            return false;
    }
    /**
     * getRowArray lấy một dòng dữ liệu trong bảng trả về mảng dữ liệu
     * @param string $table tên bảng muốn lấy dữ liệu, array|int $id điều kiện
     * @return array
     */
    public function getRowArray($table = '', $id = [])
    {
        if(is_integer($id))
            $where = 'id = '.$id;
        else if(is_array($id) && count($id)==1){
            $listKey = array_keys($id);
            $where = $listKey[0].'='.$id[$listKey[0]];
        }
        else
            die('Không thể có nhiều hơn 1 khóa chính và id truyền vào phải là số');
        $sql = 'SELECT * FROM '. $table . ' WHERE '. $where;
        
        if($result = mysqli_query($this->conn,$sql)){
            $data = mysqli_fetch_array($result);
            mysqli_free_result($result);
            return $data;
        }
        else
            return false;
    }
    /**
     * query thực hiện query
     * @param string $sql
     * @return boolean|array
     */
    public function query($sql ='', $return = true)
    {
        if($result = mysqli_query($this->conn,$sql))
        {
            if($return === true){
                while ($row = mysqli_fetch_array($result)) {
                    $data[] = $row;
                }
                mysqli_free_result($result);
                return $data;
            }
            else
                return true;
        }
        else
            return false;
    }

    public function queryy($sql ='', $return = true)
    {
        if($result = mysqli_query($this->conn,$sql))
        {
            if($return === true){
                $row = mysqli_fetch_assoc($result);
                mysqli_free_result($result);
                return $row;
            }
            else
                return true;
        }
        else
            return false;
    }
    public function fetchALL($table){
        $sql = "SELECT * FROM $table";
        $result = mysqli_query($this->conn, $sql) or die("Error query: ".mysqli_error($this->conn));
        $data = [];
        if($result){
            while ($num = mysqli_fetch_assoc($result)) {
                $data[] = $num;
            }
        }
        return $data;
    }
    public function fetchALL_condition($table, $condition, $value){
        $sql = "SELECT * FROM $table WHERE $condition = '$value'";
        $result = mysqli_query($this->conn, $sql) or die("Error query: ".mysqli_error($this->conn));
        //echo $sql;
        $data = [];
        if($result){
            while ($num = mysqli_fetch_assoc($result)) {
                $data[] = $num;
            }
        }
        return $data;
    }
    public function fetchALL_condition_and($table, $condition1, $value1, $condition2, $value2){
        $sql = "SELECT * FROM $table WHERE $condition1 = '$value1' AND $condition2 = '$value2'";
        //echo $sql;
        $result = mysqli_query($this->conn, $sql) or die("Error query: ".mysqli_error($this->conn));
        $data = [];
        if($result){
            while ($num = mysqli_fetch_assoc($result)) {
                $data[] = $num;
            }
        }
        return $data;
    }

    public function fetchALL_condition_and_assoc($table, $condition1, $value1, $condition2, $value2){
        $sql = "SELECT * FROM $table WHERE $condition1 = '$value1' AND $condition2 = '$value2'";
        //echo $sql;
        $result = mysqli_query($this->conn, $sql) or die("Error query: ".mysqli_error($this->conn));
        if($result){
            $value = mysqli_fetch_assoc($result);
        }
        return $value;
    }
    public function countTable($table){
        $sql = "SELECT id FROM  {$table}";
        $result = mysqli_query($this->conn, $sql) or die("Lỗi Truy Vấn countTable----" .mysqli_error($this->conn));
        $num = mysqli_num_rows($result);
        return $num;
    }
    public  function fetchJone($table,$sql ,$page = 0,$limit ,$turn = false ){
        $data = [];
        // _debug($sql);die;
        if ($turn == true){
            $total = $this->countTable($table);
            $sotrang = ceil($total / $limit);
            $start = ($page - 1 ) * $limit ;
            $sql .= " LIMIT $start,$limit";
            $data = [ "page" => $sotrang];
            $result = mysqli_query($this->conn,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->conn));
        }else{
            $result = mysqli_query($this->conn,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->conn));
        }
        if($result){
            while ($num = mysqli_fetch_assoc($result)){
                $data[] = $num;
            }
        }
        // _debug($data);
        return $data;
    }

	public function num_rows($table, $name)
    {
        if ($this->conn)
        {
            $sql = "SELECT * FROM $table WHERE name = '$name'";
            $query = mysqli_query($this->conn, $sql);
            if ($query)
            {
                $row = mysqli_num_rows($query);
                return $row;
            }
        }
    }
    public function num_rows_condition($table, $condition, $value)
    {
        if ($this->conn)
        {
            $sql = "SELECT * FROM $table WHERE $condition = '$value'";
            $query = mysqli_query($this->conn, $sql);
            if ($query)
            {
                $row = mysqli_num_rows($query);
                return $row;
            }
        }
    }
    public function num_rows_condition2($table, $condition1, $value1, $condition2, $value2)
    {
        if ($this->conn)
        {
            $sql = "SELECT * FROM $table WHERE $condition1 = '$value1' AND $condition2 = '$value2'";
            $query = mysqli_query($this->conn, $sql);
            if ($query)
            {
                $row = mysqli_num_rows($query);
                return $row;
            }
        }
    }
    public function numRow_by_id($table, $condition, $id)
    {
        if ($this->conn)
        {
            $sql = "SELECT * FROM $table WHERE $condition = '$id'";
            //echo $sql;
            $query = mysqli_query($this->conn, $sql);
            if ($query)
            {
                $row = mysqli_num_rows($query);
                return $row;
            }
        }
    }
    public function numRow($sql)
    {
        if ($this->conn)
        {
            //echo $sql;
            $query = mysqli_query($this->conn, $sql);
            if ($query)
            {
                $row = mysqli_num_rows($query);
                return $row;
            }
        }
    }
    public function numRow_check($table, $condition, $value, $id){
        if ($this->conn){
            $sql = "SELECT * FROM $table WHERE $condition = '$value' AND id NOT IN('$id')";
            //echo $sql;
            $query = mysqli_query($this->conn, $sql);
            if ($query){
                $row = mysqli_num_rows($query);
                return $row;
            }
        }
    }
    public function reset_pass($table, $id){
        if($this->conn){
            $sql = "UPDATE $table SET password = 'e10adc3949ba59abbe56e057f20f883e' WHERE id = '$id'";
            //echo $sql;
            return mysqli_query($this->conn, $sql);
        }
    }
    public function update_crm($table, $condition,$value, $id){
        if($this->conn){
            $sql = "UPDATE $table SET $condition = '$value' WHERE id = '$id'";
            //echo $sql;
            return mysqli_query($this->conn, $sql);
        }
    }

    public function query_date($date){
        if($this->conn){
        $data = [];
        $sql = "SELECT (date(created_at)) as days, COUNT(*) as 'coun' FROM orders WHERE (date(created_at)) = '$date' GROUP BY (date(created_at));";
            //echo $sql;
            $result = mysqli_query($this->conn, $sql);
            if($result){
                while ($num = mysqli_fetch_assoc($result)){
                    $data[] = $num;
                }
            }
        // _debug($data);
        return $data;
        }
    }
    public function __destruct()
    {
        $this->disConnect();
    }
}