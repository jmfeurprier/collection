<?php

declare(strict_types=1);

namespace Jmf\Collection;

use Jmf\Collection\Exception\CollectionException;
use PHPUnit\Framework\TestCase;

final class CollectionTest extends TestCase
{
    public function testOneOrNullWithEmptyCollectionWillReturnNull(): void
    {
        $result = Collection::oneOrNull([]);

        self::assertNull($result);
    }

    public function testOneOrNullWithOneItemCollectionWillReturnItem(): void
    {
        $result = Collection::oneOrNull(['foo']);

        self::assertSame('foo', $result);
    }

    public function testOneOrNullWithManyItemsCollectionWillReturnNull(): void
    {
        $result = Collection::oneOrNull(
            [
                'foo',
                'bar',
            ],
        );

        self::assertNull($result);
    }

    public function testOneWithEmptyCollectionWillThrow(): void
    {
        self::expectException(CollectionException::class);

        Collection::one([]);
    }

    public function testOneWithOneItemCollectionWillReturnItem(): void
    {
        $result = Collection::one(['foo']);

        self::assertSame('foo', $result);
    }

    public function testOneWithManyItemsCollectionWillThrow(): void
    {
        self::expectException(CollectionException::class);

        Collection::one(
            [
                'foo',
                'bar',
            ],
        );
    }

    public function testFirstWithEmptyCollectionWillThrow(): void
    {
        self::expectException(CollectionException::class);

        Collection::first([]);
    }

    public function testFirstWithOneItemCollectionWillReturnItem(): void
    {
        $result = Collection::first(['foo']);

        self::assertSame('foo', $result);
    }

    public function testFirstWithManyItemsCollectionWillReturnFirstItem(): void
    {
        $result = Collection::first(
            [
                'foo',
                'bar',
            ],
        );

        self::assertSame('foo', $result);
    }

    public function testFirstOrNullWithEmptyCollectionWillThrow(): void
    {
        $result = Collection::firstOrNull([]);

        self::assertNull($result);
    }

    public function testFirstOrNullWithOneItemCollectionWillReturnItem(): void
    {
        $result = Collection::firstOrNull(['foo']);

        self::assertSame('foo', $result);
    }

    public function testFirstOrNullWithManyItemsCollectionWillReturnFirstItem(): void
    {
        $result = Collection::firstOrNull(
            [
                'foo',
                'bar',
            ],
        );

        self::assertSame('foo', $result);
    }

    public function testCountWithEmptyCollectionWillReturnZero(): void
    {
        $result = Collection::count([]);

        self::assertSame(0, $result);
    }

    public function testCountWithOneItemCollectionWillReturnOne(): void
    {
        $result = Collection::count(['foo']);

        self::assertSame(1, $result);
    }

    public function testCountWithTwoItemsCollectionWillReturnTwo(): void
    {
        $result = Collection::count(
            [
                'foo',
                'bar',
            ],
        );

        self::assertSame(2, $result);
    }

    public function testDeepGet(): void
    {
        $input = [
            'foo' => [
                'bar' => [
                    'baz' => 'qux',
                ],
            ],
        ];

        $result = Collection::deepGet(
            $input,
            [
                'foo',
                'bar',
                'baz',
            ],
        );

        self::assertSame('qux', $result);
    }

    public function testDeepHasWillReturnTrue(): void
    {
        $input = [
            'foo' => [
                'bar' => [
                    'baz' => 'qux',
                ],
            ],
        ];

        $result = Collection::deepHas(
            $input,
            [
                'foo',
                'bar',
                'baz',
            ],
        );

        self::assertTrue($result);
    }

    public function testDeepHasWillReturnFalse(): void
    {
        $input = [
            'foo' => [
                'bar' => [
                    'baz' => 'qux',
                ],
            ],
        ];

        $result = Collection::deepHas(
            $input,
            [
                'foo',
                'bar',
                'qux',
            ],
        );

        self::assertFalse($result);
    }
}
