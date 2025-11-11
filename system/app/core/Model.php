<?php

/**
 * Modelo Base del Sistema PRIMERO DE JUNIO
 */
abstract class Model
{
    protected $db;
    protected $table;
    protected $primaryKey = 'id';
    protected $fillable = [];
    
    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Buscar por ID
     */
    public function find($id)
    {
        return $this->db->fetch(
            "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = ?",
            [$id]
        );
    }

    /**
     * Buscar por campo
     */
    public function findBy($field, $value)
    {
        return $this->db->fetch(
            "SELECT * FROM {$this->table} WHERE $field = ?",
            [$value]
        );
    }

    /**
     * Obtener todos los registros
     */
    public function all($orderBy = null)
    {
        $sql = "SELECT * FROM {$this->table}";
        if ($orderBy) {
            $sql .= " ORDER BY $orderBy";
        }
        return $this->db->fetchAll($sql);
    }

    /**
     * Obtener registros con condiciones
     */
    public function where($conditions = [], $orderBy = null)
    {
        if (empty($conditions)) {
            return $this->all($orderBy);
        }

        $whereClause = [];
        $params = [];
        
        foreach ($conditions as $field => $value) {
            if (is_array($value)) {
                // Para condiciones IN
                $placeholders = str_repeat('?,', count($value) - 1) . '?';
                $whereClause[] = "$field IN ($placeholders)";
                $params = array_merge($params, $value);
            } else {
                $whereClause[] = "$field = ?";
                $params[] = $value;
            }
        }
        
        $sql = "SELECT * FROM {$this->table} WHERE " . implode(' AND ', $whereClause);
        if ($orderBy) {
            $sql .= " ORDER BY $orderBy";
        }
        
        return $this->db->fetchAll($sql, $params);
    }

    /**
     * Crear nuevo registro
     */
    public function create($data)
    {
        $data = $this->filterFillable($data);
        
        $fields = array_keys($data);
        $placeholders = str_repeat('?,', count($fields) - 1) . '?';
        
        $sql = "INSERT INTO {$this->table} (" . implode(',', $fields) . ") VALUES ($placeholders)";
        
        return $this->db->insert($sql, array_values($data));
    }

    /**
     * Actualizar registro
     */
    public function update($id, $data)
    {
        $data = $this->filterFillable($data);
        
        $fields = [];
        $params = [];
        
        foreach ($data as $field => $value) {
            $fields[] = "$field = ?";
            $params[] = $value;
        }
        
        $params[] = $id;
        
        $sql = "UPDATE {$this->table} SET " . implode(',', $fields) . " WHERE {$this->primaryKey} = ?";
        
        return $this->db->execute($sql, $params);
    }

    /**
     * Eliminar registro
     */
    public function delete($id)
    {
        return $this->db->execute(
            "DELETE FROM {$this->table} WHERE {$this->primaryKey} = ?",
            [$id]
        );
    }

    /**
     * Contar registros
     */
    public function count($conditions = [])
    {
        if (empty($conditions)) {
            $result = $this->db->fetch("SELECT COUNT(*) as count FROM {$this->table}");
            return (int) $result['count'];
        }

        $whereClause = [];
        $params = [];
        
        foreach ($conditions as $field => $value) {
            $whereClause[] = "$field = ?";
            $params[] = $value;
        }
        
        $sql = "SELECT COUNT(*) as count FROM {$this->table} WHERE " . implode(' AND ', $whereClause);
        $result = $this->db->fetch($sql, $params);
        
        return (int) $result['count'];
    }

    /**
     * Verificar si existe un registro
     */
    public function exists($conditions)
    {
        return $this->count($conditions) > 0;
    }

    /**
     * Obtener el primer registro
     */
    public function first($conditions = [], $orderBy = null)
    {
        $records = $this->where($conditions, $orderBy);
        return !empty($records) ? $records[0] : null;
    }

    /**
     * Paginación
     */
    public function paginate($page = 1, $perPage = 10, $conditions = [], $orderBy = null)
    {
        $offset = ($page - 1) * $perPage;
        
        $whereClause = '';
        $params = [];
        
        if (!empty($conditions)) {
            $conditionParts = [];
            foreach ($conditions as $field => $value) {
                $conditionParts[] = "$field = ?";
                $params[] = $value;
            }
            $whereClause = 'WHERE ' . implode(' AND ', $conditionParts);
        }
        
        $orderClause = $orderBy ? "ORDER BY $orderBy" : '';
        
        $sql = "SELECT * FROM {$this->table} $whereClause $orderClause LIMIT $perPage OFFSET $offset";
        $records = $this->db->fetchAll($sql, $params);
        
        $totalSql = "SELECT COUNT(*) as count FROM {$this->table} $whereClause";
        $total = $this->db->fetch($totalSql, $params)['count'];
        
        return [
            'data' => $records,
            'total' => (int) $total,
            'page' => $page,
            'per_page' => $perPage,
            'total_pages' => ceil($total / $perPage)
        ];
    }

    /**
     * Búsqueda con filtros
     */
    public function listarConFiltros($filtros = [])
    {
        $sql = "SELECT * FROM {$this->table} WHERE 1=1";
        $params = [];
        
        // Búsqueda general
        if (!empty($filtros['buscar'])) {
            $buscar = '%' . $filtros['buscar'] . '%';
            $searchFields = $this->getSearchableFields();
            
            if (!empty($searchFields)) {
                $searchConditions = [];
                foreach ($searchFields as $field) {
                    $searchConditions[] = "$field LIKE ?";
                    $params[] = $buscar;
                }
                $sql .= " AND (" . implode(' OR ', $searchConditions) . ")";
            }
        }
        
        // Filtros específicos
        foreach ($filtros as $campo => $valor) {
            if ($campo !== 'buscar' && !empty($valor) && in_array($campo, $this->fillable)) {
                $sql .= " AND $campo = ?";
                $params[] = $valor;
            }
        }
        
        $sql .= " ORDER BY created_at DESC";
        
        return $this->db->fetchAll($sql, $params);
    }

    /**
     * Filtrar campos permitidos
     */
    protected function filterFillable($data)
    {
        if (empty($this->fillable)) {
            return $data;
        }
        
        return array_intersect_key($data, array_flip($this->fillable));
    }

    /**
     * Obtener campos buscables (sobrescribir en modelos específicos)
     */
    protected function getSearchableFields()
    {
        return ['nombre'];
    }

    /**
     * Verificar si se puede eliminar (sobrescribir en modelos específicos)
     */
    public function puedeEliminar($id)
    {
        return true;
    }
}