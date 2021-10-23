<?php

namespace Api\Task;

namespace Api\User;

use Api\Task\Task;
use Api\Task\TaskModel;
use Exception;
use PDOException;

require realpath('../../../vendor/autoload.php');
include '../../../src/Helpers/headers.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $headers = apache_request_headers();

            if (!isset($headers['Authorization'])) {
                echo json_encode(['message' => 'Invalid or Missing Token']);

                die();
            }
        } catch (Exception $ex) {
            echo json_encode(['message' => 'Bad Request (Invalid Syntax)']);
            die();
        }

        # Load classes
        try {
            $task = new Task();
            $taskModel = new TaskModel();

            $user = new User();
            $userModel = new UserModel();

        } catch (PDOException $pdo_ex) {
            echo json_encode(['message' => $pdo_ex->getMessage()]);
            die();
        }

        try {
            $user->setToken($headers['Authorization']);
            $ret = $userModel->auth($user);
            if (!$ret) {
                echo json_encode(['message' => 'Token Refused']);
                die;
            } else {
                $task->setUserId($ret[1][0]);
                echo json_encode($taskModel->search($task));
                die();
            }
        } catch (Exception $ex) {
            echo json_encode(['message' => $ex->getMessage()]);
            die;
        }

    } else {
        echo json_encode(['message' => 'Method Not Allowed']);
    }
} catch (Exception $ex) {
    echo json_encode(['message' => $ex->getMessage()]);
    die();
}
