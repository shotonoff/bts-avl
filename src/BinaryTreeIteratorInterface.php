<?php

namespace Shotonoff\DataStructure\BTS;

/**
 * Interface TreeTraversalInterface
 */
interface BinaryTreeIteratorInterface
{
    /**
     * Iterate tree's nodes according to implementation
     *
     * @param TreeNode $root
     * @return iterable
     */
    public function iterate(TreeNode $root): iterable;
}
