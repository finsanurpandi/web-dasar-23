<?php

define('DB_HOST', '127.0.0.1:3307');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'dpw_if23');

class Database
{
    protected $mysqli;
    protected $query;

    public function __construct()
    {
        $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($this->mysqli->connect_errno) {
            echo "Failed to connect to MySql ". $this->mysqli->connect_error;
        }
    }

    public function table($table)
    {
        $this->query = "SELECT * FROM $table";
        return $this;
    }

    public function where($arr = array())
    {
        $sql = ' WHERE ';

        if(count($arr) == 1) {
            foreach($arr as $key => $value) {
                $sql .= $key .' = '. $value;
            }
        } else {
            foreach($arr as $key => $value) {
                $sql .= $key ." = '". $value. "' AND ";
            }
            $sql = substr($sql, 0, -5);
        }

        $this->query .= $sql;
        return $this;
    }

    public function select(...$arr)
    {
        $sql = '';
       
        foreach($arr as $value) {
            $sql .= $value.", ";
        }
        $sql = substr($sql, 0, -2);

        $this->query = str_replace('*', $sql, $this->query);
        return $this;
    }

    public function orderBy($arr = array())
    {
        $sql = ' ORDER BY ';
        
        foreach($arr as $key => $value) {
            $sql .= $key .' '. $value. ', ';
        }
        $sql = substr($sql, 0, -2);

        $this->query .= $sql;
        return $this;
    }

    public function get()
    {
        $result = $this->mysqli->query($this->query);

        return $result->fetch_all(MYSQLI_ASSOC);
        // echo $this->query;
    }
}

// $db = new Database();
// $mhs = $db->table('mahasiswa')
//     ->where([
//         'kode_prodi' => '55201',
//     ])
//     ->get();

// echo "<pre>";
// print_r($mhs);
// echo "</pre>";



// foreach($mhs as $value) {
//     echo $value['npm']. '| '. $value['nama']. '|'. $value['kelas']. '| '.$value['kode_prodi']. '<br>';
// }