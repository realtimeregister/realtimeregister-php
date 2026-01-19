<?php declare(strict_types = 1);

namespace RealtimeRegister\Domain\Enum;

abstract class AbstractEnum
{
    /** @var array */
    protected static array $values = [];

    /** @param mixed $value */
    abstract public static function validate($value): void;

    /** @param mixed $value */
    protected static function assertValueValid($value): void
    {
        if (! in_array($value, static::$values)) {
            $message = sprintf(
                'Unexpected ENUM value in in class %s: %s. Possible values: (%s)',
                static::class,
                $value,
                implode(', ', static::$values)
            );
            trigger_error($message, E_USER_WARNING);
        }
    }
}
