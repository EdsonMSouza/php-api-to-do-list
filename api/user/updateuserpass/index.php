<?php

namespace Api\User;

use Exception;
use PDOException;

require realpath('../../../vendor/autoload.php');
include '../../../src/Helpers/headers.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

        try {
            $headers = apache_request_headers();
            $data = json_decode(file_get_contents('php://input'));
            $args = json_decode(file_get_contents('php://input'), true);

            if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                echo json_encode(['message' => 'Payload Precondition Failed']);
                die();
            }

            # Verify Header Authorization Field
            if (!isset($headers['Authorization'])) {
                echo json_encode(['message' => 'Invalid or Missing Token']);
                die();
            }

            if (sizeof($args) != 4) {
                echo json_encode(['message' => 'Invalid Arguments Number (Expected Four)']);
                die();
            }

        } catch (Exception $ex) {
            echo json_encode(['message' => 'Bad Request (Invalid Syntax)']);
            die();
        }

        # Loads: User and UserModel
        $user = new User();
        $userModel = new UserModel();

        try {
            if (!$userModel->auth($user->setToken($headers['Authorization']))[0]) {
                echo json_encode(['message' => 'Token Refused']);
                die;
            }

        } catch (Exception $ex) {
            echo json_encode(['message' => $ex->getMessage()]);
            die;
        }

        $err = [];
        try {

            (!isset($data->username) ? array_push($err, 1) : null);
            (!isset($data->password) ? array_push($err, 1) : null);

            (!isset($data->new_username) ? array_push($err, 1) : null);
            (!isset($data->new_password) ? array_push($err, 1) : null);

            if (sizeof($err) > 0) {
                echo json_encode(['message' => 'Payload Precondition Failed']);
                die();
            }

        } catch (Exception $ex) {
            echo json_encode(['message' => $ex->getMessage()]);
            die;

        }

        try {
            $user->setUsername(strip_tags($data->username));
            $user->setPassword(strip_tags($data->password));
            $userId = $userModel->login($user);

            if ($userId > 0) {
                $user->setId($userId);
                $user->setUserName(strip_tags($data->new_username));
                $user->setPassword(strip_tags($data->new_password));
                $update = $userModel->updateUserPassword($user);

                if ($update) {
                    echo json_encode(['message' => 'Username/password Successfully Updated']);
                } else {
                    echo json_encode(['message' => 'Could Not Update username/password']);
                }

            } else {
                echo json_encode(['message' => 'Incorrect username and/or password']);
            }
            die();

        } catch (PDOException $e) {
            echo json_encode(['message' => $e->getCode()]);
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
