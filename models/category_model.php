<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class category_model extends model
{

    /** =================================== | GET | =================================== **/

    /**
     * Tüm kategorileri listler
     * @return object
     */
    public function allCategory()
    {
        $select = $this->DB->prepare("
            SELECT
               *
            FROM
                category

        ");

        $select->execute();
        if($select->rowCount() > 0)
        {
            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        return false;
    }

    /** =================================== | DELETE | =================================== **/

    /**
     * Bir kategory silmek için kullanılır..
     * @param  integer $categoryId kategoriId
     * @return boolean
     */
    public function delete($categoryId)
    {
        $delete = $this->DB->prepare("
            DELETE
            FROM
                category
            WHERE
                categoryId = ?
        ");

        $delete->execute(array($categoryId));
        if($delete->rowCount() > 0)
        {
            return true;
        }

        return false;
    }


    /** =================================== | CONTROLs | =================================== **/


    /**
     * Kaategoriye ait haber var mı diye bakr..
     * @param  integer $categoryId kategori id'si
     * @return boolean
     */
    public function categoryCtrl($categoryId)
    {

        $select = $this->DB->prepare("
            SELECT
                *
            FROM
                news
            WHERE
                newsCategory = ?
        ");

        $select->execute(array($categoryId));

        if($select->rowCount() > 0)
        {
            return true;
        }

        return false;

    }


    /**
     * Kaategoriye ait haber var mı diye bakr..
     * @param  integer $categoryId kategori id'si
     * @return boolean
     */
    public function categoryNameCtrl($categoryName)
    {

        $select = $this->DB->prepare("
            SELECT
                *
            FROM
                category
            WHERE
                categoryName = ?
        ");

        $select->execute(array($categoryName));

        if($select->rowCount() > 0)
        {
            return true;
        }

        return false;

    }



    /** =================================== | INSERT | =================================== **/


    /**
     * Yeni bir kategori ekeler
     * @param  string $data kategori adı
     * @return boolean
     */
    public function insert($categoryName)
    {


        $insert = $this->DB->prepare("
            INSERT INTO
                category
            SET
                categoryName = ?
        ");

        $insert->execute(array($categoryName));
        if($insert->rowCount() > 0)
        {
           return  $this->DB->lastInsertId();
        }

        return false;
    }


    /**
     * KAtegoriyi güncellemek için kullanıılır..
     * @param  string $data kategori adı
     * @return boolean
     */
    public function update($data,$categoryId)
    {
        $update = $this->DB->prepare("
            UPDATE
                category
            SET
                categoryName = ?
            WHERE
                categoryId = ?
        ");

        $update->execute(array($categoryName,$categoryId));
        if($update)
        {
            return true;
        }

        return false;
    }












}