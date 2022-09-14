<?php

namespace App\Repositories;

class BaseRepository{

  protected $model;

  public function __construct($model){
    $this->model = new $model;
  }

  public function all(){
    return $this->model->all();
  }

  public function find($id){
    return $this->model->find($id);
  }

  public function findByUuid($uuid){
    return $this->model->where('uuid', $uuid)->first();
  }

  public function create($data){
    return $this->model->create($data);
  }

  public function update($id, $data){
    $model = $this->model->find($id);
    return $model->update($data);
  }

  public function delete($id){
    $model = $this->model->find($id);
    return $model->delete();
  }

  public function deleteByUuid($uuid){
    $model = $this->model->where('uuid', $uuid)->first();
    return $model->delete();
  }
}