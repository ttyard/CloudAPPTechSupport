<?php

/**
 *  对数据库常见的操作进行封装
 *
 * @author Administrator
 */
class DBHelper {

    private $db_host;   // 数据库连接地址
    private $db_user;   //  数据库用户名
    private $db_pwd;   // 数据库密码
    private $db_name;  // 数据库名
    private $db_charset;  // 字符集
    private $db_error_code; // 错误代码
    private $lastId;    //最后插入的ID
    private $conn;   // 数据库连接资源

    public function __construct($db_host, $db_user, $db_pwd, $db_name, $db_charset = "utf8") {

        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pwd = $db_pwd;
        $this->db_name = $db_name;
        $this->db_charset = $db_charset;
        
        
        // 执行数据库连接
        $this->getConnection();
    }

    /**
     *  获取数据库连接资源
     */
    public function getConnection() {
        $this->conn = @mysql_connect($this->db_host, $this->db_user, $this->db_pwd) or die("数据库连接失败，请检查MySQL认证信息");     
        //选择数据库
        $res = mysql_select_db($this->db_name, $this->conn);
        if ($res == false) {
            echo "<p style='border:1px solid #ddd; color:#900;'>";
            echo mysql_errno() . "<br/>";
            echo mysql_error();
            echo "</p>";
            exit();
        }
        //设置字符集
        mysql_query("set names $this->db_charset");

        return $this->conn;
    }

    /**
     *    向指定的表中插入数据
     * @param type $table    表名
     * @param type $values   值数组
     */
    public function insert($table,$values = array()) {
        $key_array;
        $val_array;
        foreach ($values as $key => $val) {
            $key_array[] = $key;
            $val_array[$key] = $val;
        }

        // 类型过滤
        $val_array = $this->mysql_type_array($val_array);

        $sql = "insert into {$table}(" . implode(",", $key_array) . ") values(" . implode(",", $val_array) . ")";

        //echo "$sql";exit;
        // 执行
        $res = $this->query($sql);

        // 保存当前的ID
        $this->lastId = mysql_insert_id($this->conn);

        //echo mysql_error();
        //exit;
        // 返回保存結果
        return $res;
    }

    /**
     *  根据条件删除数据
     * @param type $table   表名
     * @param type $where  条件表达式
     */
    public function deleteByCondition($table, $where) {
        $sql = "delete from {$table} where {$where}";
        return $this->query($sql);
    }

    /**
     * 修改
     * @param type $tbname  表名
     * @param type $whre  条件
     * @param type $key_value_array  键值对数组 ("name"=>"Tom","age"=>20)
     * 
     */
    public function update($table, $key_value_array, $where) {
        $key_array;
        $val_array;
        foreach ($key_value_array as $key => $val) {
            echo $key . "==" . $val . "<br>";
            $key_arry[] = $key;
            $val_array[$key] = $val;
        }

        // 类型过滤
        $val_array = $this->mysql_type_array($val_array);

        $set_str;
        $index = 0;
        foreach ($val_array as $key => $val) {
            $set_str[$index++] = $key . "=" . $val;
        }

        // 拼凑sql
        $sql = "update  {$table}  set " . implode(",", $set_str) . " where {$where}";

        // 执行
        $res = $this->query($sql);

        // 返回保存結果
        return $res;
    }

    /**
     * 执行给定的sql语句
     * @param type $sql  传递过来的sql语句
     */
    public function query($sql) {
        return mysql_query($sql, $this->conn);
    }

    /**
     *  获取一条记录
     * @param type $table  表名
     * @param type $colums 类名
     * @param type $condition  条件
     */
    public function getOneReult($table, $colums = " * ", $condition) {
        $sql = "select {$colums} from {$table} where {$condition}";

        $resultSet = $this->query($sql);  // 结果集

        return mysql_fetch_assoc($resultSet);
    }

    /**
     *  获取多条记录
     * @param type $table  表名
     * @param type $condition  条件
     */
    public function getSomeResult($table, $colums=" * ",$condition) {
        $sql = "select {$colums} from {$table} where {$condition}";
      
        $resultSet = $this->query($sql);  // 结果集

        $rows = array();
        while ($row = mysql_fetch_assoc($resultSet)) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * 获取最后插入的主键ID
     */
    public function getLastInsertId() {

        return $this->lastId = mysql_insert_id();
    }

    /**
     *  获取制定查询的总记录数
     * @param type $table  表名
     * @param type $condition  条件
     */
    public function getRecordNum($table, $where = " 1=1 ") {
        $sql = "select count(*) cnt from {$table} where {$where}";
        $resultSet = $this->query($sql);  // 结果集
        $row = mysql_fetch_assoc($resultSet);
        return $row["cnt"];
    }

    /**
     * 显示错误消息
     * @param type $msg    错误消息
     */
    public function showErrorMsg($msg) {
        
    }

    /**
     *   辅助函数：类型匹配
     * @param type $type_array  
     */
    function mysql_type_array($type_array) {
        //var_dump($val_array); exit();
        // 处理类型匹配
        foreach ($type_array as $key => $val) {
            if (!is_int($val) && !is_float($val) && !is_double($val)) {
                $type_array[$key] = "'{$val}'";
            }
        }

        return $type_array;
    }

}

?>
