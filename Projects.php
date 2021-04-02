<?php 
namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\ProjectsModel;
use App\Models\PrioritiesModel;
use App\Models\UsersModel;

class Projects extends BaseController {
  public function __construct() {
    helper(['form', 'url', 'date']);
  }
  // get all the records
  private function getAllProjects($get) {
    $projectModel = new ProjectsModel();
    $projectModel->join('priorities', 'priorities.id = projects.priority','Left');
    $projectModel->join('users', 'users.id = projects.responsible','Left');

    if(isset($get['keywords']) && trim($get['keywords'])) {
      $projectModel->groupStart();
      $projectModel->like('projects.code', $get['keywords']);
      $projectModel->orLike('projects.name', $get['keywords']);
      $projectModel->orLike('priorities.name', $get['keywords']);
      $projectModel->orLike('projects.assign_to', $get['keywords']);
      $projectModel->groupEnd();
    }
    //coulmn search
    if(isset($get['code_id']) && trim($get['code_id']))
    $projectModel->where('projects.code', $get['code_id']);
    if(isset($get['name']) && trim($get['name']))
    $projectModel->where('projects.name', $get['name']);
/*
    if(isset($get['priority']) && trim($get['priority']))
    $projectModel->where('priorities.name', $get['priority']);*/
     if(isset($get['priority']) and $get['priority'] != ''){
      $projectModel->like('projects.priority',$get['priority']);
    }
   
   if (!empty($get['start_at'])) 
      $projectModel->where('DATE_FORMAT(projects.start_at,"%Y-%m-%d") =', date('Y-m-d',strtotime($get['start_at'])));
   if (!empty($get['end_at'])) 
      $projectModel->where('DATE_FORMAT(projects.end_at,"%Y-%m-%d") =', date('Y-m-d',strtotime($get['end_at'])));

 
    $data['totalProject'] = ((new ProjectsModel())->select('count(*) as totalProject')->first())['totalProject'];
    $projectModel->select('projects.id,projects.code,projects.name, priorities.name as priority, CONCAT(users.fname," ",users.lname) as responsible,projects.assign_to,projects.start_at,projects.end_at,projects.description, projects.created_at, projects.created_by, projects.updated_at, projects.updated_by, projects.status');
    $projectModel->where('projects.status','1');
    $data['projects'] = $projectModel->orderBy($get['sortby'], $get['sort_order'])->findAll($get['rows'], ($get['pageno']-1)*$get['rows']);
    $data['params'] = $get;
    $prioritiesModel = new PrioritiesModel();
    $query = $prioritiesModel->findAll();
    $data['priorities'] = $query;
    //
    $userModel = new UsersModel();
    $str_query = $userModel->findAll();
    $data['users'] = $str_query;
    // /print_r($data);exit();
    return $data;
  }
  public function index() {
    //print('<pre>');print_r($this->request->getPost());print('<pre/>');exit();
    if ($this->request->isAjax()) {
      $projects = $this->getAllProjects($this->request->getPost());
      echo view('projects/projects_body', $projects);
      exit();
    }
    //redirct to login
    if(!$this->loggedIn) {
      return redirect()->to('login');
    }
    $projects = $this->getAllProjects(['rows'=>10, 'pageno' =>1, 'sortby'=>'created_at', 'sort_order'=>'desc']);
    echo view('header');
    return view('projects/projects', $projects);
  }
  // add priorities
  public function addprojects() {
    $prioritiesModel = new PrioritiesModel();
    $query = $prioritiesModel->findAll();
    $data['priority'] = $query;
    //print('<pre>');print_r($data);print('<pre/>');exit();
    echo view('header');
    return view('projects/addprojects',$data);
  }
  public function projects_add() {
    $projectModel = new ProjectsModel();
    $c = 1;
    $code = sprintf('%05d',$c);
    $codeid = mt_rand(10000000,99999999);
    $ucode = 'HGPPS'.$codeid; 
    $data['code'] = $ucode;
    $data = [
      'code' => $ucode,
      'assign_to' => $this->request->getVar('assign_to'),
      'name' => $this->request->getVar('name'),
      'start_at' => date('Y-m-d'),
      'end_at' => date('Y-m-d'),
      'priority' => $this->request->getVar('priority'),
      'responsible' => $this->request->getVar('responsible'),
      'description' => $this->request->getVar('description'),
      'created_at' => date('Y-m-d'),
      'status' => 1,

    ];
    $save = $projectModel->insert($data);
   // print('<pre>');print_r($save);print('<pre/>');exit();
    return redirect()->to( base_url('projects') );
  }
  //delete priorities
  public function projectsDelete($id) {
    $projectModel = new ProjectsModel();
    $data['projects'] = $projectModel->where('id', $id)->delete();
    return redirect()->to( base_url('projects') );
  }
  //edit priorities
   public function edit_projects($id) {
    $projectsModel = new ProjectsModel();
    $prioritiesModel = new PrioritiesModel();
    $query = $prioritiesModel->findAll();
    $data['priority'] = $query;
    $data['projects'] = $projectsModel->where('id', $id)->first();
    echo view('header');
    return view('projects/edit_projects', $data);
  }
  public function projects_update() {  
    $projectsModel = new ProjectsModel();
    $prioritiesModel = new PrioritiesModel();
    $query = $prioritiesModel->findAll();
    $data['priority'] = $query;
    $id = $this->request->getVar('id');
    $data = [
     'name' => $this->request->getVar('name'),
     'start_at' => date('Y-m-d'),
     'end_at' => date('Y-m-d'),
     'priority' => $this->request->getVar('priority'),
     'status' => 1,
      'updated_at' => date('Y-m-d H:i:s',time()),
    ];
    $save = $projectsModel->update($id,$data);
    return redirect()->to( base_url('projects') );
  }
}
