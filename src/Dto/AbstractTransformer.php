<?php


namespace App\Dto;

abstract class AbstractTransformer implements TransformerInterface
{
	public function transformFromObjects(iterable $objects): iterable
	{
		$dto = [];

		foreach ($objects as $object) {
			$dto[] = $this->transformFromObject($object);
		}

		return $dto;
	}

}
