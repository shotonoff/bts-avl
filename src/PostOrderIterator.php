<?php

namespace Shotonoff\DataStructure\BTS;

/**
 * Class PostOrderIterator
 */
class PostOrderIterator implements BinaryTreeIteratorInterface
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
                $root = $root->left;
            }

            if ($root->right) {
                $st->push($root);
                $root = $root->right;
            } else {
                yield $root->value;
                $root = $root->left;
            }
        }
    }
}
