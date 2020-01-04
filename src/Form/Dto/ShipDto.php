<?php

namespace App\Form\Dto;

use App\Entity\Ship;
use App\Entity\ShipChassis;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Assert\GroupSequence({"ShipDto", "second_pass"})
 */
class ShipDto
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="3", max="30")
     */
    public ?string $name;

    /**
     * @Assert\NotNull()
     */
    public ?ShipChassis $chassis;

    /**
     * @var HoldedShipDto[]
     *
     * @Assert\Valid()
     */
    public array $holdedShips;

    /**
     * @Assert\Range(min="0", max="2147483647")
     */
    public ?float $height;

    /**
     * @Assert\Range(min="0", max="2147483647")
     */
    public ?float $length;

    /**
     * @Assert\Range(min="1", max="2147483647")
     */
    public ?int $minCrew;

    /**
     * @Assert\Range(min="1", max="2147483647")
     * @Assert\Expression("value === null or this.minCrew === null or value >= this.minCrew", message="ship.constraints.max_crew.over_min_crew", groups={"second_pass"})
     */
    public ?int $maxCrew;

    /**
     * @Assert\Choice(choices=\App\Entity\Ship::SIZES)
     */
    public ?string $size;

    /**
     * @Assert\Range(min="0", max="2147483647")
     */
    public ?int $price;

    /**
     * @Assert\Choice(choices=App\Entity\Ship::READY_STATUSES)
     */
    public ?string $readyStatus = Ship::READY_STATUS_FLIGHT_READY;

    /**
     * @Assert\Length(min="3", max="30")
     */
    public ?string $focus;

    /**
     * @Assert\Url()
     */
    public ?string $pledgeUrl;

    /**
     * @Assert\File(maxSize="5M", mimeTypes={"image/jpeg", "image/png", "image/webp"}, mimeTypesMessage="ship.constraints.picture.bad_format")
     */
    public ?UploadedFile $picture = null;

    public ?string $picturePath;

    /**
     * @Assert\File(maxSize="1M", mimeTypes={"image/jpeg", "image/png", "image/webp"}, mimeTypesMessage="ship.constraints.picture.bad_format")
     */
    public ?UploadedFile $thumbnail = null;

    public ?string $thumbnailPath;

    public function __construct(
        ?string $name = null,
        ?ShipChassis $chassis = null,
        array $holdedShips = [],
        ?float $height = null,
        ?float $length = null,
        ?int $minCrew = 1,
        ?int $maxCrew = 1,
        ?string $size = null,
        ?string $readyStatus = null,
        ?string $focus = null,
        ?string $pledgeUrl = null,
        ?string $picturePath = null,
        ?string $thumbnailPath = null,
        ?int $price = null
    ) {
        $this->name = $name;
        $this->chassis = $chassis;
        $this->holdedShips = $holdedShips;
        $this->height = $height;
        $this->length = $length;
        $this->minCrew = $minCrew;
        $this->maxCrew = $maxCrew;
        $this->size = $size;
        $this->readyStatus = $readyStatus;
        $this->focus = $focus;
        $this->pledgeUrl = $pledgeUrl;
        $this->picturePath = $picturePath;
        $this->thumbnailPath = $thumbnailPath;
        $this->price = $price;
    }

    public function addHoldedShip(HoldedShipDto $holdedShip): void
    {
        $this->holdedShips[] = $holdedShip;
    }
}
