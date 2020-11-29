<?php


namespace App\Dto;

use App\Dto\ProductResponseDto;
use App\Entity\Hotel;

class HotelTransformer extends AbstractTransformer
{
	/**
	 * @param Hotel $hotel
	 *
	 * @return HotelResponse
	 */
	public function transformFromObject($hotel)
	{
		$dto = new HotelResponse();
		$dto->id = $hotel->getId();
		$dto->name = $hotel->getName();

		return $dto;
	}
}
