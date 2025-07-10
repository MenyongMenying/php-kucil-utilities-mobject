<?php

namespace MenyongMenying\MLibrary\Kucil\Utilities\MObject;

use MenyongMenying\MLibrary\Kucil\Utilities\MString\MString;
use MenyongMenying\MLibrary\Kucil\Utilities\MArray\MArray;

/**
 * @author MenyongMenying <menyongmenying.main@email.com>
 * @version 0.0.1
 * @date 2025-07-01
 */
final class MObject
{
    /**
     * Objek dari class 'MString'.
     * @var \MenyongMenying\MLibrary\Kucil\Utilities\MString\MString 
     */
    private MString $mString;

    /**
     * Objek dari class 'MArray'.
     * @var \MenyongMenying\MLibrary\Kucil\Utilities\MArray\MArray 
     */
    private MArray $mArray;

    /**
     * @param  \MenyongMenying\MLibrary\Kucil\Utilities\MString\MString $mString 
     * @param  \MenyongMenying\MLibrary\Kucil\Utilities\MArray\MArray   $mArray  
     * @return void
     */
    public function __construct(MString $mString, MArray $mArray)
    {
        $this->mString = $mString;
        $this->mArray = $mArray;
        return;        
    }

    /**
     * Mengecek apakah suatu nilai merupakan object.
     * @param  mixed $object Nilai yang akan dicek.
     * @return bool          Hasil pengecekan.
     */
    public function isObject(mixed $object) :bool
    {
        return is_object($object);
    }

    /**
     * Mengecek apakah suatu objek bernilai kosong.
     * @param  mixed $object Objek yang akan dicek.
     * @return bool          Hasil pengecekan.
     */
    public function isEmpty(mixed $object) :bool
    {
        return $this->mArray->isEmpty($this->convertToArray($object));
    }

    /**
     * Mengecek apakah suatu objek bernilai null.
     * @param  object $class         Class dari objek yang akan dicek.
     * @param  string $indexProperty Index property yang akan dicek.
     * @return bool                  Hasil pengecekan.
     */
    public function isNull(object $class, string $indexProperty) :bool
    {
        return !isset($class->$indexProperty);
    }

    /**
     * Meneruskan banyak property yang ada pada objek.
     * @param  mixed $object Objek yang akan dicari jumlah propertynya.
     * @return int           Meneruskan jumlah property dari $object.
     */
    public function count(mixed $object) :int
    {
        return $this->mArray->count($this->convertToArray($object));
    }

    /**
     * Menggabungkan beberapa objek.
     * @param  mixed ...$object Objek-objek yang akan digabungkan. 
     * @return object           Hasil penggabungan object.
     */
    public function merge(object ...$object) :object
    {
        return $this->mArray->convertToObject($this->mArray->merge(...($this->convertToArray(...$object))));
    }

    /**
     * Menggabungkan beberapa objek.
     * @param  mixed ...$object  Objek-objek yang akan digabungkan. 
     * @return object            Hasil penggabungan objek.
     */
    public function mergeRecursive(object ...$object) :object
    {
        return $this->mArray->convertToObject($this->mArray->mergeRecursive(...($this->convertToArray(...$object))));
    }

    /**
     * Undocumented function
     * @param  object $objectA    
     * @param  object ...$objectB 
     * @return object            
     */
    public function replace(object $objectA, object ...$objectB) :object
    {
        return $this->mArray->convertToObject($this->mArray->replace($this->convertToArray($objectA), ...($this->convertToArray(...$objectB))));
    }

    /**
     * Undocumented function
     * @param  object $objectA    
     * @param  object ...$objectB 
     * @return object            
     */
    public function replaceRecursive(object $objectA, object ...$objectB) :object
    {
        return $this->mArray->convertToObject($this->mArray->replaceRecursive($this->convertToArray($objectA), ...($this->convertToArray(...$objectB))));
    }

    /**
     * Meneruskan semua index property yang ada pada objek.
     * @param  mixed $object Objek yang akan diambil semua index propertynya.
     * @return array         Semua index property dari $object.
     */
    public function getAllIndex(mixed $object) :array
    {
        return $this->mArray->getAllIndex($this->convertToArray($object));
    }

    /**
     * Meneruuskan semua value property yang ada pada objek.
     * @param  mixed $object Objek yang akan diambil semua value propertynya.
     * @return array         Semua value property dari $object.
     */
    public function getAllValue(mixed $object) :array
    {
        return $this->mArray->getAllValue($this->convertToArray($object));
    }

    /**
     * Mengecek apakah suatu property dengan index $index ada pada objek.
     * @param  mixed  $object Objek yang akan dicek.
     * @param  string $index  Index dari property yang akan dicek.
     * @return bool           Hasil pengecekan.
     */
    public function indexExists(mixed $object, string $index) :bool
    {
        return property_exists($object, $index);
    }

    /**
     * Mengecek apakah suatu value property dengan value $value ada pada objek.
     * @param  mixed  $object Objek yang akan dicek.
     * @param  string $value  Nilai yang akan dicek.
     * @return bool           Hasil pengecekan.
     */
    public function valueExists(mixed $object, string $value) :bool
    {
        return $this->mArray->valueExists($this->convertToArray($object), $value);
    }

    /**
     * Meneruskan index property yang pertama kali ditambahkan pada objek.
     * @param  mixed $object Objek yang akan diteruskan index property pertamanya.
     * @return mixed         Index dari property pertama.
     */
    public function indexFirst(mixed $object) :mixed
    {
        return $this->mArray->indexFirst($this->convertToArray($object));
    }

    /**
     * Meneruskan index property yang terakhir ditambahkan pada objek.
     * @param  mixed $object Objek yang akan diteruskan index property terakhirnya. 
     * @return mixed         Index dari property terakhir.
     */
    public function indexLast(mixed $object) :mixed
    {
        return $this->mArray->indexLast($this->convertToArray($object));
    }

    /**
     * Meneruskan value property yang pertama kali ditambahkan pada objek.
     * @param  mixed $object Objek yang akan diteruskan value property pertamanya.
     * @return mixed         Value dari property pertama.
     */
    public function valueFirst(mixed $object) :mixed
    {
        return $this->mArray->valueFirst($this->convertToArray($object));
    }

    /**
     * Meneruskan value property yang terakhir ditambahkan pada objek.
     * @param  mixed $object Obbjek yang akan diteruskan value property terakhirnya.
     * @return mixed         Value dari property terakhir.
     */
    public function valueLast(mixed $object) :mixed
    {
        return $this->mArray->valueLast($this->convertToArray($object));
    }

    /**
     * Mengubah objek menjadi array.
     * @param  object $object Objek yang akan diubah.
     * @return array          Array dari $object.
     */
    public function convertToArray(object $object) :array
    {
        return (array) $object;
    }
}