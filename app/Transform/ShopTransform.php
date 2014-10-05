<?php namespace App\Transform;

use Config;

class ShopTransform implements Transformer {

	protected $colors = [];

	public function __construct()
	{
		$this->colors = Config::get('bfapp.colors');
	}

	public function transform($model) 
	{
		$color = $this->getRandomColorSet();

		return [
			'id' => $model->_id,
			'name' => $model->name,
			'first_char' => $this->getFirstChar($model->name),
			'address' => $model->address,
			'latitude' => (float) $model->loc[1],
			'longitude' => (float) $model->loc[0],
			'cateogry' => $model->category,
			'foods'	=> $model->foods,
			'primary_color' => $color[0],
			'accent_color' => $color[1]
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

	private function getRandomColorSet()
	{
		$ran = rand(0, 9);

		return $this->colors[$ran];
	}

	private function getFirstChar($name)
	{
		if ( preg_match('/\p{L}/u', $name, $m) )
		{
			return $m[0];
		}

		return substr($name, 0, 1);
	}
}