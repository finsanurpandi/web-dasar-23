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

    public function insert($arr = array())
    {
        $this->query = str_replace('SELECT * FROM', 'INSERT INTO', $this->query);

        $columns = '';
        $vals = '';

        foreach($arr as $key => $value)
        {
            $columns .= $key.", ";
            $vals .= "'".$value."', ";
        }

        $this->query .= " (".substr($columns,0, -2).") VALUES (".substr($vals,0, -2).")";

        // echo $this->query;
        // prepare query
        $q = $this->mysqli->prepare($this->query) or die($this->mysqli->error);

        // eksekusi query
        $q->execute();

    }

    public function insert_batch($arr = array())
    {
        $this->query = str_replace('SELECT * FROM', 'INSERT INTO', $this->query);

        $columns = '';
        $vals = '';

        // create columns
        foreach($arr[0] as $key => $value)
        {
            $columns .= $key.", ";
        }

        // create values
        foreach($arr as $value)
        {
            $vals .= "(";

            foreach($value as $val)
            {
                $vals .= "'".$val."', "; 
            }

            $vals = substr($vals, 0, -2);
            $vals .= "), ";
        }

        // create query
        $this->query .= " (".substr($columns,0, -2).") VALUES ".substr($vals, 0, -2);

        echo $this->query;
        // prepare query
        $q = $this->mysqli->prepare($this->query) or die($this->mysqli->error);

        // eksekusi query
        $q->execute();

    }
}

// $db = new Database();
// $db->table('mahasiswa')
//     ->insert([
//         'kelas' => 'B',
//         'kode_prodi' => '55201',
//         'npm' => '123456789',
//         'nama' => 'John Doe',
//     ]);

// $db->table('mahasiswa')
//     ->insert_batch([
//         [
//             'kelas' => 'A',
//             'kode_prodi' => '55201',
//             'npm' => '1234567890',
//             'nama' => 'John Barn',
//         ],
//         [
//             'kelas' => 'B',
//             'kode_prodi' => '55201',
//             'npm' => '9876543210',
//             'nama' => 'John Doe',
//         ],
//         [
//             'kelas' => 'C',
//             'kode_prodi' => '55201',
//             'npm' => '1212121212',
//             'nama' => 'Michael Doe',
//         ]
//     ]);
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