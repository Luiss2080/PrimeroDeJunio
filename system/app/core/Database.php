<?php

/**
 * Clase Database - Manejo de conexión y operaciones de base de datos
 * Sistema PRIMERO DE JUNIO
 */
class Database
{
    private static $instance = null;
    private $pdo;
    private $config;

    private function __construct()
    {
        $this->config = require_once CONFIG_PATH . '/config.php';
        $this->connect();
    }

    /**
     * Obtener instancia singleton
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Conectar a la base de datos
     */
    private function connect()
    {
        try {
            $dsn = "mysql:host={$this->config['database']['host']};dbname={$this->config['database']['name']};charset=utf8mb4";
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
            ];

            $this->pdo = new PDO(
                $dsn,
                $this->config['database']['user'],
                $this->config['database']['password'],
                $options
            );

        } catch (PDOException $e) {
            throw new Exception("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    /**
     * Obtener conexión PDO
     */
    public function getConnection()
    {
        return $this->pdo;
    }

    /**
     * Ejecutar una consulta y obtener un solo resultado
     */
    public function fetch($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetch();
        } catch (PDOException $e) {
            $this->logError($sql, $params, $e);
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }

    /**
     * Ejecutar una consulta y obtener todos los resultados
     */
    public function fetchAll($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            $this->logError($sql, $params, $e);
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }

    /**
     * Ejecutar una consulta INSERT y retornar el ID generado
     */
    public function insert($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            $this->logError($sql, $params, $e);
            throw new Exception("Error al insertar: " . $e->getMessage());
        }
    }

    /**
     * Ejecutar una consulta UPDATE/DELETE
     */
    public function execute($sql, $params = [])
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            $this->logError($sql, $params, $e);
            throw new Exception("Error al ejecutar consulta: " . $e->getMessage());
        }
    }

    /**
     * Iniciar una transacción
     */
    public function beginTransaction()
    {
        return $this->pdo->beginTransaction();
    }

    /**
     * Confirmar transacción
     */
    public function commit()
    {
        return $this->pdo->commit();
    }

    /**
     * Revertir transacción
     */
    public function rollback()
    {
        return $this->pdo->rollback();
    }

    /**
     * Verificar si hay una transacción activa
     */
    public function inTransaction()
    {
        return $this->pdo->inTransaction();
    }

    /**
     * Obtener el último ID insertado
     */
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * Preparar una declaración
     */
    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    /**
     * Escapar una cadena para usar en SQL
     */
    public function quote($string)
    {
        return $this->pdo->quote($string);
    }

    /**
     * Obtener información del servidor de base de datos
     */
    public function getServerInfo()
    {
        return $this->pdo->getAttribute(PDO::ATTR_SERVER_VERSION);
    }

    /**
     * Ping a la base de datos para verificar la conexión
     */
    public function ping()
    {
        try {
            $this->pdo->query('SELECT 1');
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Reconectar si la conexión se perdió
     */
    public function reconnect()
    {
        $this->pdo = null;
        $this->connect();
    }

    /**
     * Ejecutar un archivo SQL (para migraciones)
     */
    public function executeSqlFile($filePath)
    {
        if (!file_exists($filePath)) {
            throw new Exception("Archivo SQL no encontrado: $filePath");
        }

        $sql = file_get_contents($filePath);
        
        if ($sql === false) {
            throw new Exception("No se pudo leer el archivo SQL: $filePath");
        }

        // Dividir por punto y coma para múltiples consultas
        $queries = explode(';', $sql);

        $this->beginTransaction();
        
        try {
            foreach ($queries as $query) {
                $query = trim($query);
                if (!empty($query) && !preg_match('/^--/', $query)) {
                    $this->execute($query);
                }
            }
            $this->commit();
            return true;
        } catch (Exception $e) {
            $this->rollback();
            throw $e;
        }
    }

    /**
     * Obtener esquema de una tabla
     */
    public function getTableSchema($tableName)
    {
        return $this->fetchAll("DESCRIBE " . $this->quote($tableName));
    }

    /**
     * Verificar si una tabla existe
     */
    public function tableExists($tableName)
    {
        $result = $this->fetch(
            "SELECT COUNT(*) as count FROM information_schema.tables 
             WHERE table_schema = ? AND table_name = ?",
            [$this->config['database']['name'], $tableName]
        );
        
        return $result['count'] > 0;
    }

    /**
     * Obtener lista de tablas
     */
    public function getTables()
    {
        return $this->fetchAll(
            "SELECT table_name FROM information_schema.tables 
             WHERE table_schema = ? ORDER BY table_name",
            [$this->config['database']['name']]
        );
    }

    /**
     * Registrar errores de base de datos
     */
    private function logError($sql, $params, $exception)
    {
        $logMessage = [
            'timestamp' => date('Y-m-d H:i:s'),
            'sql' => $sql,
            'params' => $params,
            'error' => $exception->getMessage(),
            'trace' => $exception->getTraceAsString()
        ];

        // Escribir al log si está configurado
        if (isset($this->config['logging']['enabled']) && $this->config['logging']['enabled']) {
            $logFile = $this->config['logging']['path'] . '/database_errors.log';
            file_put_contents($logFile, json_encode($logMessage) . "\n", FILE_APPEND | LOCK_EX);
        }
    }

    /**
     * Destructor para cerrar la conexión
     */
    public function __destruct()
    {
        $this->pdo = null;
    }

    /**
     * Prevenir clonación
     */
    private function __clone() {}

    /**
     * Prevenir unserialize
     */
    public function __wakeup()
    {
        throw new Exception("Cannot unserialize singleton");
    }
}