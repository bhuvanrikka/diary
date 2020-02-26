<?php
/**
* @author   Bhuvan Rikka
* @date     26th Feb, 2020
* @copyright    No Copyrights, but please link back in any way
*/

defined('BASEPATH') OR exit('No direct script access allowed');
class Journal extends CI_Controller {
    public function __construct() {
        parent::__construct(); 
        $this->load->helper('url');
        $this->load->model('JournalModel');       
        $this->load->library('session');  
    }

    public function index(){
        //to show alerts
        $data['msg'] = $this->session->flashdata('msg');
        $data['msg_type'] = $this->session->flashdata('msg_type');
        
        $loggedIn = $this->session->userdata('logged_in');
        $this->load->view('templates/header');
        if($loggedIn){
            $this->load->view('journal/index',$data);
        } else {
            $this->load->view('journal/login',$data);
        }       
        $this->load->view('templates/footer');
    }

    /**
    * Function to login
    * 
    */
    public function login(){
        $postVar = $this->input->post();
        if(isset($postVar['username']) && !empty($postVar['password'])){
            
            if($postVar['username'] === "admin" && $postVar['password'] === "admin555"){
                $this->session->set_flashdata('msg', 'Welcome back!');
                $this->session->set_flashdata('msg_type', 'success');
                $this->session->set_userdata('logged_in', TRUE);
            } else {
                $this->session->set_flashdata('msg', 'Please enter valid credentials!');
                $this->session->set_flashdata('msg_type', 'error');
            }
            redirect(base_url('index.php/journal'));
        } else {
            if($this->session->userdata('logged_in')){
                $this->session->set_flashdata('msg', 'Welcome back!');
                $this->session->set_flashdata('msg_type', 'success');
            } else {
                $this->session->set_flashdata('msg', 'Please enter valid credentials!');
                $this->session->set_flashdata('msg_type', 'error');
            }
            redirect(base_url('index.php/journal'));
        }
    }

    /**
     * Function to get journal data
     */
    public function get(){
        $postVar = $this->input->post();
        if(isset($postVar['date']) && !empty($postVar['date'])){
            $journal=new JournalModel;
            $formatted_date = date("Y-m-d", strtotime($postVar['date']));
            
            //hardcoding user id
            $where = "dCreated = '".$formatted_date."' AND iUserID = 5 AND iIsEnabled = 1";
            
            $data['data']=$journal->get_journal($where);
            if(is_array($data['data']) && !empty($data['data'])){
                $response = $this->load->view('journal/list',$data,true);
                echo json_encode($response);
            } else {
                //can add proper json response
                echo false;
            }
        } else {
            echo false;
        }
        exit;
    }

    /**
     * Function to load insert form
     */
    public function create(){
        $this->load->view('templates/header');
        $this->load->view('journal/create');
        $this->load->view('templates/footer');      
    }

    /**
    * Function to insert data
    * 
    */
    public function store(){
        $postVar = $this->input->post();
        if(isset($postVar['text']) && !empty($postVar['text'])){
            $added_date = date("Y-m-d", strtotime($postVar['date']));
            $data = array(
                'tText' => $this->input->post('text'),
                'dCreated' => $added_date,
                'iUserID' => 5 //hardcoded to 5 (considering single user )
            );
            $journal=new JournalModel;
            $insert_id = $journal->insert_journal($data);
            if($insert_id){
                $this->session->set_flashdata('msg', 'Entry added!');
                $this->session->set_flashdata('msg_type', 'success');
            } else {
                $this->session->set_flashdata('msg', 'Something wrong!');
                $this->session->set_flashdata('msg_type', 'error');
            }
            redirect(base_url('index.php/journal'));
        } else {
            $this->session->set_flashdata('msg', 'Error adding data! Data not found. ');
            $this->session->set_flashdata('msg_type', 'error');
            redirect(base_url('index.php/journal'));
        }
    }
    
    /**
    * Function to load edit form
    */
    public function edit($id){
        $id = intval($id);
        if($id && is_int($id)){
            $journal=new JournalModel;
            $data['data']=$journal->get_by_id($id);
            if(is_object($data['data']) && !empty($data['data'])){
                $this->load->view('templates/header');
                $this->load->view('journal/edit',$data);
                $this->load->view('templates/footer');   
            } else {
                $this->session->set_flashdata('msg', "Couldn't fetch data for given id!");
                $this->session->set_flashdata('msg_type', 'error');
                redirect(base_url('index.php/journal'));
            }

            
        } else {
            $this->session->set_flashdata('msg', 'Unknown entry!');
            $this->session->set_flashdata('msg_type', 'error');
            redirect(base_url('index.php/journal'));
        }
    }
    
    /**
    * Function to update data
    *
    */
    public function update($id){
        $postVar = $this->input->post();
        
        if(isset($postVar['text']) && !empty($postVar['text'])){
            $added_date = date("Y-m-d", strtotime($postVar['date']));
            $data = array(
                'tText' => $this->input->post('text'),
                'dCreated' => $added_date
            );
            $id = intval($id);
            $where = "iID = ".$id;
            $journal=new JournalModel;
            $rows = $journal->update_journal($data,$where);
            
            if($rows > 0){
                $this->session->set_flashdata('msg', 'Entry updated!');
                $this->session->set_flashdata('msg_type', 'success');
            } else {
                $this->session->set_flashdata('msg', 'Something wrong!');
                $this->session->set_flashdata('msg_type', 'error');
            }
            
            redirect(base_url('index.php/journal'));
        } else {
            $this->session->set_flashdata('msg', 'Error updating data! Data not found. ');
            $this->session->set_flashdata('msg_type', 'error');
            redirect(base_url('index.php/journal'));
        }
    }
    
    /**
    * Function to disable data
    *
    */
    public function delete($id){
        $id = intval($id);
        if($id && is_int($id)){
            $journal=new JournalModel;
            $rows=$journal->disable($id);
            if($rows>0){
                $this->session->set_flashdata('msg', "Entry disabled!");
                $this->session->set_flashdata('msg_type', 'success');
                redirect(base_url('index.php/journal'));
            } else {
                $this->session->set_flashdata('msg', "Something wrong!");
                $this->session->set_flashdata('msg_type', 'error');
                redirect(base_url('index.php/journal'));
            }
        } else {
            $this->session->set_flashdata('msg', 'Unknown entry!');
            $this->session->set_flashdata('msg_type', 'error');
            redirect(base_url('index.php/journal'));
        }
    }
}