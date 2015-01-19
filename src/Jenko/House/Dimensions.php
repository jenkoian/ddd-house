<?php

namespace Jenko\House;

/**
 * Value Object
 */
final class Dimensions
{
    /**
     * @var int
     */
    private $width;

    /**
     * @var int
     */
    private $height;

    /**
     * @param int $width
     * @param int $height
     */
    private function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @param int $width
     * @param int $height
     * @return Dimensions
     */
    public static function fromWidthAndHeight($width, $height)
    {
        return new Dimensions($width, $height);
    }

    /**
     * @param Dimensions $dimensions
     * @return bool
     */
    public function equals(Dimensions $dimensions)
    {
        if ($dimensions->getWidth() === $this->getWidth() && $dimensions->getHeight() === $this->getHeight()) {
            return true;
        }

        return false;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getWidth() . ' x ' . $this->getHeight();
    }
}
