<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');


class settings
{
    /**
     * database
     * @var object
     */
    private static $DB;


    public function __construct()
    {
       self::$DB =  registry::get('model')->DB;
    }

    /**
     * Sitenin genel ayarlarını çeker.
     * @return object
     */
    public static function get()
    {
        $select = self::$DB->prepare("
            SELECT
                *
            FROM
                settings
        ");

        $select->execute();
        if($select->rowCount() > 0)
        {
            return $select->fetch(PDO::FETCH_OBJ);
        }
        exit('FATTAL ERROR!');
    }

    /** =================================== | MENU | =================================== **/
    /**
     * Menüleri listeler
     * @param  integer $pageId sayfa id'si
     * @return object
     */
    public static function getAllPage($ID = false)
    {


        $select = self::$DB->prepare("
            SELECT
                pageTitle,
                pageParent,
                pageId,
                pageLink
            FROM
                pages
            WHERE
                pageParent = ?
            ORDER BY pageOrder ASC
        ");

        $select->execute(array($ID));
        if($select->rowCount() > 0)
        {
            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        return false;

    }

    public static function listAllMenu($pageId = 0, $isParent = false, $sideBar = false)
    {

        $currentMenu = array();
        $display = '';
        $showInSideBar = $sideBar ? $sideBar : null;

                $parentPage = self::getAllPage($pageId);
                if($parentPage)
                foreach($parentPage as $page):

                    $pageLink = $page->pageLink == '#' ? '#' : BASEPATH.'page/read/'.$page->pageLink;

                    $display .=  '<li '. html::setCurrentMenu('','',$page->pageLink, $sideBar).'><a href="'.$pageLink.'">'.$page->pageTitle.'</a>';


                                $subPage =  self::listAllMenu($page->pageId, true);
                                if($subPage)
                                {
                                     if($isParent == FALSE AND $sideBar == FALSE)
                                     {
                                        $display .= '<ul>';
                                     }

                                    $display .= $subPage;

                                        // $display .= '<li'. html::setCurrentMenu('','terms_and_conditions').'>'.html::link('Term & Conditions', array('href'=>'page/terms_and_conditions')).'</li>';
                                    if($isParent == FALSE AND $sideBar == FALSE)
                                    {
                                        $display .= '</ul>';
                                    }
                                }


                    $display .= '</li>';

                endforeach;



        return $display;
    }

    public static function getMenu($sideBar = false,$class = false)
    {
        $class = $class ? 'class="'.$class.'"' : null;
        echo '<ul '.$class.'>';
            echo '<li '.html::setCurrentMenu('index').'>'.html::link('Home', array('href'=>'')).'</li>';
            echo '<li '.html::setCurrentMenu('Cars').'>'.html::link('Cars', array('href'=>'Cars')).'</li>';
            echo self::listAllMenu('','',$sideBar);
        echo '</ul>';
    }


    /** =================================== | NEWS | =================================== **/


    /**
     * Tüm haberleri listeler
     * @return object
     */
    public static function allNews($limit = false)
    {
        $limit = $limit ? "LIMIT $limit" : '';

        $select = self::$DB->prepare("
            SELECT
                *
            FROM
                news
                LEFT JOIN category ON (category.categoryId = news.newsCategory )
            WHERE
               news.newsBody IS NOT NULL
            AND
               news.newsBody !=''
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


    /** =================================== | PAGES | =================================== **/
    public static function getChildPage($parentId)
    {
        $select = self::$DB->prepare("
            SELECT
                *
            FROM
                pages
            WHERE
                pageParent = ?


        ");

        $select->execute(array($parentId));
        if($select->rowCount() > 0)
        {
            return $select->fetchAll(PDO::FETCH_OBJ);
        }

        return false;
    }


}