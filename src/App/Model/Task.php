<?php

namespace App\Model;

use PDO;
use Framework\Database;

class Task extends Database
{
    public static function paginated($limit, $offset, $sortableField = null, $direction = null)
    {
        if (!$sortableField) {
            $sortableField = 'name';
            $direction     = 'asc';
        }

        $stmt = static::$connection
            ->prepare(
                "
                    SELECT id, name, email, text, status, is_edited_by_admin 
                        FROM tasks
                    ORDER BY {$sortableField} {$direction}
                        LIMIT :limit OFFSET :offset
                "
            );

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function total()
    {
        return (int) static::$connection
            ->query('SELECT COUNT(*) FROM tasks')
            ->fetchColumn();
    }

    public static function create(array $data)
    {
        static::$connection
            ->prepare('INSERT INTO tasks(name, email, text) VALUES (:name, :email, :text)')
            ->execute($data);
    }

    public static function save(array $data)
    {
        if (!array_key_exists('status', $data)) {
            $data['status'] = 0;
        } else {
            $data['status'] = $data['status'] === 'on' ? 1 : 0;
        }

        static::$connection
            ->prepare('
                UPDATE tasks 
                    SET 
                        name = :name, 
                        email = :email, 
                        text = :text, 
                        status = :status, 
                        is_edited_by_admin = :is_edited_by_admin
                    WHERE id = :id
            ')
            ->execute($data);
    }

    public static function find($id)
    {
        $stmt = static::$connection
            ->prepare(
                "
                    SELECT id, name, email, text, status, is_edited_by_admin 
                        FROM tasks WHERE id = :id
                "
            );

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
