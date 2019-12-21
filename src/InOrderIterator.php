<?php

namespace Shotonoff\DataStructure\BTS;

/**
 * Class InOrderIterator
 */
class InOrderIterator implements BinaryTreeIteratorInterface
{
    /**
     * {@inheritDoc}
     */
    public function iterate(TreeNode $root): iterable
    {
        $st = new \SplStack();
        $st->push(null);

        while ($root !== null) {
            yield $root->value;

            if ($root->left !== null) {
                if ($root->right) {
                    $st->push($root->right);
                }

                $root = $root->left;
            } else {
                if ($root->right) {
                    $root = $root->right;
                } else {
                    $root = $st->pop();
                }
            }
        }
    }
}
