<?php

namespace Api\Task;

namespace Api\User;

use Api\Task\Task;
use Api\Task\TaskModel;
use Exception;
use PDOException;

require realpath('../../../vendor/autoload.php');
include('../../../src/Helpers/headers.php');

try {
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

        try {
            $headers = apache_request_headers();
            $data = json_decode(file_get_contents('php://input'));
            $args = json_decode(file_get_contents('php://input'), TRUE);

            if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                echo json_encode(['message' => 'Payload Precondition Failed']);
                die();
            }

            if (!isset($headers['Authorization'])) {
                echo json_encode(['message' => 'Invalid or Missing Token']);
                die();
            }

            if (sizeof($args) != 3) {
                echo json_encode(['message' => 'Invalid Arguments Number (Expected Three)']);
                die();
            }

        } catch (Exception $ex) {
            echo json_encode(['message' => 'Bad Request (Invalid Syntax)']);
            die();
        }

        $user = new User();
        $userModel = new UserModel();

        $task = new Task();
        $taskModel = new TaskModel();

        try {
            $user->setToken($headers['Authorization']);
            $ret = $userModel->auth($user);
            if (!$ret[0]) {
                echo json_encode(['message' => 'Token Refused']);
                die;
            } else {
                $task->setUserId($ret[1][0]);
            }

        } catch (Exception $ex) {
            echo json_encode(['message' => $ex->getMessage()]);
            die;
        }

        $err = [];
        try {

            (!isset($data->id) ? array_push($err, 1) : null);
            (!isset($data->name) ? array_push($err, 1) : null);
            (!isset($data->realized) ? array_push($err, 1) : null);

            if (sizeof($err) > 0) {
                echo json_encode(['message' => 'Payload Precondition Failed']);
                die();
            }

        } catch (Exception $ex) {
            echo json_encode(['message' => $ex->getMessage()]);
            die;

        }

        try {
            $task->setId(strip_tags($data->id));
            $task->setName(strip_tags($data->name));
            $task->setRealized(strip_tags($data->realized));
            $result = $taskModel->edit($task);

            if ($result != 'Task not found') {
                $update = $taskModel->update($task);

                if ($update) {
                    echo json_encode(['message' => 'Task Successfully Updated']);
                } else {
                    echo json_encode(['message' => 'Could Not Update Task']);
                }

            } else {
                echo json_encode(['message' => 'Task not Found']);
                die();
            }

        } catch (PDOException $e) {
            echo json_encode(['message' => $e->getMessage()]);
            die();

        } catch (Exception $ex) {
            echo json_encode(['message' => $ex->getMessage()]);
            die();
        }

    } else {
        echo json_encode(['message' => 'Method Not Allowed']);
        die();
    }

} catch (Exception $ex) {
    echo json_encode(['message' => $ex->getMessage()]);
    die();
}
