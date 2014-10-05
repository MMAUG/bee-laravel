<?php namespace App\Moloquent;

class UserModel extends \Moloquent {
	protected $collection = 'users';

	protected $dates = array('birthday');

}