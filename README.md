# Collection

Simple utilities to interact with collections (arrays, iterables, etc).

## Installation

With composer:

```
composer require jmf/collection
```

## Usage

### Retrieving a single item from a collection

When you need to retrieve the only value from a collection which **MUST** contain exactly one item:

```
use Jmf\Collection\Collection;

$array = ['foo'];

// Will return 'foo'
$item = Collection::one($array);


$array = ['foo', 'bar'];

// Will throw an exception
$item = Collection::one($array);
```

If the collection does not contain exactly one item, an exception will be thrown.

When you need to retrieve the only value from a collection which **CAN** contain exactly one item:

```
use Jmf\Collection\Collection;

$array = ['foo'];

// Will return 'foo'
$item = Collection::oneOrNull($array);


$array = ['foo', 'bar'];

// Will return null
$item = Collection::oneOrNull($array);
```

If the collection does not contain exactly one item, null is returned.

### Counting items in a collection

```
use Jmf\Collection\Collection;

$list = ['foo', 'bar', 'baz'];

// Will return 3
$count = Collection::count($list);
```

### Retrieving items from a nested array structure

```
use Jmf\Collection\Collection;

$array = [
    'foo' => [
        'bar' => [
            'baz' => 'qux',
        ],
    ],
];

// Will return 'qux'
$item = Collection::deepGet($array, ['foo', 'bar', 'baz']);
```

### Testing item existence from a nested array structure

```
use Jmf\Collection\Collection;

$array = [
    'foo' => [
        'bar' => [
            'baz' => 'qux',
        ],
    ],
];

// Will return true
$exists = Collection::deepHas($array, ['foo', 'bar', 'baz']);
```
