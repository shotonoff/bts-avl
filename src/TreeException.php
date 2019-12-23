<?php

namespace Shotonoff\DataStructure\BTS;

/**
 * Class TreeException
 */
class TreeException extends \RuntimeException
{
    /**
     * Exception a node of a bst tree not found
     *
     * @return static
     */
    public static function nodeNotFound(): self
    {
        return new self('Node not found');
    }
}
