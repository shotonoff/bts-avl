<?php

namespace Shotonoff\DataStructure\BTS;

/**
 * Class BFSIterator
 */
class BFSIterator implements BinaryTreeIteratorInterface
{
    /**
     * {@inheritDoc}
     */
    public function iterate(TreeNode $root): iterable
    {
        $q = new \SplQueue();
        $q->enqueue($root);

        while (!$q->isEmpty()) {
            /** @var TreeNode $node */
            $node = $q->dequeue();

            if ($node->left) {
                $q->enqueue($node->left);
            }

            if ($node->right) {
                $q->enqueue($node->right);
            }

            yield $node->value;
        }
    }
}
