<? defined('BASEPATH') OR exit('No direct script access allowed');
//
class Employee_models extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
    $this->load->helper(array('url','html','form'));
    $this->load->library(array('session','form_validation'));
  }
  //getalluser
    public function getAllemployee() {
    $this->db->select('*');
    $this->db->from('employeee');
    $query = $this->db->get();
    foreach ($query->result_array() as $id => $row) {
     $employees[$row['id']] = $row;
    }
    return $employees;
  }
  //count employee
  public function getEmployeeNumber($params) {
    $this->db->select('count(*) as t_records');
    $this->db->from('employeee e');
    //print $this->db->last_query();
    $this->db->join('department d','e.department = d.id','left');
    $this->db->join('designation de','e.designations = de.id','left');
    $this->columnSearch($params);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      $result = $query->result_array();
      return $result[0]['t_records'];
    }
    return false;
  }
  // Get employee
  public function getEmployee($params) {
    $employeee = '';
    $this->db->select('e.id,e.firstname,e.lastname,e.number,e.email,e.address,e.gender,e.status,e.roles,d.name as department,de.name as designations');
    $this->db->from('employeee e');
    $this->db->join('department d','e.department = d.id','left');
    $this->db->join('designation de','e.designations = de.id','left');
    $this->db->order_by($params['sortby'], $params['sort_order']);
    $this->db->limit($params['num_rows'], ($params['pageno']-1)*$params['num_rows']);
    //$this->columnSearch($params);
    $query=$this->db->get();
    if($query->num_rows()>0){
      foreach ($query->result_array() as $id => $employee) {
        $employeee[$employee['id']] = $employee;
      }
    }
    return $employeee;
  }
  //coulmn search
  public function columnSearch($params) {
    if(isset($params['firstname']) and trim($params['firstname']) != '') {
      $this->db->where('e.firstname',$params['firstname']);
    }
    if(isset($params['lastname']) and trim($params['lastname']) != '') {
      $this->db->where('e.lastname',$params['lastname']);
    }
    if(isset($params['number']) and trim($params['number']) != '') {
      $this->db->where('e.number',$params['number']);
    }
     if(isset($params['email']) and trim($params['email']) != '') {
      $this->db->where('e.email',$params['email']);
    }
    if(isset($params['department']) and trim($params['department']) != '') {
      $this->db->where('e.department',$params['department']);
    }
  //  print_r($params);
     if(isset($params['designation']) and trim($params['designation']) != '') {
      $this->db->where('e.designations',$params['designation']);
    }
    if(isset($params['gender']) and trim($params['gender']) != '') {
      $this->db->where('e.gender',$params['gender']);
    }
    if(isset($params['address']) and trim($params['address']) != '') {
      $this->db->where('e.address',$params['address']);
    }
    if (isset($params['keywords']) and $params['keywords'] !='') {
      $this->db->group_start();
      $this->db->like("e.firstname", $params['keywords']);
      $this->db->or_like('e.lastname', $params['keywords']);
      $this->db->or_like('e.number', $params['keywords']);
      $this->db->or_like('e.email', $params['keywords']);
      $this->db->or_like('e.address', $params['keywords']);
      $this->db->group_end();
    }
  }
  //delete query
   public function employee_delete($id) {
    return $this->db->where('id',$id)->delete('employeee');
  }
  //insert query
  public function Employee_insert($data) {
   $qry = $this->db->insert('employeee', $data);
   return $this->db->insert_id();
  }
  //view query
  public function view_query($id) {
    $this->db->select('*');
    $this->db->where('id',$id);
    $query = $this->db->get('employeee');
    if ($query->num_rows() > 0){
      return $query->row_array();
    }
  }
  public function edit_query($id) {
    $this->db->select('*');
    $this->db->where('id',$id);
     $query = $this->db->get('employeee');
    if ($query->num_rows() > 0){
      return $query->row_array();
    }
  }
   public function update_query($data,$id) {
    $this->db->where_in('id',$id);
    $r = $this->db->update('employeee',$data);
    //print $this->db->last_query();
    //var_dump($r);
  }
  public function changestatus($data) {
    $query = $this->db->query("UPDATE employeee SET status = ( CASE WHEN status = 1 THEN 0 WHEN status = 0 THEN 1 END) WHERE id=".$data["id"]);
    return $query;
  }
}