<?php


class model
{

    # Database bağlantısını tutar
    public $DB;

    /**
     * construct
     */
    public function __construct()
    {
        $this->DB = registry::get('database');
    }
    

    /**
     * Bir model Yüklemek için kullanılır.
     * @param  string $model Yüklenecek modülün adı
     * @return object
     */
    public static function loadModel($model)
    {

        $modelName = $model.'_model';
        return registry::setObject($modelName, 'models/');

    }
   


}