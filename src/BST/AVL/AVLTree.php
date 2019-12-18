<?php

namespace Shotonoff\DataStructure\Tree\AVL;

use Shotonoff\DataStructure\BTS\TreeInterface;

/**
 * Class AVLTree
 */
class AVLTree implements TreeInterface
{
    /**
     *
     *
     * @var AVLNode
     */
    private $root;

    /**
     *
     *
     * @param mixed $value
     * @return void
     */
    public function insert($value): void
    {
        $node = new AVLNode($value);

        $this->root = $this->recursiveInsert($this->root, $node);
    }

    /**
     *
     *
     * @param AVLNode $root
     * @param AVLNode $node
     * @return AVLNode
     */
    private function recursiveInsert(AVLNode $root, AVLNode $node): AVLNode
    {
        if ($root === null) {
            return $node;
        }

        if ($root->less($node)) {
            $root->right = $this->recursiveInsert($root->right, $node);
        } else {
            $root->left = $this->recursiveInsert($root->left, $node);
        }

        $this->fixHeight($node);
        return $this->balance($node);
    }

    /**
     * Fix a height of a node
     *
     * @param AVLNode $node
     * @return int
     */
    private function fixHeight(AVLNode $node): int
    {
        $height = $node->right->value > $node->left->value
            ? $node->right->value
            : $node->left->value;

        return $height + 1;
    }

    /**
     * Do balance
     *
     * @param AVLNode $node
     * @return AVLNode
     */
    private function balance(AVLNode $node): AVLNode
    {
        $bf = $this->bfactor($node);

        if ($bf === 2) {
            if ($this->bfactor($node->left) > 0) {
                $node->left = $this->rightRotate($node->left);
            }

            return $this->rightRotate($node);
        }

        if ($bf === -2) {
            if ($this->bfactor($node->right) > 0) {
                $node->right = $this->leftRotate($node->left);
            }

            return $this->rightRotate($node);
        }

        return $node;
    }

    private function leftRotate(AVLNode $node)
    {
        $root = $node->right;
        $root->right = $node->left;
        $root->left = $node;

        return $root;
    }

    private function rightRotate(AVLNode $node): AVLNode
    {
        $root = $node->left;
        $root->left = $node->right;
        $node->right = $root;

        return $root;
    }

    private function bfactor(AVLNode $node): int
    {
        return $this->height($node->right) - $this->height($node->left);
    }

    private function height(?AVLNode $node): int
    {
        return ($node === null)
            ? 0
            : $node->height;
    }

    public function preOrder(): iterable
    {
        $root = $this->root;
        $st = new \SplStack();

        while ($root !== null || !$st->isEmpty()) {
            if ($root === null) {
                /** @var AVLNode $root */
                $root = $st->pop();
                yield $root->value;
                $root = $root->left;
            }

            if ($root->left) {
                $st->push($root);
                $root = $root->left;
            } else {
                yield $root->value;
                $root = $root->right;
            }
        }
    }

    public function inOrder(): iterable
    {
        $st = new \SplStack();
        $st->push(null);
        $root = $this->root;

        while ($root !== null) {
            yield $root->value;

            if ($root->left !== null) {
                $root = $root->left;

                if ($root->right) {
                    $st->push($root->right);
                }
            } else {
                if ($root->right) {
                    $root = $root->right;
                } else {
                    $root = $st->pop();
                }
            }
        }
    }

    public function postOrder(): iterable
    {
    }
}
