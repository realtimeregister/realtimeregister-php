<?php declare(strict_types = 1);

namespace SandwaveIo\RealtimeRegister\Domain;

final class LaunchPhaseCollection extends AbstractCollection
{
    /** @var LaunchPhase[] */
    public $entities;

    public static function fromArray(array $json): LaunchPhaseCollection
    {
        return parent::fromArray($json);
    }

    public function offsetGet($offset): ?LaunchPhase
    {
        return isset($this->entities[$offset]) ? $this->entities[$offset] : null;
    }

    public static function parseChild(array $json): LaunchPhase
    {
        return LaunchPhase::fromArray($json);
    }
}
