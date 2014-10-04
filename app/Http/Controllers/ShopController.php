<?php namespace App\Http\Controllers;

use Config;
use Input;
use Response;
use Illuminate\Routing\Controller;

use App\Repositories\Shop;
use App\Transform\ShopTransform;

class ShopController extends Controller {

	protected $repo;

	public function __construct(Shop $shop)
	{
		$this->repo = $shop;
	}

	public function index()
	{
		$lists = $this->repo->getLists(Input::get('limit', 20), Input::get('offset', null));

		$tf = new ShopTransform();

		return Response::json($tf->transformAll($lists));
	}

	public function create()
	{
		$data = $this->prepareData();
		
		if ($shop = $this->repo->create($data)) 
		{
			return Response::json(['success' => true, 'id' => $shop->_id]);
		}

		return Response::json(['success' => false]);
	}

	public function update()
	{
		$lists = $this->repo->getLists(Input::get('limit', 20), Input::get('offset', null));

		return Response::json($lists->toArray());
	}

	protected function prepareData()
	{
		$data = [];

		$data['name'] = Input::get('name');
		$data['address'] = Input::get('address');
		$data['long'] = Input::get('longitude');
		$data['lat'] = Input::get('latitude');
		$data['category'] = Input::get('category', Config::get('bfapp.default.category'));

		return $data;
	}

}
