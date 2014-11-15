<?php
/**
 * Created by PhpStorm.
 * User: Daniel Todorov
 * Date: 14-11-13
 * Time: 17:54
 */

class JobsController {
    function getJobsAll($mysqli){

        $query = 'SELECT * FROM jobs';
        $result= $mysqli->query($query);

        if(!$result){
            throw new Exception('Failed to retrieve jobs from the database.');
        }

        $jobs = [];

        while ($job = $result->fetch_assoc()){
            array_push($jobs, $job);
        }

        echo json_encode($jobs);
    }

    function  getJobById($mysqli, $id){
        $query = 'SELECT * FROM jobs WHERE id = ' . $id;
        $result = $mysqli->query($query);

        if(!$result){
            throw new Exception('Failed to retrieve a job from the database.');
        }

        $job = $result->fetch_assoc();

        echo json_encode($job);
    }
} 