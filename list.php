<?php 
nclude_once('seedstar.php');
include_once('add.php');
$currentTime = date('d-m-Y h:i:s', time());
/*
 * Call Jenkins API
 */
$restRequest = new restRequest(
    'http://127.0.0.1:8080/api/',
    'xml?tree=jobs[name, email, color]'
);
$jenkinsApiAnswer = $restRequest->makeRequest();
/*
 * handle response
 */
if ($jenkinsApiAnswer) {
    foreach ($jenkinsApiAnswer->job as $job) {
        $dbJobs[] = array(
            'job_name' => (string) $job->name,
            'email' => (string) $job->email,
            'status' => (string) $job->color
        );
    }
    if (isset($dbJobs)) {
        $db = new add();
        $db->insertIntoJob($dbJobs, $currentTime);
    }
} ?>