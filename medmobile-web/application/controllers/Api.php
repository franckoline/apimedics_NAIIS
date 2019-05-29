<?php
if (isset($_SERVER['HTTP_ORIGIN'])) {

        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");

        header('Access-Control-Allow-Credentials: true');

        header('Access-Control-Max-Age: 86400');    // cache for 1 day

    }

    // Access-Control headers are received during OPTIONS requests

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))

            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");        

       if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))

            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);

    }

require(APPPATH.'/libraries/REST_Controller.php');
require APPPATH . 'libraries/Format.php';
// require APPPATH . '/helpers/MY_url_helper.php';
use Restserver\Libraries\REST_Controller;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Embed\Embed;

// require('application/libraries/REST_Controller.php');

    class Api extends REST_Controller
{
    

    public function __construct() {
    parent::__construct();
    $this->load->model('api_core_model');
    $this->load->model('api_model');
    $this->load->helper('url');

    $this->load->database();
    }

//all results 
    public function results_get() {
    	$query = $this->db->query("SELECT * FROM results")->result();
        if($query){
            foreach ($query as $k) {
                $pat = $this->api_model->user_details($k->pat_id);
                $pat_name = $pat->name;
                $pat_gender = $pat->gender;
                $pat_yob = $pat->yob;

            $results[] =[
                
                "issueID"=>$k->issue_id,
                "issueName"=>$k->issue_name,
                "icdName"=>$k->icd_name,
                "profName"=>$k->prof_name,
                "symptomId"=>$k->symptom_id,
                "patientId"=>$k->pat_id,
                "patientName"=>$pat_name,
                "patientGender"=>$pat_gender,
                "patientYearOfBirth"=>$pat_yob,
                "result"=>$k->diagnosis_result,
                "date"=>date('Y/m/d',strtotime($k->date_created))
            ];

                # code...
        }
            
        }
         else{
            $results[] = [
                "status"=>FALSE,
                "message"=>"Could not get list of Zones"
            ];
        }
    		$this->response($results, 200);

    }

    //valid results

    public function valid_results_get() {
        $query = $this->db->get_where("results", array("diagnosis_result"=>"valid"))->result();
        if($query){
            foreach ($query as $k) {
                $pat = $this->api_model->user_details($k->pat_id);
                $pat_name = $pat->name;
                $pat_gender = $pat->gender;
                $pat_yob = $pat->yob;

            $results[] =[
                
                "issueID"=>$k->issue_id,
                "issueName"=>$k->issue_name,
                "icdName"=>$k->icd_name,
                "profName"=>$k->prof_name,
                "symptomId"=>$k->symptom_id,
                "patientId"=>$k->pat_id,
                "patientName"=>$pat_name,
                "patientGender"=>$pat_gender,
                "patientYearOfBirth"=>$pat_yob,
                "result"=>$k->diagnosis_result,
                "date"=>date('Y/m/d',strtotime($k->date_created))
            ];

                # code...
        }
            
        }
         else{
            $results[] = [
                "status"=>FALSE,
                "message"=>"Could not get list of Zones"
            ];
        }
            $this->response($results, 200);

    }

     //Invalid results

    public function invalid_results_get() {
        $query = $this->db->get_where("results", array("diagnosis_result"=>"invalid"))->result();
        if($query){
            foreach ($query as $k) {
                $pat = $this->api_model->user_details($k->pat_id);
                $pat_name = $pat->name;
                $pat_gender = $pat->gender;
                $pat_yob = $pat->yob;

            $results[] =[
                
                "issueID"=>$k->issue_id,
                "issueName"=>$k->issue_name,
                "icdName"=>$k->icd_name,
                "profName"=>$k->prof_name,
                "symptomId"=>$k->symptom_id,
                "patientId"=>$k->pat_id,
                "patientName"=>$pat_name,
                "patientGender"=>$pat_gender,
                "patientYearOfBirth"=>$pat_yob,
                "result"=>$k->diagnosis_result,
                "date"=>date('Y/m/d',strtotime($k->date_created))
            ];

                # code...
        }
            
        }
         else{
            $results[] = [
                "status"=>FALSE,
                "message"=>"Could not get list of Zones"
            ];
        }
            $this->response($results, 200);

    }



    
 }