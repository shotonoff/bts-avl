<?php

namespace Shotonoff\DataStructure\BTS\AVL;

use Shotonoff\DataStructure\BTS\PreOrderIterator;
use Shotonoff\DataStructure\BTS\TreeInterface;
use Shotonoff\DataStructure\BTS\BinaryTreeIteratorInterface;
use Traversable;

/**
 * Class AVLTree
 */
class AVLTree implements TreeInterface, \IteratorAggregate
{
    /**
     * Root node of the tree
     *
     * @var AVLNode
     */
    private AVLNode $root;

    /**
     * Tree's iterator, by default using PreOrderIterator
     *
     * @var BinaryTreeIteratorInterface
     */
    private BinaryTreeIteratorInterface $iterator;

    /**
     * AVLTree constructor
     */
    public function __construct()
    {
        $this->iterator = new PreOrderIterator();
    }

    /**
     * {@inheritDoc}
     */
    public function insert($value): void
    {
        $node = new AVLNode($value);

        $this->root = $this->recursiveInsert($this->root, $node);
    }

    /**
     * Insert a node in a recursive manner
     *
     * @param AVLNode $root Base node
     * @param AVLNode $node Inserted node
     * @return AVLNode
     */
    private function recursiveInsert(?AVLNode $root, AVLNode $node): AVLNode
    {
        if ($root === null) {
            $node->height = 1;
            return $node;
        }

        if ($root->less($node)) {
            $root->right = $this->recursiveInsert($root->right, $node);
        } else {
            $root->left = $this->recursiveInsert($root->left, $node);
        }

        $this->fixHeight($root);

        return $this->balance($root);
    }

    /**
     * Fix a height of a node
     *
     * @param AVLNode $node
     * @return void
     */
    private function fixHeight(AVLNode $node): void
    {
        [$left, $right] = $node->heights();

        $height = $right > $left
            ? $right
            : $left;

        $node->height = $height + 1;
    }

    /**
     * Do balancing the tree
     *
     * @param AVLNode $node Base node of the tree
     * @return AVLNode
     */
    private function balance(AVLNode $node): AVLNode
    {
        $bf = $this->bfactor($node);

        if ($bf === 2) {
            if ($node->right !== null && $this->bfactor($node->right) < 0) {
                $node->right = $this->rightRotate($node->right);
            }

            return $this->leftRotate($node);
        }

        if ($bf === -2) {
            if ($node->left !== null && $this->bfactor($node->left) > 0) {
                $node->left = $this->leftRotate($node->left);
            }

            return $this->rightRotate($node);
        }

        return $node;
    }

    /**
     * Left rotation
     *
     * @param AVLNode $node
     * @return AVLNode
     */
    private function leftRotate(AVLNode $node): AVLNode
    {
        $root = $node->right;
        $node->right = $root->left;
        $root->left = $node;

        // after rotation needs to update height rotated nodes
        $this->fixHeight($node);
        $this->fixHeight($root);

        return $root;
    }

    /**
     * Right rotation
     *
     * @param AVLNode $node
     * @return AVLNode
     */
    private function rightRotate(AVLNode $node): AVLNode
    {
        $root = $node->left;
        $node->left = $root->right;
        $root->right = $node;

        // after rotation needs to update height rotated nodes
        $this->fixHeight($node);
        $this->fixHeight($root);

        return $root;
    }

    /**
     * Get balance factor for given node
     *
     * @param AVLNode $node
     * @return int
     */
    private function bfactor(AVLNode $node): int
    {
        return $this->height($node->right) - $this->height($node->left);
    }

    /**
     * Get node's height
     *
     * @param AVLNode|null $node
     * @return int
     */
    private function height(?AVLNode $node): int
    {
        return ($node === null)
            ? 0
            : $node->height;
    }

    /**
     * @param BinaryTreeIteratorInterface $iterator
     * @return void
     */
    public function setIterator(BinaryTreeIteratorInterface $iterator): void
    {
        $this->iterator = $iterator;
    }

    /**
     * Return tree as array representation
     *
     * @return array[]
     */
    public function toArray(): array
    {
        return \iterator_to_array($this->getIterator());
    }

    /**
     * @param $value
     */
    public function delete($value): void
    {
        // TODO: Implement delete() method.
    }

    /**
     * @return iterable|Traversable
     */
    public function getIterator()
    {
        return $this->iterator->iterate($this->root);
    }
}
