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

	public function categories()
	{
		$cats = $this->repo->getCategoryList();

		return Response::json($cats);
	}

	public function nearby()
	{
		$lists = $this->repo->getNearBy(
					Input::get('lat'), Input::get('long'), Input::get('distance', 5)
				);

		$tf = new ShopTransform();

		return Response::json($tf->transformAll($lists));
	}

	public function index()
	{
		$lists = $this->repo->getLists(Input::get('limit', 20), Input::get('offset', null));

		$tf = new ShopTransform();

		return Response::json($tf->transformAll($lists));
	}

	public function store()
	{
		$data = $this->prepareData();
		
		if ($shop = $this->repo->create($data)) 
		{
			return Response::json(['success' => true, 'id' => $shop->_id]);
		}

		return Response::json(['success' => false]);
	}

	public function update($id)
	{
		$data = $this->prepareData();
		
		if ($shop = $this->repo->update($id, $data)) 
		{
			return Response::json(['success' => true, 'id' => $shop->_id]);
		}

		return Response::json(['success' => false]);
	}

	public function destroy($id)
	{
		if ($this->repo->remove($id)) 
		{
			return Response::json(['success' => true]);
		}

		return Response::json(['success' => false]);
	}

	protected function prepareData()
	{
		$data = [];

		$data['name'] = Input::get('name');
		$data['address'] = Input::get('address');
		$data['long'] = Input::get('longitude');
		$data['lat'] = Input::get('latitude');
		$data['category'] = Input::get('category', Config::get('bfapp.default.category'));

		if (Input::get('foods')) 
		{
			$data['foods'] = (array) Input::get('foods');
		}

		return $data;
	}

}
