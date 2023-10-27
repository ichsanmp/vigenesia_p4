<?php
// Dokumentasi Pengerjaan Individu
// NIM     : 19210117
// Nama    : Ichsan Maa'arif Pratama
// Kelas   : 19.5B.04
// Kampus  : BSI Cut Mutiah

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Rest_member extends REST_Controller
{
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get()
    {
        $id = $this->get('iduser');
        if ($id == ""){
            $member = $this->db->get('user')->result();
        } else {
            $this->db->where('iduser',$id);
            $member = $this->db->get('user')->result();
        }
        $this->response($member, 200);
    }

    function index_post()
    {
        $data = array(
            'iduser' => $this->post('iduser'),
            'nama' => $this->post('nama'),
            'profesi' => $this->post('profesi'),
            'email' => $this->post('email'),
            'password' => $this->post('password'),
            'role_id' => $this->post('role_id'),
            'is_active' => $this->post('is_active'),
            'tanggal_input' => $this->post('tanggal_input'),
            'modified' => $this->post('modified')
        );
        $insert = $this->db->insert('user', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('iduser');
        $data = array(
            'iduser' => $this->put('iduser'),
            'nama' => $this->put('nama'),
            'profesi' => $this->put('profesi'),
            'email' => $this->put('email'),
            'password' => $this->put('password'),
            'role_id' => $this->put('role_id'),
            'is_active' => $this->put('is_active'));
        $this->db->where('iduser', $id);
        $update = $this->db->update('user', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail',502));
        }
    }
    
    function index_delete() {
        $id = $this->delete('iduser');
        $this->db->where('iduser', $id);
        $delete = $this->db->delete('user');
        if ($delete) {
            $this->response(array('status'=>'sukses'), 200);
        } else {
            $this->response(array('status'=>'gagal', 502));
        }
    }

}
?>