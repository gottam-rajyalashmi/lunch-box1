<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
 
class ProjectsModel extends Model {
  protected $table = 'projects';
  protected $primaryKey = 'id';
  protected $allowedFields = ['id','code','name', 'responsible','assignted_to','priority','start_at','end_at','description','status', 'çreated_at', 'created_by', 'updated_at', 'updated_by'];

  protected $returnType     = 'array';

  protected $useTimestamps = true;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
}
