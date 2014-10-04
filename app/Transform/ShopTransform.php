<?php namespace App\Transform;

class ShopTransform implements Transformer {

	public function transform($model) 
	{
		return [
			'name' => $model->name,
			'address' => $model->address,
			'latitude' => (float) $model->loc[1],
			'longitude' => (float) $model->loc[0],
			'cateogry' => $model->category
		];
	}

	public function transformAll($collection) 
	{
		$data = [];

		foreach ($collection as $model) {
			$data[] = $this->transform($model);
		}
		
		return $data;
	}
}