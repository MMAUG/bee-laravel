<?php namespace App\Moloquent;

class ShopModel extends \Moloquent {
	protected $collection = 'shops';

	public function getFoodsAttribute()
	{
		if ( ! isset($this->attributes['foods']) ) {
			return [];
		}

		return $this->attributes['foods'];
	}

	/*public function foods()
	{
		return $this->hasMany('App\Moloquent\FoodModel');
	}*/
}