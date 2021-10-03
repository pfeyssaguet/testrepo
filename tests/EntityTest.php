<?php

declare(strict_types=1);

namespace ArrowSphere\Entities\Tests;

use ArrowSphere\Entities\AbstractEntity;
use ArrowSphere\Entities\Property;

/**
 * Class EntityTest
 */
class EntityTest extends AbstractEntityTest
{
    protected const CLASS_NAME = MyEntity::class;

    public function providerSerialization(): array
    {
        return [
            'standard' => [
                'fields'   => [
                    'id'                         => 42,
                    'nullableFieldPresentIfNull' => null,
                ],
                'expected' => <<<JSON
{
    "id": 42,
    "nullableFieldPresentIfNull": null
}
JSON
                ,
            ],
        ];
    }

    public function testSetter(): void
    {
        $entity = new MyEntity([
            'nullableFieldPresentIfNull' => null,
        ]);

        self::assertNull($entity->getId());

        $entity->setId(42);

        self::assertSame(42, $entity->getId());
    }
}

/**
 * Class MyEntity
 *
 * @method int|null getId()
 * @method string|null getNullableField()
 * @method string|null getNullableFieldPresentIfNull()
 * @method self setId(int $id)
 * @method self setNullableField(string $nullableField)
 * @method self setNullableFieldPresentIfNull(string $nullableFieldPresentIfNull)
 */
class MyEntity extends AbstractEntity
{
    /**
     * @Property(type="int")
     *
     * @var int
     */
    protected $id;

    /**
     * @Property(nullable=true)
     * @var string|null
     */
    protected $nullableField;

    /**
     * @Property(required=true, nullable=true)
     *
     * @var string|null
     */
    protected $nullableFieldPresentIfNull;
}
