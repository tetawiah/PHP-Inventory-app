<?php

class Database
{
    private $pdo;

    private string $hostName = "localhost";
    private string $databaseName = "myapp";
    private string $port = "3306";

    private string $tablename = "";
    private string $selectColumn = "";
    private string $where = "";
    private string $limitBy = "";
    private string $orderby = "";
    private string $groupby = "";
    private string $having = "";

    private function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        $dsn = "mysql:host=$this->hostName;dbname=$this->databaseName;$this->port";
        $this->pdo = new \PDO($dsn, 'user', '', [
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ]);
    }

    public static function table($tablename)
    {
        $db = new self;
        $db->tablename = $tablename;
        return $db;
    }

    private function runQuery(String $query)
    {
        try {
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            return $statement->fetchAll();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function select(...$params)
    {
        $this->selectColumn = "SELECT " . (empty($params) ?  " * " : implode(',', $params));
        return $this;
    }

    public function where($column, $operator, $value)
    {
        $this->where = strlen($this->where) ? " AND $column $operator $value" : " where $column $operator $value";
        return $this;
    }

    public function limit(int $num)
    {
        $this->limitBy = " LIMIT " . $num;
        return $this;
    }


    public function get()
    {
        return $this->runQuery($this->selectColumn . " FROM " . $this->tablename . $this->where . $this->groupby . $this->having . $this->orderby . $this->limitBy);
    }

    public function first()
    {
        return $this->get()[0] ?? null;
    }

    public function orderby($column, $direction = "DESC")
    {
        $this->orderby = " ORDER BY $column $direction";
        return $this;
    }

    public function having($expression)
    {
        $this->having = " HAVING " . $expression;
        return $this;
    }

    public function groupby($column)
    {
        $this->groupby = " GROUP BY $column";
        return $this;
    }

    public function update($array)
    {
        extract($array);
        //UPDATE prodcuts set where id_product = id 

        if (count($array) < 2) {
            $this->runQuery("UPDATE " . $this->tablename . " SET manufacturer_name = " . "'$manufacturer'" .  $this->where);
        }
    
        $this->runQuery("UPDATE " . $this->tablename .  " SET product_name = " . "'$product'" . ", "  . " price = " . "'$price'" . ", " . " stock = " . "'$stock'" . ", " . " editedby = " . "'$email'" . ", " . " updatedAt =" . "'$updatedAt'" . $this->where);
    }

    public function destroy()
    {
        $this->runQuery("DELETE FROM " . $this->tablename . $this->where);
    }

    public function store($params)
    {

        $saveCols = implode(',', array_keys($params));

        foreach (array_values($params) as $val) {
            $valueArray[] = '"' . $val . '"';
        }

        $valueString = implode(',', $valueArray);

        $this->runQuery("INSERT INTO " . $this->tablename . " (" . ($saveCols) . " )" .  " VALUES($valueString)");
    }

    public function updatePassword($email, $hash)
    {
        $this->runQuery("UPDATE " . $this->tablename . " SET password = '$hash' WHERE email = '$email'");
    }

    public function save($prod, $price, $stock, $manf)
    {

        $id_manf = $this->checkid($manf);
        $id_user = $_SESSION['id_user'];

        return $this->runQuery("INSERT INTO " . $this->tablename . "(product_name,price,stock,manufacturer_id,user_id)" . " VALUES ('$prod','$price','$stock','$id_manf','$id_user')");
    }

    private function checkid($manf)
        {

            $row = $this->table('manufacturer')->select('id_manf')->where('manufacturer_name', '=', "'$manf'")->first();
    
            if (empty($row)) {
                $this->runQuery(" INSERT INTO " . "manufacturer " . "( " . "manufacturer_name" . ") " . "VALUES ('$manf')");
                return $this->pdo->lastInsertId();
            } else return $row[$this->selectColumn];
        }
}
