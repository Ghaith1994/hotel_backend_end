<?php

namespace App\Controller;

use App\Repository\HotelRepository;
use App\Request\HotelReviewFilterRequest;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use \DateTime;

#[Route('hotel')]
class HotelController extends AbstractController
{
    private $hotelRepository;

    public function __construct(HotelRepository $hotelRepository)
    {
        $this->hotelRepository = $hotelRepository;
    }

    #[Route('', name: 'getHotels')]
    public function getHotels(): JsonResponse
    {
        $hotels = $this->hotelRepository->findAll();

        return $this->json($hotels);
    }

    #[Route('/{hotelId}/hotel-reviews', name: 'hotelReviews')]
    public function getHotelReviews($hotelId, HotelReviewFilterRequest $request): JsonResponse
    {
        $fromDate = $request->getFromDate() ? $request->getFromDate() : null;
        $toDate = $request->getToDate() ? $request->getToDate() : null;

        $startDailyRange = new DateTime('now -29 day');
        $startWeeklyRange = new DateTime('now -89 day');

        $hotelReviews = $this->hotelRepository->findHotelReviewsByDateGroup(
            $hotelId,
            $fromDate,
            $toDate,
            $startDailyRange,
            $startWeeklyRange);

        return $this->json($hotelReviews);
    }
}
