<?php

namespace Shotonoff\DataStructure\BTS\AVL;

use Shotonoff\DataStructure\BTS\TreeNode;

/**
 * Class AVLNode
 * @property AVLNode $left
 * @property AVLNode $right
 */
class AVLNode extends TreeNode
{
    /**
     * Max height of a subtree
     *
     * @var int
     */
    public int $height = 0;

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
     * @param AVLNode $node
     * @return bool
     */
    public function less(AVLNode $node): bool
    {
        return $this->value < $node->value;
    }

    /**
     * Return height of left and right subtree
     *
     * @return array[]
     */
    public function heights(): array
    {
        $left = $this->left ? $this->left->height : 0;
        $right = $this->right ? $this->right->height : 0;

        return [$left, $right];
    }
}