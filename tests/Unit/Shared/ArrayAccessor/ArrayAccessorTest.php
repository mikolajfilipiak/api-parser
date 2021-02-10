<?php

declare(strict_types=1);


namespace Musement\Tests\Unit\Shared\ArrayAccessor;

use Musement\Shared\ArrayAccessor\ArrayAccessor;
use Musement\Shared\ArrayAccessor\Exception\InvalidTypeException;
use Musement\Shared\ArrayAccessor\Exception\KeyNotExistException;
use Musement\Tests\Unit\UnitTestCase;

final class ArrayAccessorTest extends UnitTestCase
{
    public function test_string_key_not_exist_exception() : void
    {
        $this->expectException(KeyNotExistException::class);

        $array = [];

        ArrayAccessor::string($array, 'key');
    }

    public function test_string_invalid_type_exception() : void
    {
        $this->expectException(InvalidTypeException::class);

        $array = [
            'key' => \rand(0, 10),
        ];

        ArrayAccessor::string($array, 'key');
    }

    public function test_string_or_null_key_not_exist_exception() : void
    {
        $this->expectException(KeyNotExistException::class);

        $array = [];

        ArrayAccessor::stringOrNull($array, 'key');
    }

    public function test_string_or_null_invalid_type_exception() : void
    {
        $this->expectException(InvalidTypeException::class);

        $array = [
            'key' => $value = \rand(0, 10),
        ];

        ArrayAccessor::stringOrNull($array, 'key');
    }

    public function test_int_key_not_exist_exception() : void
    {
        $this->expectException(KeyNotExistException::class);

        $array = [];

        ArrayAccessor::int($array, 'key');
    }

    public function test_int_invalid_type_exception() : void
    {
        $this->expectException(InvalidTypeException::class);

        $array = [
            'key' => \uniqid('int-'),
        ];

        ArrayAccessor::int($array, 'key');
    }

    public function test_int_or_null_key_not_exist_exception() : void
    {
        $this->expectException(KeyNotExistException::class);

        $array = [];

        ArrayAccessor::intOrNull($array, 'key');
    }

    public function test_int_or_null_invalid_type_exception() : void
    {
        $this->expectException(InvalidTypeException::class);

        $array = [
            'key' => $value =  \uniqid('int-'),
        ];

        ArrayAccessor::intOrNull($array, 'key');
    }

    public function test_float_key_not_exist_exception() : void
    {
        $this->expectException(KeyNotExistException::class);

        $array = [];

        ArrayAccessor::float($array, 'key');
    }

    public function test_float_invalid_type_exception() : void
    {
        $this->expectException(InvalidTypeException::class);

        $array = [
            'key' => $value =  \uniqid('float-'),
        ];

        ArrayAccessor::float($array, 'key');
    }

    public function test_float_or_null_key_not_exist_exception() : void
    {
        $this->expectException(KeyNotExistException::class);

        $array = [];

        ArrayAccessor::floatOrNull($array, 'key');
    }

    public function test_float_or_null_invalid_type_exception() : void
    {
        $this->expectException(InvalidTypeException::class);

        $array = [
            'key' => $value =  \uniqid('float-'),
        ];

        ArrayAccessor::floatOrNull($array, 'key');
    }

    public function test_array_key_not_exist_exception() : void
    {
        $this->expectException(KeyNotExistException::class);

        $array = [];

        ArrayAccessor::array($array, 'key');
    }

    public function test_array_invalid_type_exception() : void
    {
        $this->expectException(InvalidTypeException::class);

        $array = [
            'key' => $value =  \uniqid('array-'),
        ];

        ArrayAccessor::array($array, 'key');
    }

    public function test_array_or_null_key_not_exist_exception() : void
    {
        $this->expectException(KeyNotExistException::class);

        $array = [];

        ArrayAccessor::arrayOrNull($array, 'key');
    }

    public function test_array_or_null_invalid_type_exception() : void
    {
        $this->expectException(InvalidTypeException::class);

        $array = [
            'key' => $value =  \uniqid('array-'),
        ];

        ArrayAccessor::arrayOrNull($array, 'key');
    }

    public function test_get_value() : void
    {
        $testArray = [
            'first' => [
                'second' => [
                    'string' => $string = \uniqid('string-'),
                    'null' => $null = null,
                    'int' => $int = \rand(1, 10),
                    'float' => $float = (float) (\rand(10, 100) / 10),
                    'array' => $array = [],
                ],
            ],
        ];

        $this->assertSame($string, ArrayAccessor::string($testArray, 'first.second.string'));
        $this->assertSame($string, ArrayAccessor::stringOrNull($testArray, 'first.second.string'));
        $this->assertSame($null, ArrayAccessor::stringOrNull($testArray, 'first.second.null'));
        $this->assertSame($int, ArrayAccessor::int($testArray, 'first.second.int'));
        $this->assertSame($int, ArrayAccessor::intOrNull($testArray, 'first.second.int'));
        $this->assertSame($null, ArrayAccessor::intOrNull($testArray, 'first.second.null'));
        $this->assertSame($float, ArrayAccessor::float($testArray, 'first.second.float'));
        $this->assertSame((float) $int, ArrayAccessor::float($testArray, 'first.second.int'));
        $this->assertSame($float, ArrayAccessor::floatOrNull($testArray, 'first.second.float'));
        $this->assertSame((float) $int, ArrayAccessor::floatOrNull($testArray, 'first.second.int'));
        $this->assertSame($null, ArrayAccessor::floatOrNull($testArray, 'first.second.null'));
        $this->assertSame($array, ArrayAccessor::array($testArray, 'first.second.array'));
        $this->assertSame($array, ArrayAccessor::arrayOrNull($testArray, 'first.second.array'));
        $this->assertSame($null, ArrayAccessor::arrayOrNull($testArray, 'first.second.null'));
    }
}
