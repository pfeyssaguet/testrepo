<?php

declare(strict_types=1);

namespace ArrowSphere\Entities\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Class AbstractEntityTest
 */
abstract class AbstractEntityTest extends TestCase
{
    /**
     * The name of the entity class that needs to be tested here
     */
    protected const CLASS_NAME = null;

    /**
     * This is a generic provider that must return test cases with the following arguments:
     * - fields: an array containing the fields provided to the entity
     * - expected: a string containing the expected JSON (pretty-printed for readability)
     *
     * @return array
     */
    abstract public function providerSerialization(): array;

    /**
     * @dataProvider providerSerialization
     *
     * @param array $fields
     * @param string $expected
     */
    public function testSerialization(array $fields, string $expected): void
    {
        $className = static::CLASS_NAME;
        if ($className === null) {
            self::fail('The const CLASS_NAME must be redefined in ' . get_class($this));
        }

        $entity = new $className($fields);

        self::assertSame($expected, json_encode($entity, JSON_PRETTY_PRINT));
    }
}
