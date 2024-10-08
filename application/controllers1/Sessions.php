<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sessions extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if (!$this->rbac->hasPrivilege('session_setting', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'sessions/index');
        $data['title'] = 'Session List';
        $session_result = $this->session_model->getAllSession();
        $data['sessionlist'] = $session_result;
        $this->load->view('layout/header', $data);
        $this->load->view('session/sessionList', $data);
        $this->load->view('layout/footer', $data);
    }

    function view($id) {
        if (!$this->rbac->hasPrivilege('session_setting', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Session List';
        $session = $this->session_model->get($id);
        $data['session'] = $session;
        $this->load->view('layout/header', $data);
        $this->load->view('session/sessionShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        if (!$this->rbac->hasPrivilege('session_setting', 'can_delete')) {
            access_denied();
        }
        $this->session->set_flashdata('list_msg', '<div class="alert alert-success text-left">Session deleted successfully</div>');
        $this->session_model->remove($id);
        redirect('sessions/index');
    }

    function create() {
        if (!$this->rbac->hasPrivilege('session_setting', 'can_add')) {
            access_denied();
        }
        $session_result = $this->session_model->getAllSession();
        $data['sessionlist'] = $session_result;
        $data['title'] = 'Add Session';
        $this->form_validation->set_rules('session', 'Session', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('session/sessionList', $data);
            $this->load->view('layout/footer', $data);
        } else {
			$admin=$this->session->userdata('admin');
            $data = array(
			'centre_id'=>$admin['centre_id'],
                'session' => $this->input->post('session'),
            );
            $this->session_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Session added successfully</div>');
            redirect('sessions/index');
        }
    }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('session_setting', 'can_edit')) {
            access_denied();
        }
        $session_result = $this->session_model->getAllSession();
        $data['sessionlist'] = $session_result;
        $data['title'] = 'Edit Session';
        $data['id'] = $id;
        $session = $this->session_model->get($id);
        $data['session'] = $session;
        $this->form_validation->set_rules('session', 'Session', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('session/sessionEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'session' => $this->input->post('session'),
            );
            $this->session_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Session updated successfully</div>');
            redirect('sessions/index');
        }
    }

}

?>