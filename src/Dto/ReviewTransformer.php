<?php


namespace App\Dto;

use App\Entity\Product;

class ReviewTransformer extends AbstractTransformer
{
	/**
	 * @param $review
	 *
	 * @return ReviewResponse
	 */
	public function transformFromObject($review)
	{

		$dto = new ReviewResponse();
		$dto->score = $review['score'];
		$dto->date_group = $review['date_group'];
		$dto->review_count = $review['review_count'];

		return $dto;
	}
}
