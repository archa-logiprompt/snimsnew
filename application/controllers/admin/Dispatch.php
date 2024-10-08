<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dispatch extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        // $this->load->model("Callfollowup_model");
        $this->load->model("Dispatch_model");
    }

    public function index() {
        if (!$this->rbac->hasPrivilege('postal_dispatch', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'front_office');
        $this->session->set_userdata('sub_menu', 'admin/dispatch');
        $this->form_validation->set_rules('to_title', 'To Title', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['DispatchList'] = $this->Dispatch_model->dispatch_list();
            $this->load->view('layout/header');
            $this->load->view('admin/frontoffice/dispatchview', $data);
            $this->load->view('layout/footer');
        } else {
            $admin=$this->session->userdata('admin');
            $centre_id=$admin['centre_id'];

            $dispatch = array(
                'centre_id'=>$centre_id,
                'reference_no' =>$this->input->post('ref_no'),
                'to_title' =>$this->input->post('to_title'),
                'address' =>$this->input->post('address'),
                'note' =>$this->input->post('note'),
                'from_title' => $this->input->post('from'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'type' => 'dispatch'
            );

            $dispatch_id = $this->Dispatch_model->insert('dispatch_receive', $dispatch);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = 'id' . $dispatch_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/front_office/dispatch_receive/" . $img_name);
                $this->Dispatch_model->image_add('dispatch', $dispatch_id, $img_name);
            }

            $this->session->set_flashdata('msg', '<div class="alert alert-success"> Dispatch added successfully</div>');
            redirect('admin/dispatch');
        }
    }

    function editdispatch($id) {
        if (!$this->rbac->hasPrivilege('postal_dispatch', 'can_edit')) {
            access_denied();
        }

        $this->form_validation->set_rules('to_title', 'To Title', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['DispatchList'] = $this->Dispatch_model->dispatch_list();
            $data['Dispatch_data'] = $this->Dispatch_model->dis_rec_data($id, 'dispatch');
            $this->load->view('layout/header');
            $this->load->view('admin/frontoffice/dispatchedit', $data);
            $this->load->view('layout/footer');
        } else {
            echo $id;

            $dispatch = array(
                'reference_no' => $this->input->post('ref_no'),
                'to_title' => $this->input->post('to_title'),
                'address' => $this->input->post('address'),
                'note' => $this->input->post('note'),
                'from_title' => $this->input->post('from'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'type' => 'dispatch'
            );
            //print_r($dispatch);

            $this->Dispatch_model->update_dispatch('dispatch_receive', $id, 'dispatch', $dispatch);

            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = 'id' . $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/front_office/dispatch_receive/" . $img_name);
                $this->Dispatch_model->image_update('dispatch', $id, $img_name);
            }

            $this->session->set_flashdata('msg', '<div class="alert alert-success"> Dispatch updated successfully</div>');
            redirect('admin/dispatch');
        }
    }

    // function editreceive($id) {
    //     $this->form_validation->set_rules('to_title', 'To Title', 'required');
    //     if ($this->form_validation->run() == FALSE) {
    //     $data['receiveList'] = $this->Dispatch_model->receive_list();
    //     $data['receiveData'] = $this->Dispatch_model->dis_rec_data($id,'receive');
    //     $this->load->view('layout/header');
    //     $this->load->view('admin/frontoffice/receiveedit', $data);
    //     $this->load->view('layout/footer');
    //         }else{
    //             //echo $id;
    //             // print_r($_POST);
    //             //exit();
    //     $receive=array(
    //     'reference_no'=> $this->input->post('ref_no'),
    //     'from_title'=>$this->input->post('from_title'),
    //     'address'=>$this->input->post('address'),
    //     'note'=>$this->input->post('note'),
    //      'to_title'=>$this->input->post('to_title'),
    //     'date'=>date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
    //     'type'=>'receive'
    //   );
    //                  // print_r($receive);
    //                 ///  exit;
    //   $this->Dispatch_model->update_dispatch('dispatch_receive',$id,'receive', $receive);
    //     if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
    //             $fileInfo = pathinfo($_FILES["file"]["name"]);
    //             $img_name =  'id'.$id.'.' . $fileInfo['extension'];
    //             move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/front_office/dispatch_receive/" . $img_name);
    //             $this->Dispatch_model->image_update('dispatch',$id, $img_name);
    //         }
    //         $this->session->set_flashdata('msg', '<div class="alert alert-success"> Receive updated successfully</div>');
    //                  redirect('admin/receive');
    //     }
    // }

    public function download($documents) {
        $this->load->helper('download');
        $filepath = "./uploads/front_office/dispatch_receive/" . $documents;
        $data = file_get_contents($filepath);
        $name = $documents;
        force_download($name, $data);
    }

    public function delete($id) {
        if (!$this->rbac->hasPrivilege('postal_dispatch', 'can_delete')) {
            access_denied();
        }
        //echo $image;
        $this->Dispatch_model->delete($id);
    }

    public function imagedelete($id, $image) {
        $this->Dispatch_model->image_delete($id, $image);
        $this->session->set_flashdata('msg', '<div class="alert alert-success"> Dispatch deleted successfully</div>');
        redirect('admin/dispatch');
    }

    public function details($id, $type) {
        // echo $type;
        // echo $id;
        if (!$this->rbac->hasPrivilege('postal_dispatch', 'can_view')) {
            access_denied();
        }
        $data['data'] = $this->Dispatch_model->dis_rec_data($id, $type);
        // print_r($data['data']);
        //exit();
        $this->load->view('admin/frontoffice/dispacthreceviemodel', $data);
    }

}
