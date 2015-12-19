<?php

namespace Frwoph\Vendors\FrwophPdo;

use PDO;

class FrwophPdo implements FrwophPdoInterface
{

    /**
     * @var PDO
     */
    private $pdo;

    /**
     * Default constructor
     */
    public function __construct($connector, $host, $dbname, $login, $password)
    {
        $this->pdo = new PDO($connector . ':host=' . $host . ';dbname=' . $dbname, $login, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->pdo->setAttribute(PDO::ATTR_PERSISTENT, true);
        $this->pdo->exec('SET NAMES utf8');
    }

    /**
     * Get PDO object
     * @return PDO
     */
    public function getPdo()
    {
        return $this->pdo;
    }

}
