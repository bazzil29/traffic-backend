<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

/**
 * contain all general method from all model (CRUD)
 * Class BaseModel
 * @package App\Repository
 */
class BaseModel extends Model
{
    
    /**
     * show all record
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return $this->all();
    }
    
    /**
     * store a record
     * @param $arr
     * @return mixed
     */
    public function store($arr)
    {
        return $this->create($arr);
    }
    
    /**
     * show 1 record
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->findOrFail($id);
    }
    
    /**
     * update record
     * @param int $id
     * @param array $arr
     * @return mixed
     */
    public function updateId($id, $arr)
    {
        return $this->findOrFail($id)->update($arr);
    }
    
    /**
     * delete a record
     * @param integer $id
     * @return mixed
     */
    public function destroyId($id)
    {
        return $this->findOrFail($id)->delete();
    }
    
    public function search($keyword, $field, $field2 = null, $int){
        return $this->where($field,'like',"%$keyword%")->orWhere($field2, 'like', "%$keyword%")->latest()->paginate($int);
    }
}
