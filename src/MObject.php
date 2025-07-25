<?php

namespace MenyongMenying\MLibrary\Kucil\Utilities\MObject;

use MenyongMenying\MLibrary\Kucil\Utilities\MObject\Contracts\MObjectInterface;
use MenyongMenying\MLibrary\Kucil\Utilities\Data\Data;
use MenyongMenying\MLibrary\Kucil\Utilities\MArray\MArray;

/**
 * @author MenyongMenying <menyongmenying.main@email.com>
 * @version 0.0.1
 * @date 2025-07-30
 */
final class MObject implements MObjectInterface
{
    /**
     * Objek dari class 'MArray'.
     * @var \MenyongMenying\MLibrary\Kucil\Utilities\MArray\MArray 
     */
    private MArray $mArray;

    public function __construct(MArray $mArray)
    {
        $this->mArray = $mArray;
        return;
    }

    public function isObject(mixed $value) :null|bool
    {
        return is_object($value);
    }

    public function isEmpty(object $object) :null|bool
    {
        return $this->mArray->isEmpty($this->convertToArray($object));
    }

    public function isNull(object $object, string $index) :null|bool
    {
        return !property_exists($object, $index) || $object->$index === null;
    }

    public function isPropertyNotSet(object $object, string $index) :null|bool
    {
        return !property_exists($object, $index);
    }

    public function count(object $object) :null|int
    {
        return $this->mArray->count($this->convertToArray($object));
    }

    public function merge(object ...$objects) :null|object
    {
        if (empty($objects)) {
            return new Data();
        }
        $arrays = array_map([$this, 'convertToArray'], $objects);
        $mergedArray = $this->mArray->merge(...$arrays);
        return $this->mArray->convertToObject($mergedArray, true);
    }

    public function mergeRecursive(object ...$objects) :null|object
    {
        if (empty($objects)) {
            return new Data();
        }
        $arrays = array_map([$this, 'convertToArray'], $objects);
        $mergedArray = $this->mArray->mergeRecursive(...$arrays);
        return $this->mArray->convertToObject($mergedArray, true);
    }

    public function mergeByAddition(object $objectA, object ...$objectB): ?object
    {
        $arrayA = $this->convertToArray($objectA);
        $arraysB = array_map([$this, 'convertToArray'], $objectB);
        $mergedArray = $this->mArray->mergeByAddition($arrayA, ...$arraysB);
        return $this->mArray->convertToObject($mergedArray, true);
    }

    public function replace(object $objectA, object ...$objectsB) :null|object
    {
        $arrayA = $this->convertToArray($objectA);
        $arraysB = array_map([$this, 'convertToArray'], $objectsB);
        $replacedArray = $this->mArray->replace($arrayA, ...$arraysB);
        return $this->mArray->convertToObject($replacedArray, true);
    }

    public function replaceRecursive(object $objectA, object ...$objectsB) :null|object
    {
        $arrayA = $this->convertToArray($objectA);
        $arraysB = array_map([$this, 'convertToArray'], $objectsB);
        $replacedArray = $this->mArray->replaceRecursive($arrayA, ...$arraysB);
        return $this->mArray->convertToObject($replacedArray, true);
    }

    public function getAllIndex(object $object) :null|array
    {
        return $this->mArray->getAllIndex($this->convertToArray($object));
    }

    public function getAllValue(object $object) :null|array
    {
        return $this->mArray->getAllValue($this->convertToArray($object));
    }

    public function indexExists(object $object, string $index) :null|bool
    {
        return property_exists($object, $index);
    }

    public function valueExists(object $object, mixed $value) :null|bool
    {
        return $this->mArray->valueExists($this->convertToArray($object), $value);
    }

    public function indexFirst(object $object) :mixed
    {
        return $this->mArray->indexFirst($this->convertToArray($object));
    }

    public function indexLast(object $object) :mixed
    {
        return $this->mArray->indexLast($this->convertToArray($object));
    }

    public function valueFirst(object $object) :mixed
    {
        return $this->mArray->valueFirst($this->convertToArray($object));
    }

    public function valueLast(object $object) :mixed
    {
        return $this->mArray->valueLast($this->convertToArray($object));
    }

    /**
     * Mengubah objek menjadi array.
     * @param  object     $object    Objek yang akan diubah menjadi array.
     * @param  bool       $recursive Apakah akan mengubah objek secara rekursif.
     * @return null|array            Array $object.
     */
    public function convertToArray(object $object, bool $recursive = false): null|array
    {
        $array = [];
        foreach (get_object_vars($object) as $key => $value) {
            if ($recursive) {
                if (is_object($value)) {
                    $array[$key] = $this->convertToArray($value, true);
                } elseif (is_array($value)) {
                    $array[$key] = $this->convertArrayValuesRecursively($value);
                } else {
                    $array[$key] = $value;
                }
            } else {
                $array[$key] = $value;
            }
        }
        return $array;
    }

    /**
     * Membantu convert array yang mungkin berisi objek ke array secara rekursif.
     * @param  array $array
     * @return array
     */
    private function convertArrayValuesRecursively(array $array): array
    {
        foreach ($array as $key => $value) {
            if (is_object($value)) {
                $array[$key] = $this->convertToArray($value, true);
                continue;
            } elseif (is_array($value)) {
                $array[$key] = $this->convertArrayValuesRecursively($value);
                continue;
            }
            continue;
        }
        return $array;
    }

    protected function cleanPropertyKey(string $key) :null|string
    {
        return preg_replace('/^\x00.+\x00/', '', $key);
    }

    public function getPropertyValue(object $object, string $index, mixed $default = null) :mixed
    {
        if (!$this->indexExists($object, $index)) {
            return $default;
        }
        return $object->$index;
    }

    public function setPropertyValue(object $object, string $index, mixed $value) :void
    {
        $object->$index = $value;
        return;
    }

    public function removeProperty(object $object, string $index) :void
    {
        if ($this->indexExists($object, $index)) {
            unset($object->$index);
        }
        return;
    }
}