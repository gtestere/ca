<?php


namespace App\Dto;
use JMS\Serializer\Annotation as Serialization;


class HotelResponse {
	/**
	 * @Serialization\Type("string")
	 */
	public string $name;

	/**
	 * @Serialization\Type("integer")
	 */
	public string $id;


}