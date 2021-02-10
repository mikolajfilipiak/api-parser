<?php

declare(strict_types=1);


namespace Musement\Shared\ArrayAccessor;

use Minwork\Helper\Arr;
use Musement\Shared\ArrayAccessor\Exception\InvalidTypeException;
use Musement\Shared\ArrayAccessor\Exception\KeyNotExistException;

final class ArrayAccessor
{
    /**
     * @param array<mixed> $array
     * @param string $key
     * @return string
     * @throws InvalidTypeException
     * @throws KeyNotExistException
     */
    public static function string(array $array, string $key) : string
    {
        if (!Arr::has($array, $key)) {
            throw new KeyNotExistException();
        }
        
        $value = Arr::get($array, $key);
        
        if (\is_string($value)) {
            return $value;
        }
        
        throw new InvalidTypeException();
    }

    /**
     * @param array<mixed> $array
     * @param string $key
     * @return string|null
     * @throws InvalidTypeException
     * @throws KeyNotExistException
     */
    public static function stringOrNull(array $array, string $key) : ?string
    {
        if (!Arr::has($array, $key)) {
            throw new KeyNotExistException();
        }
        
        $value = Arr::get($array, $key);
        
        if (\is_string($value) || \is_null($value)) {
            return $value;
        }
        
        throw new InvalidTypeException();
    }

    /**
     * @param array<mixed> $array
     * @param string $key
     * @return int
     * @throws InvalidTypeException
     * @throws KeyNotExistException
     */
    public static function int(array $array, string $key) : int
    {
        if (!Arr::has($array, $key)) {
            throw new KeyNotExistException();
        }

        $value = Arr::get($array, $key);

        if (\is_int($value)) {
            return $value;
        }

        throw new InvalidTypeException();
    }

    /**
     * @param array<mixed> $array
     * @param string $key
     * @return int|null
     * @throws InvalidTypeException
     * @throws KeyNotExistException
     */
    public static function intOrNull(array $array, string $key) : ?int
    {
        if (!Arr::has($array, $key)) {
            throw new KeyNotExistException();
        }

        $value = Arr::get($array, $key);

        if (\is_int($value) || \is_null($value)) {
            return $value;
        }

        throw new InvalidTypeException();
    }

    /**
     * @param array<mixed> $array
     * @param string $key
     * @return float
     * @throws InvalidTypeException
     * @throws KeyNotExistException
     */
    public static function float(array $array, string $key) : float
    {
        if (!Arr::has($array, $key)) {
            throw new KeyNotExistException();
        }

        $value = Arr::get($array, $key);
        if (\is_float($value)) {
            return $value;
        }

        if (\is_int($value)) {
            return (float) $value;
        }

        throw new InvalidTypeException();
    }

    /**
     * @param array<mixed> $array
     * @param string $key
     * @return float|null
     * @throws InvalidTypeException
     * @throws KeyNotExistException
     */
    public static function floatOrNull(array $array, string $key) : ?float
    {
        if (!Arr::has($array, $key)) {
            throw new KeyNotExistException();
        }

        $value = Arr::get($array, $key);

        if (\is_float($value) || \is_null($value)) {
            return $value;
        }

        if (\is_int($value)) {
            return (float) $value;
        }

        throw new InvalidTypeException();
    }

    /**
     * @param array<mixed> $array
     * @param string $key
     * @return array<mixed>
     * @throws InvalidTypeException
     * @throws KeyNotExistException
     */
    public static function array(array $array, string $key) : array
    {
        if (!Arr::has($array, $key)) {
            throw new KeyNotExistException();
        }

        $value = Arr::get($array, $key);

        if (\is_array($value)) {
            return $value;
        }

        throw new InvalidTypeException();
    }

    /**
     * @param array<mixed> $array
     * @param string $key
     * @return array<mixed>|null
     * @throws InvalidTypeException
     * @throws KeyNotExistException
     */
    public static function arrayOrNull(array $array, string $key) : ?array
    {
        if (!Arr::has($array, $key)) {
            throw new KeyNotExistException();
        }

        $value = Arr::get($array, $key);

        if (\is_array($value) || \is_null($value)) {
            return $value;
        }

        throw new InvalidTypeException();
    }
}
