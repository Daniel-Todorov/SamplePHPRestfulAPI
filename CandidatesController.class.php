<?php
/**
 * Created by PhpStorm.
 * User: Daniel Todorov
 * Date: 14-11-13
 * Time: 17:56
 */

class CandidatesController {
    function getCandidatesAll($mysqli){

        $query = 'SELECT * FROM candidates';
        $result= $mysqli->query($query);

        if(!$result){
            throw new Exception('Failed to retrieve candidates from the database.');
        }

        $candidates = [];

        while ($candidate = $result->fetch_assoc()){
            array_push($candidates, $candidate);
        }

        echo json_encode($candidates);
    }

    function  getCandidateById($mysqli, $id){
        $query = 'SELECT * FROM candidates WHERE id = ' . $id;
        $result = $mysqli->query($query);

        if(!$result){
            throw new Exception('Failed to retrieve a candidate from the database.');
        }

        $candidate = $result->fetch_assoc();

        echo json_encode($candidate);
    }
} 