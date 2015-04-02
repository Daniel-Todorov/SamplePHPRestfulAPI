<?php

function __autoload($classname)
{
    include_once("./" . $classname . ".class.php");
}

function parseURI($uri){
    $arguments = preg_split('/\//', $uri, -1, PREG_SPLIT_NO_EMPTY);

    return $arguments;
}

$host = 'localhost';
$username = 'root';
$password = '*****'; //Change this accordingly
$database = 'sampletask';
$mysqli = new mysqli('localhost', 'root', '******', 'sampletask');

if ($mysqli->connect_errno){
    throw new Exception("Failed database connection. " . $mysqli->connect_error);
}

$candidatesController = new CandidatesController();
$jobsController = new JobsController();


$arguments = parseURI($_SERVER['REQUEST_URI']);

switch(strtolower($_SERVER['REQUEST_METHOD'])){
    case 'get':
        switch ($arguments[1]){
            case 'jobs':
                switch($arguments[2]){
                    case 'list':
                        if (is_numeric($arguments[2])){
                            $id = intval($arguments[2]);
                            $jobsController->getJobById($mysqli, $id);
                            http_response_code(200);
                            return;
                        }

                        $jobsController->getJobsAll($mysqli);
                        http_response_code(200);
                        return;
                    default:
                        http_response_code(400);
                        return;
                }
                break;
            case 'candidates':
                switch($arguments[2]){
                    case 'list':
                        $candidatesController->getCandidatesAll($mysqli);
                        http_response_code(200);
                        return;
                    case 'review':
                        if(is_numeric($arguments[3])){
                            $id = intval($arguments[3]);
                            $candidatesController->getCandidateById($mysqli, $id);
                            http_response_code(200);
                            return;
                        }
                    default:
                        http_response_code(400);
                        return;
                }
                break;
            default:
                http_response_code(400);
                break;
        }
        return;
    default:
        http_response_code(400);
        return;
}

