<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dispatch_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_session_name = $this->setting_model->getCurrentSessionName();
        $this->start_month = $this->setting_model->getStartMonth();
    }

    public function insert($table, $data) {
        $this->db->insert($table, $data);
        return $query = $this->db->insert_id();
    }

    public function image_add($type, $dispatch_id, $image) {
        $array = array('id' => $dispatch_id, 'type' => $type);
        $this->db->set('image', $image);
        $this->db->where($array);
        $this->db->update('dispatch_receive');
    }

    public function dispatch_list() {
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->db->select('*');
        $this->db->where('type', 'dispatch');
        $this->db->where('centre_id', $centre_id);
        $this->db->from('dispatch_receive');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function receive_list() {
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->db->select('*');
        $this->db->where('type', 'receive');
        $this->db->where('centre_id', $centre_id);
        $this->db->order_by('id', 'desc');
        $this->db->from('dispatch_receive');
        $query = $this->db->get();
        return $query->result();
    }

    public function dis_rec_data($id, $type) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->where('type', $type);
        $this->db->from('dispatch_receive');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_dispatch($table, $id, $type, $data) {
        $this->db->where('id', $id);
        $this->db->where('type', $type);
        $this->db->update($table, $data);
    }

    public function image_update($type, $id, $img_name) {
        $this->db->set('image', $img_name);
        $this->db->where('id', $id);
        $this->db->where('type', $type);
        $this->db->update('dispatch_receive');
    }

    public function image_delete($id, $img_name) {
        $file = "./uploads/front_office/dispatch_receive/" . $img_name;
        unlink($file);
        $this->db->where('id', $id);
        $this->db->delete('dispatch_receive');
        $controller_name = $this->uri->segment(2);
        $this->session->set_flashdata('msg', '<div class="alert alert-success"> ' . ucfirst($controller_name) . ' deleted successfully</div>');
        redirect('admin/' . $controller_name);
    }

    public function delete($id) {
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->db->where('id', $id);
        $this->db->where('centre_id', $centre_id);
        $this->db->delete('dispatch_receive');
        $controller_name = $this->uri->segment(2);
        $this->session->set_flashdata('msg', '<div class="alert alert-success"> ' . ucfirst($controller_name) . ' deleted successfully</div>');
        redirect('admin/' . $controller_name);
    }

}
