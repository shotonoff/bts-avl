<?php

namespace Shotonoff\DataStructure\BTS;

/**
 * Interface TreeInterface
 */
interface TreeInterface
{
    public function insert($value): void;

    public function postOrder(): iterable;

    public function inOrder(): iterable;

    public function preOrder(): iterable;
}
