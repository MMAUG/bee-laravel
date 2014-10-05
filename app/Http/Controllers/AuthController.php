<?php namespace App\Http\Controllers;

use DateTime;
use Input;
use Response;
use Illuminate\Routing\Controller;

use App\Repositories\User;

class AuthController extends Controller {

	protected $repo;

	public function __construct(User $shop)
	{
		$this->repo = $shop;
	}

	public function all()
	{
		$lists = $this->repo->getLists(Input::get('limit', 20), Input::get('offset', null));

		return Response::json($lists->toArray());
	}

	public function register()
	{
		$data = [];

		$data['username'] = Input::get('user_name');
		$data['birthday'] = DateTime::createFromFormat('m/d/Y', Input::get('user_birthday'))->getTimestamp();
		$data['email'] = Input::get('user_email');

		if ( $user = $this->repo->create($data) )
		{
			return Response::json(['success' => true, 'user_id' => $user->_id]);
		}

		return Response::json(['success' => false]);
	}

	public function remove($id)
	{
		if ($this->repo->remove($id))
		{
			return Response::json(['success' => true]);
		}

		return Response::json(['success' => false]);
	}
}