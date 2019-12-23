<?php

namespace Shotonoff\DataStructure\BTS;

use Shotonoff\DataStructure\BTS\AVL\AVLNode;

/**
 * Interface TreeInterface
 */
interface TreeInterface
{
    /**
     * Insert a value into the tree
     *
     * @param $value
     * @return void
     */
    public function insert($value): void;

    /**
     * Delete tree's node by given value
     *
     * @param $value Node's value
     * @return void
     */
    public function delete($value): void;

    /**
     * Find node in BST by a value
     *
     * @param mixed $value
     * @return AVLNode
     * @throws TreeException If a node not found
     */
    public function findBy($value): AVLNode;
}
