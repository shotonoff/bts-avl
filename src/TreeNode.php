<?php

namespace Shotonoff\DataStructure\BTS;

/**
 * Class TreeNode
 */
class TreeNode
{
    /**
     * @var mixed
     */
    public $value;

    /**
     * Left child node
     *
     * @var TreeNode|null
     */
    public ?TreeNode $left = null;

    /**
     * Right child node
     *
     * @var TreeNode|null
     */
    public ?TreeNode $right = null;
}
