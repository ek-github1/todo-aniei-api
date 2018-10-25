<?php

/**
 * Holds the {@link Config} Singleton
 * @package Garson
 * @author Argel Arias <levhita@gmail.com>
 * @copyright Copyright (c) 2010, Argel Arias <levhita@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * Provides a Config abstraction in the form of a singleton
 */

class Config 
{
    public $data = array();
    protected $_filename = "";
    protected $_loaded = false;
    protected $_config = array();
    protected $_config_name = "";
    protected $_library_path = "";
    protected static $_instances = array();
      
    /**
     * Constructor is private so it can't be instantiated
     * @return Config
     */
    public function __construct( $config_name, $process = false)
    {
        $this->_config_name = $config_name ;
        $this->_library_path = "config/templates/";
        
        if(file_exists($this->_library_path . $config_name . ".ini"))
        {
            $this->_filename = $this->_library_path . $config_name . ".ini";
        } else if(file_exists( TO_ROOT . "/subcore/config/templates/" . $config_name . ".ini")){
            $this->_library_path = TO_ROOT . "/subcore/config/templates/";
            $this->_filename     = $this->_library_path . $config_name . ".ini";
        } else if(file_exists( TO_ROOT . "/spiderframe/config/templates/" . $config_name . ".ini")){
            $this->_library_path = TO_ROOT . "/spiderframe/config/templates/";
            $this->_filename     = $this->_library_path . $config_name . ".ini";
        } 

        if ( !file_exists( $this->_filename ) ) 
        {
            throw new RuntimeException("Couldn't load configuration file: " . $this->_filename);
        }        
        
         $this->_config = parse_ini_file($this->_filename, $process);
    }
    
    /**
     * Loads the config from an ini file into an array
     *
     * To override the default just call Config::load('filename') with your custom
     * config.
     * @param string $filename
     * @return Config
     */
    public static function getInstance($config_name = "", $process=false)
    {
        $config_name = ( empty( $config_name ) ) ? "system_config" : $config_name;
        $process = ($config_name = "system_config" ) ? true : $process;
        
        if ( !isset($_instances[$config_name]) || !(self::$_instances[$config_name] instanceof self) ) 
        {
            self::$_instances[$config_name] = new self($config_name, $process);
        }
        
        return self::$_instances[$config_name];
    }
    

    public function load()
    {
        if($this->_loaded == false)
        {
             $this->data = $this->_config;
             $this->data["config_name"] = $this->_config_name;
        }
    }

    /**
     * Saves the config from the array file into an inifile
     *
     * To override the default just call Config::save('filename') with your custom
     * config.
     * @param string $filename
     * @return boolean
     */
    public function save($filename = "")
    {
        $this->_filename = (empty($filename)) ? $this->_filename : $filename;
        
        if ( !file_exists($this->_filename) ) 
        {
            throw new RuntimeException("Configuration file doesn't exist: " . $this->_filename);
        }
        
        $configString = "";
        
        foreach ($this->_config AS $field => $value) 
        {
            /**
             * @todo There are some characters that are forbidden as keys
             * and values, they must raise an exception
             * source: http://php.net/manual/en/function.parse-ini-file.php
             */
            $configString .= "$field=\"$value\"\n";
        }
        
        if ( file_put_contents($this->_filename, $configString)==false) 
        {
            throw new RunTimeException("Couldn't save configuration file: ". $this->_filename);
        }
        
        return true;
    }
    
    /**
     * Get a single value from the config
     *
     * In the first call, it loads the config file
     * @param string $field
     * @return string
     * @todo Improve error reporting
     */
    public function __get($field) 
    {
        if ( !isset($this->_config[$field]) ) 
        {
           // Logger::log("Undefined Config used", "$field");
            return "";
        }
        
        return $this->_config[$field];
    }
    
    /**
     * Set a single config value
     * @param $field
     * @param $value
     * @return void
     */
    public function __set($field, $value) 
    {
        $this->_config[$field] = $value;
    }
    
    public function __isset($field) 
    {
        return isset($this->_config[$field]);
    }
    
    public function getFilename()
    {
        return $this->_filename;
    }

    public static function getConfigFiles() 
    {
        $config_files = array();
        $library_path = TO_ROOT . "/subcore/config/templates/";
        $library = opendir($library_path);
        
        if(readdir($library))
        {
            while ($folder = readdir($library))
            {
                if(!is_file($folder))
                {
                    $file_extension = explode ('.', $folder);
                    
                    if( stripos($file_extension[0], "_config") && $file_extension[1] == "ini")
                    {
                        $config_files[$file_extension[0]]["config_name"] = $file_extension[0];
                        $config_files[$file_extension[0]]["file_name"] = $folder;
                        $config_files[$file_extension[0]]["path"] = $library_path;
                    } 
                }
            }
        }
      
      closedir($library); 
      return $config_files;    
    }
}