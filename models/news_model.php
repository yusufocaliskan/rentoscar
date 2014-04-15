<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class news_model extends model
{

    /** =================================== | GET | =================================== **/

    /**
     * Slider'a ait haberleri çeker..
     * @return object
     */
    public function getAllSliderNews()
    {

        $select = $this->DB->prepare("
            SELECT
                newsId,
                newsTitle,
                LEFT(newsBody,150) as newsBody,
                newsHit,
                newsImage,
                newsDate,
                showContent,
                newsLink
            FROM
                news
            LEFT JOIN category ON (news.newsCategory = category.categoryId)

            WHERE
                category.categoryName = 'Slider News'


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
    public function allNews($limit = false, $newsBody = false,$all = false)
    {
        $limit = $limit ? "LIMIT $limit" : '';
        $newsBody = $newsBody ? ",LEFT(news.newsBody, $newsBody) as newsBody" : '';

        $all = $all ? "WHERE  news.newsBody IS NOT NULL AND news.newsBody != ''" : null;
        $select = $this->DB->prepare("
            SELECT
                *
                $newsBody
            FROM
                news
                LEFT JOIN category ON (category.categoryId = news.newsCategory )

            $all

            ORDER BY news.newsId DESC

            $limit
        ");

        $select->execute();
        if($select->rowCount() > 0)
        {
            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        return false;
    }


    /**
     * Haber Id'sine göre haber çeker
     * @param  integer $newsId haberin Id'si
     * @return object
     */
    public function getNewsById($newsId)
    {

        $select = $this->DB->prepare("

            SELECT
                *
            FROM
                news

            WHERE
                newsId = ?
        ");

        $select->execute(array($newsId));

        if($select->rowCount() > 0)
        {
            return  $select->fetch(PDO::FETCH_OBJ);
        }

        return false;

    }

    /**
     * Haberin Link'ine göre haber listeler
     * @param  strings $newsLink haberin linki
     * @return boolean
     */
    public function getNewByLink($newsLink)
    {
        $select = $this->DB->prepare("
            SELECT
                *
            FROM
                news
                LEFT JOIN  category ON (category.categoryId = news.newsCategory)
            WHERE
                news.newsLink = ?
        ");

        $select->execute(array($newsLink));
        if($select->rowCount() > 0)
        {
            return $select->fetch(PDO::FETCH_OBJ);
        }

        return false;
    }

    /** =================================== | CONTROLS | =================================== **/

    /**
     * Haber içeriğine göre haberi kontrol eder.
     * @param  array $data haber detayları
     * @return integer
     */
    public function newsCtrlByContent($data)
    {

        extract($data);

        $select = $this->DB->prepare("
            SELECT
                *
            FROM
                news
            WHERE
                newsTitle = ?
                AND
                newsBody  = ?
                AND
                newsCategory =?
        ");

        $select->execute(array($newsTitle,$newsBody,$newsCategory));
        if($select->rowCount() > 0)
        {
            return true;
        }

        return false;

    }

    /**
     * Daha önce bu haber ekli mi?
     * @param  array $data haberdata
     * @return boolean
     */
    public function newsCtrlByLink($data)
    {
        $select = $this->DB->prepare("
            SELECT
                *
            FROM
                news
            WHERE
                newsLink = ?
        ");

        $select->execute(array(helper::sefLink($data['newsTitle'])));

        if($select->rowCount() > 0)
        {
            return true;
        }

        return false;
    }

    /**
     * Haberin varlığını kontrol eder
     * @param  integer $newsId haberin id'si
     * @return boolean
     */
    public function newsCtrl($newsId)
    {

        $select = $this->DB->prepare("
            SELECT
                newsId
            FROM
                news
            WHERE
                newsId = ?
        ");

        $select->execute(array($newsId));

        if($select->rowCount() > 0)
        {
            return true;
        }

        return false;

    }


    /**
     * Haberi link'e göre kontrol eder
     * @param  string $newsLink haberin linki
     * @return boolean
     */
    public function newsControlByLink($newsLink)
    {
        $select = $this->DB->prepare("
            SELECT
                newsLink
            FROM
                news
            WHERE
                newsLink = ?
            AND
                newsBody IS NOT NULL
            AND
                newsBody !=''
        ");


        $select->execute(array($newsLink));
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
    public function newsInsert($data)
    {
        extract($data);

        $insert = $this->DB->prepare("
            INSERT INTO
                news
            SET
                newsTitle   = ?,
                newsBody    = ?,
                newsCategory = ?,
                showContent  = ?,
                newsHit     = ?,
                newsLink = ?


        ");

        $insert->execute(array($newsTitle,$newsBody,$newsCategory,$showContent,1,helper::sefLink($newsTitle)));
        if($insert->rowCount() > 0)
        {
            return $this->DB->lastInsertId();
        }

        return false;
    }



    /** =================================== | UPDATEs | =================================== **/

    public function updateNewsHit($newsLink)
    {

        $update = $this->DB->prepare("

            UPDATE
                news
            SET
                newsHit = newsHit+1
            WHERE
                newsLink = ?
        ");
        $update->execute(array($newsLink));
    }


    /**
     * Haberi günceller
     * @param  integer $newsId haberin id'si
     * @param  array $data   haberin detayları
     * @return boolean
     */
    public function updateNews($newsId,$data)
    {

        extract($data);

        $update  = $this->DB->prepare("
            UPDATE
                news
            SET
                newsTitle = ?,
                newsBody = ?,
                newsCategory = ?,
                showContent = ?,
                newsLink = ?
            WHERE
                newsId = ?

        ");

        $update->execute(array($newsTitle,$newsBody,$newsCategory,$showContent,helper::sefLink($newsTitle),$newsId));

        if($update)
        {
            return true;
        }

        return false;
    }

    /**
     * Haberin resimin günceller..
     * @param  integer $newsId    haberin id'si
     * @param  string $imageName haberin resimi
     * @return boolean
     */
    public function updateNewsImage($newsId,$imageName)
    {
        $update = $this->DB->prepare("
            UPDATE
                news
            SET
                newsImage = ?
            WHERE
                newsId = ?
        ");

        $update->execute(array($imageName,$newsId));

        if($update)
        {


            return true;
        }

        return false;

    }


    /** =================================== | DELETE | =================================== **/

    /**
     * Bir haber siler
     * @param  integer $newsId haberin id'si..
     * @return boolean
     */
    public function deleteNews($newsId)
    {
        $delete = $this->DB->prepare("
            DELETE
            FROM
                news
            WHERE
                newsId = ?
        ");

        $delete->execute(array($newsId));
        if($delete->rowCount() > 0)
        {
            return true;
        }

        return false;
    }













}