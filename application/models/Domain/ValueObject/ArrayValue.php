<?php

namespace Model\Domain\ValueObject;

class ArrayValue
{
    private $data;

    public function __construct(array $data)
    {
        if(empty($data)) {
            throw new \Exception('The data can not be empty.');
        }

        $this->data = $data;
    }

    public function get($key)
    {
        return $this->has($key)
            ? $this->data[$key]
            : null;
    }

    public function isEqual($arrayKey, array $valuesToCompare)
    {
        return $this->has($arrayKey) && in_array($this->get($arrayKey), $valuesToCompare);
    }

    public function has($key)
    {
        return array_key_exists($key, $this->data) && !empty($this->data[$key]);
    }

    public function hasKeys($keys)
    {
        return !empty(array_filter($keys, function($key) {
            return $this->has($key);
        }));
    }
}