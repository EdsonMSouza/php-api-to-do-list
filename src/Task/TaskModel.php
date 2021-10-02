<?php

namespace Api\Task;

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

class TaskModel
{

    private static \PDO $pdo;

    /**
     * Model Constructor
     */

    public function __construct()
    {
        self::$pdo = \Api\Database\Database::connection();
    }

    public function create(Task $task): string
    {
        try {
            self::$pdo->beginTransaction();
            $sql = 'INSERT INTO tasks (tasks.userId, tasks.name, tasks.date, tasks.realized)
                    VALUES (:userId, :name, :date, :realized)';

            $stmt = self::$pdo->prepare($sql);
            $stmt->bindValue(':userId', $task->getUserId(), \PDO::PARAM_INT);
            $stmt->bindValue(':name', $task->getName(), \PDO::PARAM_STR);
            $stmt->bindValue(':date', date("Y-m-d"), \PDO::PARAM_STR);
            $stmt->bindValue(':realized', 0, \PDO::PARAM_INT);
            $stmt->execute();

            self::$pdo->commit();
            return true;

        } catch (\PDOException $ex) {
            self::$pdo->rollback();
            throw $ex;
        }
    }

    public function edit(Task $task)
    {
        $sql = 'SELECT tasks.id, tasks.userId, tasks.name, tasks.date, tasks.realized
                FROM tasks WHERE tasks.userId = :userId AND tasks.id = :id';

        $stmt = self::$pdo->prepare($sql);
        $stmt->bindValue(':id', $task->getId(), \PDO::PARAM_INT);
        $stmt->bindValue(':userId', $task->getUserId(), \PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            #return ( bool ) FALSE;
            return "Task not found";
        }
    }

    public function search(Task $task)
    {
        $sql = 'SELECT tasks.id, tasks.userId, tasks.name, tasks.date, tasks.realized
                FROM tasks WHERE tasks.userId = :userId ORDER BY id ASC';

        $stmt = self::$pdo->prepare($sql);
        $stmt->bindValue(':userId', $task->getUserId(), \PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } else {
            #return ( bool ) FALSE;
            return ["message" => "Tasks not found"];
        }
    }

    public function update(Task $task)
    {
        try {
            self::$pdo->beginTransaction();

            $sql = 'UPDATE tasks SET tasks.name=:name, tasks.realized = :realized
                    WHERE tasks.id = :id ';

            $stmt = self::$pdo->prepare($sql);
            $stmt->bindValue(':name', $task->getName(), \PDO::PARAM_STR);
            $stmt->bindValue(':realized', $task->getRealized(), \PDO::PARAM_STR);
            $stmt->bindValue(':id', $task->getId(), \PDO::PARAM_INT);
            $stmt->execute();
            self::$pdo->commit();
            return true;

        } catch (\PDOException $ex) {
            self::$pdo->rollback();
            return false;
        }
    }

    public function delete(Task $task): bool
    {
        try {
            self::$pdo->beginTransaction();

            $sql = "SELECT id FROM tasks WHERE id = :id";
            $stmt = self::$pdo->prepare($sql);
            $stmt->bindValue(':id', $task->getId(), \PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                return false;
            } else {

                $sql = 'DELETE FROM tasks WHERE tasks.id = :id ';
                $stmt = self::$pdo->prepare($sql);
                $stmt->bindValue(':id', $task->getId(), \PDO::PARAM_INT);
                $stmt->execute();
                self::$pdo->commit();
                return true;
            }
        } catch (\PDOException $ex) {
            self::$pdo->rollback();
            return false;
        }
    }
}
