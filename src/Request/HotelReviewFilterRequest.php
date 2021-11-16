<?php


namespace App\Request;

use Symfony\Component\HttpFoundation\Request;
use \DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class HotelReviewFilterRequest implements RequestInterface
{
    /**
     * @Assert\Date()
     */
    private $fromDate;

    /**
     * @Assert\Date()
     */
    private $toDate;

    public function __construct(Request $request)
    {
        $this->fromDate = $request->get("fromDate");
        $this->toDate = $request->get("toDate");
    }

    /**
     * @return DateTime|null
     */
    public function getFromDate(): ?DateTime
    {
        return $this->fromDate ? DateTime::createFromFormat('Y-m-d', $this->fromDate) : null;
    }

    /**
     * @return DateTime|null
     */
    public function getToDate(): ?DateTime
    {
        return $this->toDate ? DateTime::createFromFormat('Y-m-d', $this->toDate) : null;
    }
}