<?php

namespace App\Dto;

interface TransformerInterface
{
	public function transformFromObject($object);
	public function transformFromObjects(iterable $objects): iterable;
}
