<?php

namespace Shotonoff\DataStructure\BTS;

/**
 * Class PreOrderIterator
 */
class PreOrderIterator implements BinaryTreeIteratorInterface
{
    /**
     * {@inheritDoc}
     */
    public function iterate(TreeNode $root): iterable
    {
        $st = new \SplStack();

        while ($root !== null || !$st->isEmpty()) {
            if ($root === null) {
                /** @var TreeNode $root */
                $root = $st->pop();
                yield $root->value;
                $root = $root->right;
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
}
