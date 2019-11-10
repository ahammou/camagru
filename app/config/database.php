<?

class Database
{
    private $DB_DSN = "mysql:dbname=testdb;host=127.0.0.1";
    private $DB_USER = "root";
    private $DB_PASSWORD = "";

    public function __construct()
    {
        echo "OK IT WORKS!";
    }
}
