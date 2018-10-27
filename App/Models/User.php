<?php

namespace App\Models;

use Core\Abstracts\AbstractModel;

/**
 * User Model.
 *
 * @package Models
 * @author Mateusz Kaleta <Mateusz Kaleta@mateusz.kaleta92@gmail.com>
 */
class User extends AbstractModel
{

    /**
     * Returns all users.
     *
     * @return object
     */
    public static function all()
    {
        $db = self::getDatabaseConnection();
        
        $stmt = $db->prepare("SELECT * FROM users");
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_OBJ);

        return $result;
    }

    /**
     * Returns user by id.
     *
     * @param int id
     *
     * @return object
    */
    public static function getById(int $id)
    {
        $db = self::getDatabaseConnection();

        $stmt = $db->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_OBJ);

        return $result;
    }
}
