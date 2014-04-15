<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class page_model extends model
{

    /** =================================== | GET | =================================== **/



    /**
     * Slider'a ait haberleri çeker..
     * @return object
     */
    public function getAllSliderPages()
    {

        $select = $this->DB->prepare("
            SELECT
                pagesId,
                pagesTitle,
                LEFT(pagesBody,150) as pagesBody,
                pagesHit,
                pagesImage,
                pagesDate,
                showContent
            FROM
                pages
            LEFT JOIN category ON (pages.pagesCategory = category.categoryId)

            WHERE
                category.categoryName = 'Slider Pages'


        ");

        $select->execute();

        if($select->rowCount() > 0)
        {
            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        return false;

    }



    /**
     * Tüm haberleri listeler
     * @return object
     */
    public function allPages($parentId = false)
    {
        $parent = $parentId ? "WHERE pageId = $parentId" : null;
        $select = $this->DB->prepare("
            SELECT
                pageId,
                pageTitle,
                LEFT(pageBody, 80) as pageBody,
                pageParent,
                pageLink
            FROM
                pages
            $parent
            ORDER BY pageId DESC
        ");

        $select->execute();
        if($select->rowCount() > 0)
        {
            if($parentId)
            {
                return $select->fetch(PDO::FETCH_OBJ);
            }
            else{
                return $select->fetchAll(PDO::FETCH_OBJ);
            }

        }

        return false;
    }


    /**
     * Haber Id'sine göre haber çeker
     * @param  integer $pagesId Sayfayı Id'si
     * @return object
     */
    public function getPageById($pageId)
    {

        $select = $this->DB->prepare("

            SELECT
                *
            FROM
                pages

            WHERE
                pageId = ?
        ");

        $select->execute(array($pageId));

        if($select->rowCount() > 0)
        {
            return  $select->fetch(PDO::FETCH_OBJ);
        }

        return false;

    }

    /**
     * Sayfa bilgilerini linke göre çeker
     * @param  string $pageLink sayfa linki
     * @return objec
     */
    public function pageDetail($pageLink)
    {

        $select = $this->DB->prepare("
            SELECT
                *
            FROM
                pages
            WHERE
                pageLink = ?
        ");
        $select->execute(array($pageLink));

        if($select->rowCount() > 0)
        {

            return $select->fetch(PDO::FETCH_OBJ);
        }

        return false;

    }

    /** =================================== | CONTROLS | =================================== **/

    /**
     * Sayfayı linke göre kontrol eder
     * @param  string $pageLink safanın linki
     * @return boolean
     */
    public function pageCtrlByLink($pageLink)
    {

        $select = $this->DB->prepare("
            SELECT
                *
            FROM
                pages
            WHERE
                pageLink = ?
        ");

        $select->execute(array($pageLink));
        if($select->rowCount() > 0)
        {
            return true;
        }

        return false;

    }

    /**
     * Haber içeriğine göre Sayfayıkontrol eder.
     * @param  array $data haber detayları
     * @return integer
     */
    public function pageCtrlByContent($data)
    {


        extract($data);

        $select = $this->DB->prepare("
            SELECT
                *
            FROM
                pages
            WHERE
                pageTitle = ?
              AND
                pageBody  = ?
              AND
                pageParent =?
        ");

        $select->execute(array($pageTitle,$pageBody,$pageParent));
        if($select->rowCount() > 0)
        {
            return true;
        }

        return false;

    }


    /**
     * Sayfayı varlığını kontrol eder
     * @param  integer $pagesId Sayfayı id'si
     * @return boolean
     */
    public function pageCtrl($pageId)
    {

        $select = $this->DB->prepare("
            SELECT
                pageId
            FROM
                pages
            WHERE
                pageId = ?
        ");

        $select->execute(array($pageId));

        if($select->rowCount() > 0)
        {
            return true;
        }

        return false;

    }


    /** =================================== | INSERTs | =================================== **/

    /**
     * Haber Eklemek için kullanılır.
     * @param  array $data haber datata
     * @return boolean
     */
    public function pageInsert($data)
    {

        extract($data);
        $pageLink  = helper::isEmpty($pageLink) ? helper::sefLink($pageTitle) : $pageLink;



        $insert = $this->DB->prepare("
            INSERT INTO
                pages
            SET
                pageTitle  = ?,
                pageBody   = ?,
                pageParent = ?,
                pageLink    = ?,
                sideBar     = ?


        ");



        $insert->execute(array($pageTitle, $pageBody, $pageParent,$pageLink,$sideBar));

        if($insert->rowCount() > 0)
        {
            return $this->DB->lastInsertId();
        }

        return false;
    }



    /** =================================== | UPDATEs | =================================== **/

    /**
     * Sayfayıgünceller
     * @param  integer $pagesId Sayfayı id'si
     * @param  array $data   Sayfayı detayları
     * @return boolean
     */
    public function updatePage($pageId,$data)
    {


        extract($data);
        $pageLink  = helper::isEmpty($pageLink) ? helper::sefLink($pageTitle) : $pageLink;

        $update  = $this->DB->prepare("
            UPDATE
                pages
            SET
                pageTitle = ?,
                pageBody = ?,
                pageParent = ?,
                pageLink = ?,
                sideBar = ?,
                pageOrder = ?
            WHERE
                pageId = ?

        ");

        $update->execute(array($pageTitle,$pageBody,$pageParent,$pageLink,$sideBar,$pageOrder,$pageId));

        if($update)
        {
            return true;
        }

        return false;
    }


    /**
     * Sayfaların parentini günceller
     * @param  integer $pageId sayfa id'si
     * @return string
     */
    public function updatePageParents($pageId)
    {
        $update  = $this->DB->prepare("
            UPDATE
                pages
            SET
                pageParent = 0
            WHERE
                pageParent = ?
        ");

        $update->execute(array($pageId));

        if($update)
        {
            return true;
        }

        return false;
    }


    /** =================================== | DELETE | =================================== **/

    /**
     * Bir haber siler
     * @param  integer $pagesId Sayfayı id'si..
     * @return boolean
     */
    public function deletePage($pageId)
    {
        $delete = $this->DB->prepare("
            DELETE
            FROM
                pages
            WHERE
                pageId = ?
        ");

        $delete->execute(array($pageId));
        if($delete->rowCount() > 0)
        {
            //Silinme başarılı olduysa bu silinenlerin
            //Alt sayfalarını parentLerini güncelle.

            return true;
        }

        return false;
    }













}