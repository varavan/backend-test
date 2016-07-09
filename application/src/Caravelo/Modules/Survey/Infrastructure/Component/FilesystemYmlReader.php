<?php
namespace Caravelo\Modules\Survey\Infrastructure\Component;

use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class FilesystemYmlReader
{
    private $content;

    public function __construct($assetPath)
    {
        $this->content = Yaml::parse(file_get_contents($assetPath));
    }

    /**
     * @return array
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param $key
     * @return array | false
     */
    public function findByKey($key){

        return (array_key_exists($key, $this->content))
            ? $this->content[$key]
            : false;
    }


    /**
     * @param $attribute
     * @param $value
     * @return array|false
     */
    public function findByAttribute($attribute, $value){
        return array_filter($this->content, function($row) use ($attribute, $value){
            return (array_key_exists($attribute, $row) && $row[$attribute] == $value);
        });
    }
}