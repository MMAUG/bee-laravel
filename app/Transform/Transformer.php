<?php namespace App\Transform;

interface Transformer {
	public function transform($model);

	public function transformAll($collection);
}