<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

abstract class DataTransferObject
{
    private const TYPE_MAP = [
        'boolean' => 'bool',
        'integer' => 'int',
        'double' => 'float',
        'string' => 'string',
        'array' => 'array',
        'object' => 'object'
    ];

    public function __construct(array $data)
    {
        $reflection = new \ReflectionClass(static::class);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PUBLIC);

        // 2 stages
        //
        // 1. check if the array passed as argument fits the properties that class defines
        // 2. check if the value in the data array corresponds to the value/instance of DTO's property

        foreach($properties as $property)
        {
            $name = $property->getName();
            $value = $data[$name] ?? null;
            $expected = $property->getType()->getName();

            if(is_null($value) && $property->getType()->allowsNull())
            {
                $this->{$property->getName()} = $value;
            }
            else
            {
                // Stage 1
                if(is_null($value))
                {
                    throw new \InvalidArgumentException(sprintf("Property [%s] is not defined in the data array.", $name));
                }

                // Stage 2
                // For built-in types, we've to use a map that arranges values so we can compare them
                // For non-built-in types, we inspect the instanceof
                if($property->getType()->isBuiltin())
                {
                    $actual = self::TYPE_MAP[gettype($value)] ?? null;

                    if(null === $actual && !$property->getType()->allowsNull())
                    {
                        throw new \InvalidArgumentException(sprintf("Unsupported type for property: %s, got: %s",
                                $name, gettype($value)
                            )
                        );
                    }

                    if((!is_null($actual) && !$property->getType()->allowsNull()) && $actual !== $expected)
                    {
                        throw new \InvalidArgumentException(
                            sprintf("Property [%s] type mismatch. Expected %s, got %s. Actual: %s, expected: %s",
                                $name,
                                $expected,
                                gettype($value),
                                $actual,
                                $expected
                            )
                        );
                    }
                }
                else
                {
                    if(!($value instanceof $expected))
                    {
                        throw new \InvalidArgumentException(
                            sprintf("Property [%s] instanceof mismatch. Expected %s, got %s.",
                                $name,
                                $expected,
                                gettype($value)
                            )
                        );
                    }
                }
            }

            // If we got here, everything is fine and dandy and unicorns
            // are running across rainbows shitting M&M's
            $this->{$property->getName()} = $value;
        }
    }

    public function __get($key)
    {
        return property_exists($this, $key) ? $this->{$key} : null;
    }
}
