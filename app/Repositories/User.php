<?php namespace App\Repositories;

use App\Moloquent\UserModel;

class User {

	protected $model;

	public function __construct(UserModel $shop)
	{
		$this->model = $shop;
	}

	public function getLists($limit = 20, $offset = null)
	{
		return $this->model->take($limit)->skip($offset)->get();
	}

	public function create($data)
	{	
		return $this->save($this->model, $data);
	}

	public function update($id, $data)
	{
		$model = $this->model->where('_id', $id)->first();

		if ( is_null($model) )
		{
			return false;
		}

		return $this->save($model, $data);
	}

	public function remove($id)
	{
		$model = $this->model->where('_id', $id)->first();

		return $model->delete();
	}

	protected function save($model, $data)
	{
		$model->username = $data['username'];
		$model->birthday = $data['birthday'];
		$model->email = $data['email'];
		/*$model->category = $data['category'];*/

		if ($model->save())
		{
			return $model;
		}

		return false;
	}

}