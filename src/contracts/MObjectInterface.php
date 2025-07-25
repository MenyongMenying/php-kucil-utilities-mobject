<?php

namespace MenyongMenying\MLibrary\Kucil\Utilities\MObject\Contracts;

use MenyongMenying\MLibrary\Kucil\Utilities\MArray\MArray;

/**
 * @author MenyongMenying <menyongmenying.main@email.com>
 * @version 0.0.1
 * @date 2025-07-30
 */
interface MObjectInterface
{
    /**
     * @param  \MenyongMenying\MLibrary\Kucil\Utilities\MArray\MArray $mArray  
     * @return void
     */
    public function __construct(MArray $mArray);

    /**
     * Mengecek apakah suatu nilai merupakan objek.
     * @param  mixed     $value Nilai yang akan dicek.
     * @return null|bool        Hasil pengecekan.
     */
    public function isObject(mixed $value) :null|bool;

    /**
     * Mengecek apakah suatu objek bernilai kosong.
     * @param  object    $object Objek yang akan dicek.
     * @return null|bool         Hasil pengecekan.
     */
    public function isEmpty(object $object) :null|bool;

    /**
     * Mengecek apakah suatu property pada objek bernilai null atau tidak ada.
     * @param  object    $object Objek yang akan dicek.
     * @param  string    $index  Index property yang akan dicek.
     * @return null|bool         Hasil pengecekan.
     */
    public function isNull(object $object, string $index) :null|bool;

    /**
     * Mengecek apakah suatu property pada objek tidak ada.
     * @param  object    $object Objek yang akan dicek.
     * @param  string    $index  Index property yang akan dicek.
     * @return null|bool         Hasil pengecekan.
     */
    public function isPropertyNotSet(object $object, string $index) :null|bool;

    /**
     * Meneruskan banyak property yang ada pada objek.
     * @param  object   $object Objek yang akan dicari jumlah propertynya.
     * @return null|int         Meneruskan jumlah property dari $object.
     */
    public function count(object $object) :null|int;

    /**
     * Menggabungkan beberapa objek.
     * @param  mixed      ...$object Objek-objek yang akan digabungkan. 
     * @return null|object           Hasil penggabungan objek.
     */
    public function merge(object ...$object) :null|object;

    /**
     * Menggabungkan beberapa objek secara rekursif.
     * @param  mixed      ...$object Objek-objek yang akan digabungkan. 
     * @return null|object           Hasil penggabungan objek.
     */
    public function mergeRecursive(object ...$object) :null|object;

    /**
     * Menggabungkan banyak object menggunakan operator + (tidak menimpa key yang sudah ada di object kiri).
     * @param  object      $objectA     Objek utama yang akan dipertahankan key-nya.
     * @param  object      ...$objectB  Objek-objek lain yang akan ditambahkan jika key-nya belum ada.
     * @return null|object             Hasil penggabungan.
     */
    public function mergeByAddition(object $objectA, object ...$objectB) :null|object;

    /**
     * Undocumented function
     * @param  object      $objectA    
     * @param  object      ...$objectB 
     * @return null|object            
     */
    public function replace(object $objectA, object ...$objectB) :null|object;

    /**
     * Undocumented function
     * @param  object      $objectA    
     * @param  object      ...$objectB 
     * @return null|object            
     */
    public function replaceRecursive(object $objectA, object ...$objectB) :null|object;

    /**
     * Mengeecek apakah suatu objek memiliki nilai dengan index tertentu.
     * @param  object    $object objek yang akan dicek.
     * @param  string    $key    Index objek yang akan dicek.
     * @return null|bool         Hasil pengecekan.
     */
    public function indexExists(object $object, string $index) :null|bool;

    /**
     * Mengecek apakah suatu objek memiliki nilai tertentu.
     * @param  object    $object Objek yang akan dicek.
     * @param  mixed     $value  Nilai yang akan dicek.
     * @return null|bool         Hasil pengecekan.
     */
    public function valueExists(object $object, mixed $value) :null|bool;

    /**
     * Meneruskan index pertama dari objek.
     * @param  object $object Objek yang akan diambil index pertamanya.
     * @return mixed          Index pertama dari $object.
     */
    public function indexFirst(object $object) :mixed;

    /**
     * Meneruskan index terakhir dari Objek.
     * @param  object $object Objek yang akan diambil index terakhirnya.
     * @return mixed          Index terakhir dari $object.
     */
    public function indexLast(object $object) :mixed;

    /**
     * Meneruskan nilai pertama  dari objek..
     * @param  object $object Objek yang akan diambil nilai pertamanya.   
     * @return mixed          Nilai pertama dari $object.
     */
    public function valueFirst(object $object) :mixed;

    /**
     * Menerima nilai terakhir dari objek.
     * @param  object $object Objek yang akan diambil nilai terakhirnya.
     * @return mixed          Nilai terakhir dari $object.
     */
    public function valueLast(object $object) :mixed;

    /**
     * Mengubah objek menjadi array.
     * @param  object     $object    Objek yang akan diubah menjadi array.
     * @param  bool       $recursive Apakah akan mengubah objek secara rekursif.
     * @return null|array            Array $object.
     */
    public function convertToArray(object $object, bool $recursive = false) :null|array;
}