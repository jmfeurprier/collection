<?php

declare(strict_types=1);

namespace Jmf\Collection;

use Jmf\Collection\Exception\CollectionException;

class Collection
{
    /**
     * @template T
     *
     * @param T[] $collection
     *
     * @return T
     *
     * @throws CollectionException
     */
    public static function one(iterable $collection): mixed
    {
        if (1 === self::count($collection)) {
            return self::first($collection);
        }

        throw new CollectionException('Collection does not contain exactly one item.');
    }

    /**
     * @template T
     *
     * @param T[] $collection
     *
     * @return T|null
     *
     * @throws CollectionException
     */
    public static function oneOrNull(iterable $collection): mixed
    {
        if (1 === self::count($collection)) {
            return self::first($collection);
        }

        return null;
    }

    /**
     * @template T
     *
     * @param T[] $collection
     *
     * @return T
     *
     * @throws CollectionException
     */
    public static function first(iterable $collection): mixed
    {
        foreach ($collection as $item) {
            return $item;
        }

        throw new CollectionException('Collection is empty.');
    }

    /**
     * @template T
     *
     * @param T[] $collection
     *
     * @return T|null
     */
    public static function firstOrNull(iterable $collection): mixed
    {
        foreach ($collection as $item) {
            return $item;
        }

        return null;
    }

    /**
     * @template T
     *
     * @param T[] $collection
     *
     * @return T
     *
     * @throws CollectionException
     */
    public static function at(
        iterable $collection,
        int $position,
    ): mixed {
        $current = 0;

        foreach ($collection as $item) {
            if ($position === $current) {
                return $item;
            }

            ++$current;
        }

        throw new CollectionException(
            sprintf(
                'No item at position %u in Collection.',
                $position,
            ),
        );
    }

    /**
     * @template T
     *
     * @param T[] $collection
     *
     * @return T|null
     */
    public static function atOrNull(
        iterable $collection,
        int $position,
    ): mixed {
        $current = 0;

        foreach ($collection as $item) {
            if ($position === $current) {
                return $item;
            }

            ++$current;
        }

        return null;
    }

    /**
     * @template T
     *
     * @param T[] $collection
     */
    public static function count(iterable $collection): int
    {
        return count((array) $collection);
    }

    /**
     * @param array<string, mixed> $array
     * @param string[]             $keys
     *
     * @throws CollectionException
     */
    public static function deepGet(
        array $array,
        iterable $keys,
    ): mixed {
        if ([] === $keys) {
            throw new CollectionException('No keys provided.');
        }

        foreach ($keys as $key) {
            if (!is_array($array)) {
                throw new CollectionException('Not an array.');
            }

            if (!is_string($key) && !is_int($key)) {
                throw new CollectionException('Invalid key type.');
            }

            if (!array_key_exists($key, $array)) {
                throw new CollectionException(
                    sprintf(
                        "Array does not contain key '%s'.",
                        $key,
                    ),
                );
            }

            $array = $array[$key];
        }

        return $array;
    }

    /**
     * @param array<string, mixed> $array
     * @param string[]             $keys
     *
     * @throws CollectionException
     */
    public static function deepHas(
        array $array,
        iterable $keys,
    ): bool {
        if ([] === $keys) {
            throw new CollectionException("No keys provided.");
        }

        foreach ($keys as $key) {
            if (!is_array($array)) {
                return false;
            }

            if (!is_string($key) && !is_int($key)) {
                throw new CollectionException('Invalid key type.');
            }

            if (!array_key_exists($key, $array)) {
                return false;
            }

            $array = $array[$key];
        }

        return true;
    }
}
