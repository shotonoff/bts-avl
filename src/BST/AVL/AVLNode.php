<?php

namespace Shotonoff\DataStructure\Tree\AVL;

use Shotonoff\DataStructure\BTS\TreeNode;

/**
 * Class AVLNode
 */
class AVLNode extends TreeNode
{
    /**
     * @var mixed
     */
    public $value;

    /**
     * @var AVLNode
     */
    public $left;

    /**
     * @var AVLNode
     */
    public $right;

    /**
     * @var int
     */
    public $height = 0;

    /**
     * AVLNode constructor
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param TreeNode $node
     * @return bool
     */
    public function less(TreeNode $node): bool
    {
        return $this->value < $node;
    }

    /**
     * @param TreeNode $node
     * @return bool
     */
    public function greater(TreeNode $node): bool
    {
        return $this->value > $node;
    }
}