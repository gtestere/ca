<?php

namespace App\Controller;

use App\Dto\HotelTransformer;
use App\Dto\ReviewTransformer;
use App\Entity\Hotel;
use App\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiController extends AbstractController
{

		private ReviewTransformer $reviewTransformer;
		private HotelTransformer $hotelTransformer;

		public function __construct(ReviewTransformer $reviewTransformer, HotelTransformer $hotelTransformer)
		{
			$this->reviewTransformer = $reviewTransformer;
			$this->hotelTransformer = $hotelTransformer;
		}

    public function getResults(Request $request)
    {

    	$hotelId = $request->get('idHotel');
    	$from = $request->get('dateStart');
    	$to = $request->get('dateEnd');
	    $hotel = $this->getDoctrine()->getRepository(Hotel::class)->find($hotelId);

	    if (! $hotel instanceof Hotel) {
		    throw new HttpException(404);
	    }

	    $review = $this->getDoctrine()->getRepository(Review::class)->findByBetweenDate($from, $to, $hotel);

	    $dto = $this->reviewTransformer->transformFromObjects($review['data']);
			$payload = [
				'data' => $dto,
				'interval' => ucfirst($review['interval'])
			];
	    return new JsonResponse($payload, Response::HTTP_OK);
    }

    public function getHotels() {
			$hotels = $this->getDoctrine()->getRepository(Hotel::class)->findAll();

	    $dto = $this->hotelTransformer->transformFromObjects($hotels);

	    return new JsonResponse($dto, Response::HTTP_OK);
    }

}
