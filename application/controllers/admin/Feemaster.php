<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feemaster extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        // if(!$this->rbac->hasPrivilege('fees_master','can_add')){
        //        access_denied();
        //        }
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'admin/feemaster');
        $data['title'] = 'Feemaster List';
        $feegroup = $this->feegroup_model->get();
        $data['feegroupList'] = $feegroup;
        $feetype = $this->feetype_model->get();
        $data['feetypeList'] = $feetype;
		
        $feegroup_result = $this->feesessiongroup_model->getFeesByGroup();
 
        $data['feemasterList'] = $feegroup_result;

        $this->form_validation->set_rules('feetype_id', 'FeeType', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required');
		 //$this->form_validation->set_rules('year', 'year', 'required');


         $this->form_validation->set_rules(
                'fee_groups_id', 'FeeGroup', array(
            'required',
            array('check_exists', array($this->feesessiongroup_model, 'valid_check_exists'))
                )
        );
		
      
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $admin=$this->session->userdata('admin');
            $centre_id=$admin['centre_id'];
			
			if($this->input->post('is_active_student_img') == 1)  
				 {  

				 $addfine = $this->input->post('is_active_student_img');
                 $amount = $this->input->post('amount');
                 $finetype = $this->input->post('finetype_id');
				 $amounttype = $this->input->post('amounttype_id');
				 $fixedamount = $this->input->post('fixedamount');
				 $percentage = $this->input->post('percentage');

            } else {
                $addfine = 0;
                $finetype = 0;
				$amounttype=0;
				$fixedamount = 0;
                $percentage = 0;
				$amount=0;
				
            }
            $insert_array = array(
                'centre_id'=>$centre_id,
                'fee_groups_id' => $this->input->post('fee_groups_id'),
                'feetype_id' => $this->input->post('feetype_id'),
                'amount' => $this->input->post('amount'),
				//'year' => $this->input->post('year');
                'due_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('due_date'))),
                'session_id' => $this->setting_model->getCurrentSession(), 
			    'amounttype'=>$amounttype,
				'finetype'=>$finetype,
				'fixedamount'=>$fixedamount,
				'percentage'=>$percentage,
				'addfine'=>$addfine,
           );
            $feegroup_result = $this->feesessiongroup_model->add($insert_array);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Fees Master added successfully</div>');
            redirect('admin/feemaster/index');
        }

        $this->load->view('layout/header', $data);
        $this->load->view('admin/feemaster/feemasterList', $data);
        $this->load->view('layout/footer', $data);
    }
    public function editquota($id)
    {
       
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'admin/feemaster/admission_quota');
        $data['title'] = 'Feemaster List';
        $feeyear = $this->feemaster_model->getfeeyear();
        $data['feeyearlist'] = $feeyear;
    
        $class = $this->class_model->get();
		$data['classlist'] = $class;
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $admission_quota_id = $this->feegroup_model->getquotalistbasedonid($id);
        $data['admission_quota_id']=$admission_quota_id;
        $data['id'] = $id;
       
        $this->form_validation->set_rules('year', 'Year', 'trim|required|xss_clean'); 
        $this->form_validation->set_rules('name','Name','is_unique[admision_quota.name]'); 
        if ($this->form_validation->run() == FALSE) {
            
        } 
        else{

            $result = array(
                'centre_id'=>$centre_id,
                'name' => $this->input->post('name'),
                'year'=>$this->input->post('year'),
                'id' => $id,
                'class_id'=>$this->input->post('class_id'),
                'section_id'=>$this->input->post('section_id'),
                'description' => $this->input->post('description'),
            );
        }
        
    
        $this->feegroup_model->addquota($result);
        $admission_quota = $this->feegroup_model->getquotalist();
    
        $data['admissionquotalist'] = $admission_quota;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/feemaster/editadmissionquota', $data);
        $this->load->view('layout/footer', $data);

    }

    public function admission_quota()
    {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'admin/feemaster/admission_quota');
        $data['title'] = 'Feemaster List';
        $feeyear = $this->feemaster_model->getfeeyear();
        $data['feeyearlist'] = $feeyear;
    
        $class = $this->class_model->get();
		$data['classlist'] = $class;
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->form_validation->set_rules('year', 'Year', 'trim|required|xss_clean'); 
        $this->form_validation->set_rules('name','Name','is_unique[admision_quota.name]'); 
        if ($this->form_validation->run() == FALSE) {
            
        } 
        else{

            $result = array(
                'centre_id'=>$centre_id,
                'name' => $this->input->post('name'),
                'year'=>$this->input->post('year'),
                
                'class_id'=>$this->input->post('class_id'),
                'section_id'=>$this->input->post('section_id'),
                'description' => $this->input->post('description'),
            );
        }
        $this->feegroup_model->addquota($result);
        $admission_quota = $this->feegroup_model->getquotalist();

        $data['admissionquotalist'] = $admission_quota;
        
        $this->load->view('layout/header', $data);
        $this->load->view('admin/feemaster/admissionquota', $data);
        $this->load->view('layout/footer', $data);
    }

    public function editadmissionfees($id)
    {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'admin/feemaster/admission_fees_master');
        $data['title'] = 'Feemaster List';
        $feegroup = $this->feegroup_model->get();
        $data['feegroupList'] = $feegroup;
        $feetype = $this->feetype_model->get();
        $data['feetypeList'] = $feetype;
        $admission_quota = $this->feegroup_model->getquotalist();
        $data['admissionquotalist'] = $admission_quota;
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $data['id']=$id;
        $editadmissionfeelist = $this->feegroup_model->getadmissionlisttoedit($id);
        $data['editadmissionfeelist'] = $editadmissionfeelist;
        $this->form_validation->set_rules('fee_groups_id', 'Fees Group', 'trim|required|xss_clean'); 
        // $this->form_validation->set_rules('feetype_id', 'Fee Type', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('due_date', 'Due Date', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            
        } 
        else
        {


            
            
            
                $result=array(
                        'centre_id'=>$centre_id,
                        'fee_groups_id' =>$this->input->post('fee_groups_id'),
                        'feetype_id' => $this->input->post('feetype_id'),
                        'id'=>$this->input->post('id'),
                        'due_date' =>  $this->input->post('due_date'),
                        'amount' => $this->input->post('amount'),
                );
                $feegroup_result = $this->feesessiongroup_model->addadmissionfees($result) ;
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Admission Fees added successfully</div>');
            //    return redirect('admin/feemaster/admission_fees_master');
            
            
        }
        // var_dump($_SESSION);exit;
        $admission_quota = $this->feegroup_model->getquotalist();
        $data['admissionquotalist'] = $admission_quota;
        $admissionfeeslist = $this->feegroup_model->getadmissionlist();
        $data['admissionfeeslist'] = $admissionfeeslist;
        $arr=array();
        foreach($admissionfeeslist as $key=>$value)
        {
            $arr[$key]=$this->db->select('admissionfees.*,admision_quota.*,feetype.*,admissionfees.id as aid')->from('admissionfees')->join('feetype','feetype.id=admissionfees.feetype_id')->join('admision_quota','admision_quota.id=admissionfees.fee_groups_id')->where('admision_quota.id',$value['id'])->get()->result_array();
           
            
        }
        $data['arr']= $arr;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/feemaster/editadmissionfees', $data);
        $this->load->view('layout/footer', $data);
       
    }
    public function admission_fees_master()
    {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'admin/feemaster/admission_fees_master');
        $data['title'] = 'Feemaster List';
        $feegroup = $this->feegroup_model->get();
        $data['feegroupList'] = $feegroup;
        $feetype = $this->feetype_model->get();
        $data['feetypeList'] = $feetype;
        $admission_quota = $this->feegroup_model->getquotalist();
        $data['admissionquotalist'] = $admission_quota;
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->form_validation->set_rules('fee_groups_id', 'Fees Group', 'trim|required|xss_clean'); 
        $this->form_validation->set_rules('feetype_id', 'Fee Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('due_date', 'Due Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
           
        } 
        else
        {

            $fee_group_id=$this->input->post('fee_groups_id');
            $feetype=$this->input->post('feetype_id');

            $check=$this->feesessiongroup_model->admissionfeescheck( $fee_group_id,  $feetype);
            if($check)
            {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">The combination of Fees Group and Fee Type already exists.</div>');
            }
            else
            {
                $result=array(
                        'centre_id'=>$centre_id,
                        'fee_groups_id' =>  $fee_group_id,
                        'feetype_id' => $feetype,
                        
                        'due_date' =>  $this->input->post('due_date'),
                        'amount' => $this->input->post('amount'),
                );

                $feegroup_result = $this->feesessiongroup_model->addadmissionfees($result) ;
                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Admission Fees added successfully</div>');
            //    return redirect('admin/feemaster/admission_fees_master');
            }
            
        }
        // var_dump($_SESSION);exit;
        $admission_quota = $this->feegroup_model->getquotalist();
        $data['admissionquotalist'] = $admission_quota;
        $admissionfeeslist = $this->feegroup_model->getadmissionlist();
        $data['admissionfeeslist'] = $admissionfeeslist;
        $arr=array();
        foreach($admissionfeeslist as $key=>$value)
        {
            $arr[$key]=$this->db->select('admissionfees.*,admision_quota.*,feetype.*,admissionfees.id as aid')->from('admissionfees')->join('feetype','feetype.id=admissionfees.feetype_id')->join('admision_quota','admision_quota.id=admissionfees.fee_groups_id')->where('admision_quota.id',$value['id'])->get()->result_array();
           
            
        }
        $data['arr']= $arr;
        
        $this->load->view('layout/header', $data);
        $this->load->view('admin/feemaster/admissionfees', $data);
        $this->load->view('layout/footer', $data);
       
    }
    function delete($id) {
        if (!$this->rbac->hasPrivilege('fees_master', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Fees Master List';
        $this->feegrouptype_model->remove($id);
        redirect('admin/feemaster/index');
    }

    function deletegrp($id) {
        $data['title'] = 'Fees Master List';
        $this->feesessiongroup_model->remove($id);
        redirect('admin/feemaster');
    }
    function deletequota($id)
    {
        $data['title'] = 'Fees Master List';
        $this->feesessiongroup_model->deletequota($id);
        redirect('admin/feemaster/admission_quota');
    }

    function deleteadmissionfees($id) {
        $data['title'] = 'Fees Master List';
        $this->feesessiongroup_model->removeadmissionfees($id);
        redirect('admin/feemaster/admission_fees_master');
    }
    function edit($id) {
        if (!$this->rbac->hasPrivilege('fees_master', 'can_edit')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'admin/feemaster');
        $data['id'] = $id;
        $feegroup_type = $this->feegrouptype_model->get($id);
        $data['feegroup_type'] = $feegroup_type;

        $feegroup = $this->feegroup_model->get();
        $data['feegroupList'] = $feegroup;
        $feetype = $this->feetype_model->get();
        $data['feetypeList'] = $feetype;
        $feegroup_result = $this->feesessiongroup_model->getFeesByGroup();
        $data['feemasterList'] = $feegroup_result;
	     /*$feeyear = $this->feemaster_model->getfeeyear();
         $data['feeyearlist'] = $feeyear;*/

        $this->form_validation->set_rules('feetype_id', 'FeeType', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required');
		
        $this->form_validation->set_rules(
                'fee_groups_id', 'FeeGroup', array(
            'required',
            array('check_exists', array($this->feesessiongroup_model, 'valid_check_exists'))
                )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/feemaster/feemasterEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
			
			if($this->input->post('is_active_student_img') == 1)  
				 {  
				 $addfine = $this->input->post('is_active_student_img');
                 $amount = $this->input->post('amount');
                 $finetype = $this->input->post('finetype_id');
				 $amounttype = $this->input->post('amounttype_id');
				 
				 if ($amounttype == 'Fixed Amount' ) {
                
				 $fixedamount = $this->input->post('fixedamount');
				  $percentage = 0;
            } else{
                
				 $percentage = $this->input->post('percentage');
            	 $fixedamount = 0;
			}
				 
				  
            } else {
                $addfine = 0;
                $finetype = 0;
				$amounttype=0;
				$fixedamount = 0;
                $percentage = 0;
				$amount=0;
				
            }
			
			
            $insert_array = array(
                'id' => $this->input->post('id'),
                'feetype_id' => $this->input->post('feetype_id'),
                'due_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('due_date'))),
                'amount' => $this->input->post('amount'),
				'amounttype'=>$amounttype,
				 'finetype'=>$finetype,
				 'fixedamount'=>$fixedamount,
				 'percentage'=>$percentage,
				 'addfine'=>$addfine,
            );
            $feegroup_result = $this->feegrouptype_model->add($insert_array);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Fees Master updated successfully</div>');
            redirect('admin/feemaster/index');
        }
    }

    function assign($id) {
        if (!$this->rbac->hasPrivilege('fees_group_assign', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'admin/feemaster');
        $data['id'] = $id;
        $data['title'] = 'student fees';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $feegroup_result = $this->feesessiongroup_model->getFeesByGroup($id); 
        $data['feegroupList'] = $feegroup_result;


        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $RTEstatusList = $this->customlib->getRteStatus();
        $data['RTEstatusList'] = $RTEstatusList;

        $category = $this->category_model->get();
        $data['categorylist'] = $category;

        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $data['category_id'] = $this->input->post('category_id');
            $data['gender'] = $this->input->post('gender');
            $data['rte_status'] = $this->input->post('rte');
            $data['class_id'] = $this->input->post('class_id');
            $data['section_id'] = $this->input->post('section_id');

            $resultlist = $this->studentfeemaster_model->searchAssignFeeByClassSection($data['class_id'], $data['section_id'], $id, $data['category_id'], $data['gender'], $data['rte_status']);
            $data['resultlist'] = $resultlist;
        }

        $this->load->view('layout/header', $data);
        $this->load->view('admin/feemaster/assign', $data);
        $this->load->view('layout/footer', $data);
    }

    function hostelfeemaster() { 
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'admin/feemaster/hostelfeemaster');
        $data['title'] = 'Feemaster List';
        $admin=$this->session->userdata('admin');

        $hostel_rooms = $this->db->where('centre_id',$admin['centre_id'])->get('hostel_rooms')->result();
 
 
        $data['hostel_rooms'] = $hostel_rooms;

        

        $this->load->view('layout/header', $data);
        $this->load->view('admin/feemaster/feemasterListHostel', $data);
        $this->load->view('layout/footer', $data);
    }

    
    function hostelassign($id) {
        if (!$this->rbac->hasPrivilege('hostel_fee_master', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'admin/feemaster/hostelfeemaster');
        $data['id'] = $id;
        $data['title'] = 'student fees';
        $class = $this->class_model->get();

        $data['classlist'] = $class;
        $feegroup_result = $this->feesessiongroup_model->getHostelFeesByGroup($id); 
        
        // var_dump($this->db->last_query());exit;
     
        $data['feegroupList'] = $feegroup_result;
        $data['hostelroomnumber'] = $this->db->where('id',$id)->get('hostel_rooms')->row()->no_of_bed;


        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $RTEstatusList = $this->customlib->getRteStatus();
        $data['RTEstatusList'] = $RTEstatusList;

        $category = $this->category_model->get();
        $data['categorylist'] = $category;

        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $data['category_id'] = $this->input->post('category_id');
            $data['gender'] = $this->input->post('gender');
            $data['rte_status'] = $this->input->post('rte');
            $data['class_id'] = $this->input->post('class_id');
            $data['section_id'] = $this->input->post('section_id');

            $resultlist = $this->studentfeemaster_model->searchAssignFeeByClassSection($data['class_id'], $data['section_id'], $id, $data['category_id'], $data['gender'], $data['rte_status']);
            $data['resultlist'] = $resultlist;
        }


        // var_dump($data);exit;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/feemaster/assignhostel', $data);
        $this->load->view('layout/footer', $data);
    }
}
