<?php

namespace Api\User;

use Api\Database\Database;
use Exception;
use PDO;
use PDOException;

class UserModel
{

    private static PDO $pdo;

    /**
     * Model Constructor
     */
    public function __construct()
    {
        self::$pdo = Database::connection();
    }

    /**
     * Token Verify
     */

    public function auth(User $user): array
    {
        $sql = 'SELECT users.id FROM users
                WHERE users.token = :token';

        $stmt = self::$pdo->prepare($sql);
        $stmt->bindValue(':token', $user->getToken());
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            return [true, $stmt->fetch()];
        } else {
            return [false];
        }
    }

    /**
     * Login
     */

    public function login(User $user)
    {
        $sql = 'SELECT users.id FROM users
                WHERE users.username = :username AND users.password = :password';
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindValue(':username', md5($user->getUsername()));
        $stmt->bindValue(':password', md5($user->getPassword()));
        $stmt->execute();
        return $stmt->rowCount() == 1 ? $stmt->fetch(PDO::FETCH_ASSOC)['id'] : false;
    }

    /**
     * Checks if a user already exists
     */

    public function isUser(User $user)
    {
        $sql = 'SELECT users.id FROM users
                WHERE users.username = :username';

        $stmt = self::$pdo->prepare($sql);
        $stmt->bindValue(':username', md5($user->getUsername()));
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            return $stmt->fetch(PDO::FETCH_ASSOC)['id'];
        } else {
            return 0;
        }
    }

    /**
     * Search user by idKey
     */

    public function search(User $user)
    {
        $sql = 'SELECT users.id, users.name, users.email, users.token, users.picture
                FROM users WHERE users.id = :id';

        $stmt = self::$pdo->prepare($sql);
        $stmt->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    /**
     * New User
     * @throws Exception
     */

    public function create(User $user): array
    {
        try {
            $token = strtoupper(bin2hex(random_bytes(10)));

            self::$pdo->beginTransaction();

            $sql = 'INSERT INTO users (users.name, users.email, users.username, users.password, users.token)
                    VALUES (:name, :email, :username, :password, :token)';

            $stmt = self::$pdo->prepare($sql);
            $stmt->bindValue(':name', $user->getName());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':username', md5($user->getUsername()));
            $stmt->bindValue(':password', md5($user->getPassword()));
            $stmt->bindValue(':token', $token);
            $stmt->execute();

            $userId = (int)self::$pdo->lastInsertId();
            self::$pdo->commit();

            return [true, $userId, $token];

        } catch (PDOException $ex) {
            self::$pdo->rollback();
            throw $ex;
        }
    }

    /**
     * Update User data
     */

    public function update(User $user): bool
    {
        try {
            self::$pdo->beginTransaction();

            $sql = 'UPDATE users SET users.name = :name, users.email = :email, users.picture = :picture
                    WHERE users.id = :id AND users.token = :token';

            $stmt = self::$pdo->prepare($sql);
            $stmt->bindValue(':name', $user->getName());
            $stmt->bindValue(':email', $user->getEmail());
            $stmt->bindValue(':picture', $user->getPicture());
            $stmt->bindValue(':id', $user->getId(), PDO::PARAM_INT);
            $stmt->bindValue(':token', $user->getToken(), PDO::PARAM_INT);
            $stmt->execute();

            self::$pdo->commit();

            return true;

        } catch (PDOException $ex) {
            self::$pdo->rollback();
            throw $ex;
        }
    }

    /**
     * Update User data (username and password)
     */

    public function updateUserPassword(User $user): bool
    {
        try {
            self::$pdo->beginTransaction();

            $sql = 'UPDATE users SET users.username = :username, users.password = :password 
                    WHERE users.id = :id AND users.token = :token';

            $stmt = self::$pdo->prepare($sql);
            $stmt->bindValue(':username', md5($user->getUsername()));
            $stmt->bindValue(':password', md5($user->getPassword()));
            $stmt->bindValue(':id', $user->getId());
            $stmt->bindValue(':token', $user->getToken());
            $stmt->execute();

            self::$pdo->commit();

            return true;

        } catch (PDOException $ex) {
            self::$pdo->rollback();
            throw $ex;
        }
    }

    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool
    {
        try {
            self::$pdo->beginTransaction();
            $sql = 'DELETE FROM users WHERE users.id = :id ';
            $stmt = self::$pdo->prepare($sql);
            $stmt->bindValue(':id', $user->getId(), PDO::PARAM_INT);
            $stmt->execute();
            self::$pdo->commit();
            return true;

        } catch (PDOException $ex) {
            self::$pdo->rollback();
            return false;
        }
    }
}