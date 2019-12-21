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
     * @var TreeNode
     */
    public TreeNode $left;

    /**
     * Right child node
     *
     * @var TreeNode
     */
    public TreeNode $right;
}
