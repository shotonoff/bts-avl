<?php

namespace Shotonoff\DataStructure\BTS\Tests\AVL;

use PHPUnit\Framework\TestCase;
use Shotonoff\DataStructure\BTS\AVL\AVLTree;
use Shotonoff\DataStructure\BTS\BFSIterator;
use Shotonoff\DataStructure\BTS\InOrderIterator;
use Shotonoff\DataStructure\BTS\PostOrderIterator;
use Shotonoff\DataStructure\BTS\PreOrderIterator;

/**
 * Class AVLTreeTest
 *
 * @coversDefaultClass \Shotonoff\DataStructure\BTS\AVL\AVLTree
 */
class AVLTreeTest extends TestCase
{
    /**
     * {@inheritDoc}
     */
    public function getProvidedData(): array
    {
        return [
            [
                [1, 2, 3, 4, 5, 6, 7, 8, 9],
                [
                    'preOrder' => [1, 2, 3, 4, 5, 6, 7, 8, 9],
                    'postOrder' => [9, 8, 7, 6, 5, 4, 3, 2, 1],
                    'bsf' => [4, 2, 6, 1, 3, 5, 8, 7, 9],
                    'inOrder' => [4, 2, 1, 3, 6, 5, 8, 7, 9],
                ],
            ],
            [
                [9, 8, 7, 6, 5, 4, 3, 2, 1],
                [
                    'preOrder' => [1, 2, 3, 4, 5, 6, 7, 8, 9],
                    'postOrder' => [9, 8, 7, 6, 5, 4, 3, 2, 1],
                    'bsf' => [6, 4, 8, 2, 5, 7, 9, 1, 3],
                    'inOrder' => [6, 4, 2, 1, 3, 5, 8, 7, 9],
                ],
            ],
        ];
    }

    /**
     * Testing implementation of iterators such as pre/post/in order and bfs
     *
     * @param int[] $input
     * @param array[] $expected
     * @return void
     *
     * @dataProvider getProvidedData
     * @covers ::insert()
     * @covers       \Shotonoff\DataStructure\BTS\PreOrderIterator::iterate()
     * @covers       \Shotonoff\DataStructure\BTS\PostOrderIterator::iterate()
     * @covers       \Shotonoff\DataStructure\BTS\BFSIterator::iterate()
     * @covers       \Shotonoff\DataStructure\BTS\InOrderIterator::iterate()
     */
    public function testIterators(array $input, array $expected): void
    {
        $tree = $this->prepareTree($input);

        $tree->setIterator(new PreOrderIterator());
        self::assertEquals($expected['preOrder'], $tree->toArray());

        $tree->setIterator(new PostOrderIterator());
        self::assertEquals($expected['postOrder'], $tree->toArray());

        $tree->setIterator(new BFSIterator());
        self::assertEquals($expected['bsf'], $tree->toArray());

        $tree->setIterator(new InOrderIterator());
        self::assertEquals($expected['inOrder'], $tree->toArray());
    }

    /**
     * @return void
     *
     * @covers ::delete()
     */
    public function testDelete(): void
    {
        $tree = $this->prepareTree([2, 8, 1, 4, 5, 6, 7, 9, 3]);

        self::assertEquals([1, 2, 3, 4, 5, 6, 7, 8, 9], $tree->toArray());

        $tree->delete(2);

        self::assertEquals([1, 3, 4, 5, 6, 7, 8, 9], $tree->toArray());

        $tree->delete(9);
        $tree->delete(1);
        $tree->delete(4);

        self::assertEquals([3, 5, 6, 7, 8], $tree->toArray());
    }

    /**
     * @param int[] $input
     * @return AVLTree
     */
    private function prepareTree(array $input): AVLTree
    {
        $tree = new AVLTree();

        foreach ($input as $n) {
            $tree->insert($n);
        }

        return $tree;
    }
}
