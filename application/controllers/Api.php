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

//List all Zones 
    public function results_get() {
    	$query = $this->db->query("SELECT * FROM results")->result();
        if($query){
    		
            $results[] =[
                "data"=>$query
            ];
        }
         else{
            $results[] = [
                "status"=>FALSE,
                "message"=>"Could not get list of Zones"
            ];
        }
    		$this->response($results, 200);

    }

//List all Zones 
    public function inmates_get() {
    	$query = $this->db->query("SELECT * FROM inmates")->result();
        if($query){
            $zones[] = [
            "status"=>TRUE,
            "message"=>"Retrieved list of Inmates"
            ];

    		
            $zones[] =[
                "data"=>$query
            ];
        }
         else{
            $zones[] = [
                "status"=>FALSE,
                "message"=>"Could not get list of inmates"
            ];
        }
    		$this->response($zones, 200);

    }




// List All Competitions
    public function all_competitions_get() {
    	$filters=array();
    	$limita= NULL;
        $filter='';
    	if($this->get('limit')){
    		$limita = $this->get('limit');
    		$filter = "LIMIT ".$limita;
            $filters[]=["Limit"=>$limita];

    	}
        if($this->get('format')){
            $format = $this->get('format');
            $filters[]=["Format"=>$format];

        }

    	$query = $this->db->query("SELECT * FROM competitions ".$filter);
        if($query->result()){

        	$data[] = [
            	"totalCompetitions" => $this->db->get('competitions')->num_rows(),
            	"Filters"=>$filters
            ];
    		foreach ($query->result() as $row)
    		{
    			//
            $totalMatches = $this->db->get_where('matches', array('m_com_id' => $row->com_id))->num_rows();

            $competitionCountry = $this->db->get_where('countries', array('c_id' => $row->com_c_id))->row();
            $currentSeason = $this->db->query('SELECT cs_id, MAX(cs_name) as cs_name FROM competition_seasons WHERE cs_com_id="'.$row->com_id.'"')->row();
            // $curSeason = $this->db->select_max('cs_name', 'currentSeason')->get_where('competition_seasons', array('cs_com_id' => $row->com_id))->row()->currentSeason;

            $lStart = $this->db->select_min('m_date', 'startDay')->get_where('matches', array('m_com_id' => $row->com_id, 'm_season'=>$currentSeason->cs_name))->row()->startDay;
            if ($lStart){
               $lStart = date("d-m-Y", $lStart); 
            }

            $lEnd = $this->db->select_max('m_date', 'endDay')->get_where('matches', array('m_com_id' => $row->com_id, 'm_season'=>$currentSeason->cs_name))->row()->endDay;
            if ($lEnd !=NULL){
               $lEnd = date("d-m-Y", $lEnd); 
            }

    			$data[] = [
    				"competition" =>[
                        "id" => $row->com_id,
                        "name" => $row->com_name,
                        "currentSeason"=>$currentSeason->cs_name,
                        "totalMatches" => $totalMatches,
                        "seasonStarts" => $lStart,
                        "SeasonEnds" => $lEnd,
        		        "country"=> [
                            "id" => $competitionCountry->c_id,
        		            "name" => $competitionCountry->c_name
                            ]
    		        ]
    		    ];
    		}

            $countries=[
                "status"=>TRUE,
                "message"=>"Retrieved list of Competitions",
                "data"=>$data
            ];
        }
		else{
            $countries = [
                "status"=>FALSE,
                "message"=>"Could not get list of competitions"
            ];
        }
    $this->response($countries, 200);
		

    }


//GEt competitions by Id
 public function inmate_info_get() 
{
 	$cs_id = $this->uri->segment(5);
    if(!empty($cs_id)){
		$row = $this->db->query("SELECT * FROM inmates WHERE id = '".$cs_id."'")->row();
	    if($row != NULL){

	     	$data[]=[
	                "name"=>$row->name,
	                "Date Inprisoned"=>$row->start_date,
	                "Date Freed"=>$row->exit_date,
	                "crime"=>$row->crime,
	                "Zone Inprisoned"=>$row->zone
	     	];
	    }//row

        else {
            $data[] = [

                "status" => FALSE,
                "message" => "No record found for Inmate with ID: ".$cs_id,
            ];

        }
 

       }//If (empty)
            
        

    
        else {
            $inmates = [

                "status" => FALSE,
                "message" => "No cometition ID suplied with request: ",
            ];

            }
		
        $inmates=[
            "status"=>TRUE,
            "message"=>"Retrieved list of Competitions by the competition ID",
            "data"=>$data
        ];
        $this->response($inmates, 200);

}

    //get all competitions from a country:

    function country_competitions_get()
    {
        $c_id = $this->uri->segment(2);
        $result = $this->db->get_where('competitions', array('com_c_id' => $c_id))->result();
         
        if(!$result)
        {
           $this->response(false, 200);
        }
         
        else
        {
           foreach ($result as $row)
			{
				$competitions[] = [

			        "competition_id" => $row->com_id,
			        "competition_name" => $row->com_name
			    ];
			}
			$this->response($competitions, 200);
	        }
	        // $this->response($c_id, 200);
         
    }


    
 }