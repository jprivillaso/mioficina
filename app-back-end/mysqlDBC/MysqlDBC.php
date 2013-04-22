<?php

/**
 * Description of MysqlDBC
 * Clase que provee la conexion directa a la base de datos mysql
 * utilizando las libreria de mysqli que provee php
 * 
 * @author mioficina.co
 */

class MysqlDBC {

    private $connection; // mysql connection
    private $url;
    private $username;
    private $password;
    private $nameDB;

    public function __construct($url = 'localhost', $username = 'sysneyco_oficina', $password = 'oficina123*', $nameDB = 'sysneyco_mioficina') {
        $this->url = $url;
        $this->username = $username;
        $this->password = $password;
        $this->nameDB = $nameDB;
        $this->connect();
    }

    // mysqli connection
    public function connect() {
        $this->connection = mysqli_connect($this->url, $this->username, $this->password, $this->nameDB)
                or $this->mysqlError();
        $this->connection->set_charset("utf8");
    }
    
    public function select($sql) {
        $result = mysqli_query($this->connection, $sql)
                or $this->mysqlErrorQuery($sql);
        return $result;
    }
    

    public function insert($sql) {
        mysqli_query($this->connection, $sql)
                or $this->mysqlErrorQuery($sql);
        return mysqli_insert_id($this->connection);
    }
    
    public function update($sql) {
        mysqli_query($this->connection, $sql)
                or $this->mysqlErrorQuery($sql);
        return mysqli_affected_rows($this->connection);
    }
    
    public function delete($sql) {
        mysqli_query($this->connection, $sql)
                or $this->mysqlErrorQuery($sql);
        return mysqli_affected_rows($this->connection);
    }

    public function mysqlError() {
        Error::sendError(Error::DatabaseC, 
                mysqli_connect_errno(), "Error de conexion:" . mysqli_connect_error());
        die;
    }
    
    public function mysqlErrorQuery($sql) {
        /*Error::sendError(Error::DatabaseC, 
                mysqli_errno($this->connection), mysqli_error($this->connection).":'$sql'");
        mysqli_close($this->connection);
        die;*/
        return 'error';
    }
    
}

?>
