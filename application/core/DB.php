<?php
/**
 * Class Database
 * Object type: singleton
 */
class	DB  {
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $dsn		=	SQL . HOST . PORT . DATABASE;	//	from constants.php
        $user		=	USER;
        $password	=	PASSWORD;
        $this->pdo =	new PDO($dsn, $user, $password);
    }

    public static function getInstance(){
        if(!self::$instance)    {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getPDO()    {
        return $this->pdo;
    }
/*
		}	catch	(PDOException $e) {
		        echo "Критическая ошибка. Не удалось подключится к базе данных сервера."; //   alert to user
		    	file_put_contents('logs/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		        die();
		}
*/
}