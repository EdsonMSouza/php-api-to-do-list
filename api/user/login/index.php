<?php

namespace Api\User;

use Exception;
use PDOException;

require realpath('../../../vendor/autoload.php');
include '../../../src/Helpers/headers.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $data = json_decode(file_get_contents('php://input'));
            $args = json_decode(file_get_contents('php://input'), true);

            if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                echo json_encode(['message' => 'Payload Precondition Failed']);
                die();
            }

            if (sizeof($args) != 2) {
                echo json_encode(['message' => 'Invalid Arguments Number (Expected Two)']);
                die();
            }

        } catch (Exception $ex) {
            echo json_encode(['message' => 'Bad Request (Invalid Syntax)']);
            die();
        }

        # Load classes
        try {
            $user = new User();
            $userModel = new UserModel();
        } catch (PDOException $pdo_ex) {
            echo json_encode(['message' => $pdo_ex->getMessage()]);
            die();
        }

        $err = [];
        try {
            (!isset($data->username) ? array_push($err, 1) : null);
            (!isset($data->password) ? array_push($err, 1) : null);

            if (sizeof($err) > 0) {
                echo json_encode(['message' => 'Payload Precondition Failed']);
                die();
            }

        } catch (Exception $ex) {
            echo json_encode(['message' => 'Payload Precondition Failed']);
            die;
        }

        try {
            $user->setUsername(strip_tags($data->username));
            $user->setPassword(strip_tags($data->password));
            $userId = $userModel->login($user);

            if ($userId > 0) {
                $user->setId($userId);
                $search = $userModel->search($user);
                echo json_encode($search);
            } else {
                echo json_encode(['message' => 'Incorrect username and/or password']);
            }
            die();

        } catch (PDOException $e) {
            echo json_encode(['message' => $e->getCode()]);
        }

    } else {
        echo json_encode(['message' => 'Method Not Allowed']);
    }
} catch (Exception $ex) {
    echo json_encode(['message' => $ex->getMessage()]);
    die();
}
