<?php namespace App\Repositories;

use App\Moloquent\ShopModel;

class Shop {

	protected $model;

	public function __construct(ShopModel $shop)
	{
		$this->model = $shop;
	}

	public function getCategoryList()
	{
		$cats = \DB::collection('shops')->distinct('category')->get();
		sort($cats);
		return $cats;
	}

	public function getLists($limit = 20, $offset = null)
	{
		return $this->model->take($limit)->skip($offset)->get();
	}

	public function getNearBy($lat, $long, $dist = 20, $category = null)
	{
		//return $this->model->command();
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
		$model->name = $data['name'];
		$model->address = $data['address'];
		$model->loc = [$data['long'], $data['lat']];
		$model->category = $data['category'];

		if ( isset($data['foods']) )
		{
			$model->foods = $data['foods'];
		}

		if ($model->save())
		{
			return $model;
		}

		return false;
	}
}