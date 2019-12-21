<?php

namespace Shotonoff\DataStructure\BTS;

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
}
