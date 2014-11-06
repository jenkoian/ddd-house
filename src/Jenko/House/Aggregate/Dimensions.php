<?php

namespace Jenko\House\Aggregate;

/**
 * Value Object for Location Dimensions
 */
final class Dimensions
{
    /**
     * @var int
     */
    public $width;

    /**
     * @var int
     */
    public $height;

    /**
     * @param int $width
     * @param int $height
     */
    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function equals(Dimensions $dimensionsToCompare)
    {
        return $this->width === $dimensionsToCompare->width && $this->height === $dimensionsToCompare->height;
    }

    public function __toString()
    {
        return $this->width. ' x '. $this->height;
    }
}