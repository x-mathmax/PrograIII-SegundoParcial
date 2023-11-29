<?php

class AccesoDatos
{
    private static AccesoDatos $objetoAccesoDatos;
    private PDO $objetoPDO;

    private function __construct()
    {
        try {
            $usuario = 'root';
            $clave = '';

            $this->objetoPDO = new PDO('mysql:host=localhost;dbname=jugueteria_bd;charset=utf8', $usuario, $clave);
        } catch (PDOException $e) {
            print "Ha ocurrido un error<br>" . $e->getMessage();
            die();
        }
    }

    public function retornarConsulta(string $sql)
    {
        return $this->objetoPDO->prepare($sql);
    }

    public function retornarUltimoIdInsertado()
    { 
        return $this->objetoPDO->lastInsertId(); 
    }

    public static function obtenerObjetoAccesoDatos(): AccesoDatos
    {
        if (!isset(self::$objetoAccesoDatos)) {
            self::$objetoAccesoDatos = new AccesoDatos();
        }
        return self::$objetoAccesoDatos;
    }

    public function __clone()
    {
        trigger_error('Este objeto no puede ser clonado', E_USER_ERROR);
    }
}
