<?php
if(!defined('OSCAR_RENT_A_CAR')) exit('<pre>Permission error! Please Go away :) </pre>');

class setting_model extends model
{

    public function updateSettings($data)
    {
        extract($data);
        $update = $this->DB->prepare("
            UPDATE
                settings
            SET
                defaultTitle = ?,
                maxAge = ?,
                minAge = ?,
                siteEmail = ?,
                defaultPhone = ?,
                threeDayPriceRange = ?,
                sliderBottom    = ?,
                facebook    = ?,
                twitter    = ?


        ");

        $update->execute(array($siteTitle,$maxAge,$minAge,$siteEmail,$sitePhone,$threeDayPriceRange,$sliderBottom,$facebook,$twitter));

        if($update)
        {
            return true;
        }

        return false;
    }

    /**
     * Site ayarlarını çeker.
     * @return object
     */
    public function getSettings()
    {

        $select = $this->DB->prepare("
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

        return false;

    }
}