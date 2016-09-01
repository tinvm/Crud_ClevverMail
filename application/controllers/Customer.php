<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 *  Class Customers
 *  Author TinVM
 *  Since Sep01 2016
 */
class Customer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('customer_model','customer');
    }

    public function index()
    {
        $this->load->helper('url');
        $this->load->view('list_customer');
    }

    public function ajax_list()
    {
        $list = $this->customer->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customer) {
            $no++;
            $row = array();
            $row[] = $customer->name;
            $row[] = $customer->email;
            $row[] = $customer->date_create;

            //add html for action
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_customer('."'".$customer->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_customer('."'".$customer->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->customer->count_all(),
            "recordsFiltered" => $this->customer->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
    {
        $data = $this->customer->get_by_id($id);

        echo json_encode($data);
    }

    public function ajax_add()
    {
        $this->_validate();

        $data = array(
            'name' => $this->input->post('name'),

            'email' => $this->input->post('email'),

            'date_create' => date('Y-m-d')
        );

        $insert = $this->customer->save($data);

        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $this->_validate();

        $data = array(
            'name'          => $this->input->post('name'),
            
            'email'         => $this->input->post('email'),
            
            'date_create'   => date('Y-m-d'),
        );

        $this->customer->update(array('id' => $this->input->post('id')), $data);

        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->customer->delete_by_id($id);

        echo json_encode(array("status" => TRUE));
    }


    private function _validate()
    {
        $data = array();

        $data['error_string'] = array();

        $data['inputerror'] = array();

        $data['status'] = TRUE;

        if($this->input->post('name') == '')
        {
            $data['inputerror'][] = 'name';

            $data['error_string'][] = 'Name is required';

            $data['status'] = FALSE;
        }

        if($this->input->post('email') == '')
        {
            $data['inputerror'][] = 'email';

            $data['error_string'][] = 'Email is required';

            $data['status'] = FALSE;
        }
        elseif (filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL) === false) {

            $data['inputerror'][] = 'email';

            $data['error_string'][] = 'Email is a valid email address';

            $data['status'] = FALSE;
        }
    }
}