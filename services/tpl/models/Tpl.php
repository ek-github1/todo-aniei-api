<?php 

/**
 * Class UserAddress Extend of Row, simplyfing data access and modification
 * Holds the {@link UserAddress} model
 * @package spiderFrame
 * @author Ismael Cortés <may.estilosfrescos@gmail.com>
 * @copyright Copyright (c) 2010, Ismael Cortés <may.estilosfrescos@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @package spiderFrame
 */
class Tpl extends Row
{
    public function __construct($tpl_id, $table_name = "tpl", DbConnection $DbConnection = null)
    {
       parent::__construct( (int)$tpl_id, $table_name, $DbConnection);
    }

    public static function getNewInstance($tpl_id, $table_name = "tpl", DbConnection $DbConnection = null)
    {
       $Row = new Tpl($tpl_id, $table_name, $DbConnection);
       return $Row;
    }

    public static function getInstance($tpl_id, $table_name = "tpl",  DbConnection $DbConnection = null)
    {
            if( !isset(parent::$_instances[$table_name][$tpl_id]) )
            {
                $Row = new Tpl((int)$tpl_id, $table_name, $DbConnection);
                    parent::$_instances[$table_name][$tpl_id] = $Row;
            }

        return parent::$_instances[$table_name][$tpl_id];
    }

    public function loadProfile()
    {
        $this->load();
        
        if(!empty($this->data))
        {   
            $this->loadModule();
            $this->loadPagerData();
            $this->loadThisData();
            
            // $this->data["tpl_data"]["formatted_date"] = ($this->data["tpl_data"]["date"])? Functions::__getFormatDate($this->data["tpl_data"]["date"], "am/pm", "Y-m-d h:i") : "NOT_AVAILABLE" ;
            $this->data["tpl_data"]["inverse_active"] = ($this->data["tpl_data"]["active"] == 1)? 0 : 1;
            $this->data["tpl_data"]["inverse_locked"] = ($this->data["tpl_data"]["locked"] == 1)? 0 : 1;
            $this->data["tpl_data"]["inverse_deleted"] = ($this->data["tpl_data"]["deleted"] == 1)? 0 : 1; 
        }
        
        return true;
    }

    public function createProfile()
    {
        $this->data["item_id"] = 0 ;
        $this->data["tpl_data"] = $this->DbConnection->getFieldStructure("tpl");
        $this->data["tpl_data"]["inverse_active"] = 0;
        $this->data["tpl_data"]["inverse_locked"] = 0;
        $this->data["tpl_data"]["inverse_deleted"] = 0; 
        
        $this->data["module_data"] = $this->DbConnection->getFieldStructure("tpl_module");
        
        return true;
    }

    public function loadThisData()
    {
        if( !isset($this->data["tpl_data"]) && empty($this->data["tpl_data"]) )
        { 
            $this->assertLoaded();
            $structure = $this->DbConnection->getFieldStructure("tpl");
            
            foreach ($structure AS $key => $value) 
            {
                $this->data["tpl_data"][$key] = $this->data[$key];
                unset($this->data[$key]);
            }
        }

        return true;
    }

    public function loadModule()
    {
        if( !isset($this->data["module_data"]) && empty($this->data["module_data"]) )
        {
            (isset($this->data["tpl_module_id"]))? $tpl_module_id = $this->data["tpl_module_id"] : false;
            (isset($this->data["tpl_data"]["tpl_module_id"]))? $tpl_module_id = $this->data["tpl_data"]["tpl_module_id"] : false;
            $Row = Module::getInstance($tpl_module_id);
            $Row->load();
            $this->data["module_data"] = $Row->data;

            return true;
        }

        return false;
    }

    public function loadPagerData()
    {
        if( !isset($this->data["pager_data"]) && empty($this->data["pager_data"]) )
        {
            $this->assertLoaded();
            $nextCollection = $this->getNextCollection();
            $this->data["pager_data"]["next"] = $this->getNext(array("next"=>true));
            $this->data["pager_data"]["previous"] = $this->getNext(array("previous"=>true));

            $this->data["pager_data"]["next_collection"] = (!empty($nextCollection["next"]))? $nextCollection["next"] : 1; 
            $this->data["pager_data"]["previous_collection"] = (!empty($nextCollection["previous"]))? $nextCollection["previous"] : 1; 
        }

        return true;
    }

    public function getModule()
    {
        $this->assertLoaded();
        
        if( !isset($this->data["module_data"]) && empty($this->data["module_data"]) )
        {
            $Row = Module::getInstance($this->data["tpl_module_id"]);
            $Row->load();
            return $Row->data;
        }

        return $this->data["module_data"];
    }
    public static function getResponse($message, DbConnection $DbConnection = null)
    {
        $DbConnection = ($DbConnection == null) ? DbConnection::getInstance("_root") : $DbConnection ;
        $sql  = "SELECT response FROM tpl WHERE tpl.message LIKE '%".$message."%'";
        parent::$sql = $sql;        
        return $DbConnection->getAll($sql);
    }


    public static function getTotal(array $data = array(), DbConnection $DbConnection = null)
    {
        $DbConnection = ($DbConnection == null) ? DbConnection::getInstance("_root") : $DbConnection ;
        $user_type_sentence = (!empty($data["user_type"]) && ($data["user_type"] != "null"))? " AND tpl_module.user_type = '" . $data["user_type"] . "' " : "";
        $permssion_sentence = (!empty($data["tpl"]) && ($data["tpl"] != "null"))? " AND tpl.tpl = '" . $data["tpl"] . "' " : "";
        $tpl_id_sentence = (!empty($data["tpl_id"]) && ($data["tpl_id"] != "null"))? " AND tpl_id = '" . $data["tpl_id"] . "' " : "";
        $module_sentence = (!empty($data["tpl_module_id"]) && ($data["tpl_module_id"] != "null"))? " AND tpl_module_id = '" . $data["tpl_module_id"] . "' " : "";
        $group_sentence = (!empty($data["group"]) && ($data["group"] != "null"))? " GROUP BY " . $data["group"] : "";
        
        $filters = $user_type_sentence . $module_sentence . $permssion_sentence . $group_sentence;
        $sql_deleted    = "SELECT COUNT(tpl_id) AS total FROM tpl WHERE deleted = '0' " . $filters;
        $sql_locked     = "SELECT COUNT(tpl_id) AS total FROM tpl WHERE deleted = '1' AND locked = '1' " . $filters;
        $sql_unlocked   = "SELECT COUNT(tpl_id) AS total FROM tpl WHERE deleted = '1' AND locked = '0' " . $filters;
        $sql_active     = "SELECT COUNT(tpl_id) AS total FROM tpl WHERE deleted = '1' AND active = '1' " . $filters;
        $sql_inactive   = "SELECT COUNT(tpl_id) AS total FROM tpl WHERE deleted = '1' AND active = '0' " . $filters;
        
        $return_data["inactive"] = $DbConnection->getValue($sql_inactive);
        $return_data["active"]   = $DbConnection->getValue($sql_active);
        $return_data["locked"]   = $DbConnection->getValue($sql_locked);        
        $return_data["deleted"]  = $DbConnection->getValue($sql_deleted);        
        $return_data["unlocked"] = $DbConnection->getValue($sql_unlocked);        
        $return_data["total"]    = $return_data["deleted"] + $return_data["inactive"] + $return_data["active"];
        $return_data["pages"]    = ceil($return_data["total"] / self::$limit_paginate);

        return $return_data;
    }

    public static function getList(array $data = array(), DbConnection $DbConnection = null)
    {
        $data["page"] = !empty($data["page"])? $data["page"] : 1;
        $active_sentence = (!empty($data["active"]) && ($data["active"] != "null"))? " AND tpl.active = '" . $data["active"] . "' " : "";
        $locked_sentence = (!empty($data["locked"]) && ($data["locked"] != "null"))? " AND tpl.locked = '" . $data["locked"] . "' " : "";
        $deleted_sentence = (!empty($data["deleted"]) && ($data["deleted"] != "null"))? " AND tpl.deleted = '" . $data["deleted"] . "' " : "";
        $user_type_sentence = (!empty($data["user_type"]) && ($data["user_type"] != "null"))? " AND tpl_module.user_type = '" . $data["user_type"] . "' " : "";
        $module_sentence = (!empty($data["tpl_module_id"]) && ($data["tpl_module_id"] != "null"))? " AND tpl_module.tpl_module_id = '" . $data["tpl_module_id"] . "' " : "";
        $group_sentence = (!empty($data["group"]) && ($data["group"] != "null"))? " GROUP BY " . $data["group"] : "";
        $permssion_sentence = (!empty($data["tpl"]) && ($data["tpl"] != "null"))? " AND tpl.tpl = '" . $data["tpl"] . "' " : "";
        $tpl_id_sentence = (!empty($data["tpl_id"]) && ($data["tpl_id"] != "null"))? " AND tpl_id = '" . $data["tpl_id"] . "' " : "";
        //$order_sentence = (!empty($data["order_sentence"]) && ($data["order_sentence"] != "") && ($data["order_sentence"] != "null"))? $data["order_sentence"] . "' " : "";
        
        $filters = $active_sentence . $locked_sentence . $deleted_sentence . $user_type_sentence . $module_sentence . $permssion_sentence . $group_sentence;
        $start = ((int) $data["page"] < 1 )? 0 : ( ($data["page"] - 1) * self::$limit_paginate) ;
        $DbConnection = ($DbConnection == null) ? DbConnection::getInstance("_root") : $DbConnection ;
        
        $sql = "SELECT 
                    tpl.tpl_id AS item_id,
                    tpl.tpl_id,
                    tpl.tpl, 
                    tpl.context,
                    tpl.description,
                    tpl.locked,
                    tpl.deleted,
                    tpl.active,

                    tpl_module.tpl_module_id,
                    tpl_module.module, 
                    tpl_module.user_type, 
                    tpl_module.context AS module_context,
                    tpl_module.description AS module_description,
                    tpl_module.locked AS module_locked,
                    tpl_module.deleted AS module_deleted,
                    tpl_module.active  AS module_active       
                FROM 
                    tpl, tpl_module
                WHERE 
                    tpl.tpl_module_id = tpl_module.tpl_module_id
                " . $filters . "
                LIMIT " . $start . ", " . self::$limit_paginate . "" ;

        parent::$sql = $sql;
        return $DbConnection->getAll($sql);
    }

    public function getNext(array $data = array())
    {
        $this->assertLoaded();
        $id = (isset($data["previous"]))? $this->id - 1: $this->id + 1;
        $active_sentence = (!empty($data["active"]))? " AND active = '" . $data["active"] ."' " : "";
        $locked_sentence = (!empty($data["locked"]))? " AND locked = '" . $data["locked"] ."' " : "";
        $deleted_sentence = (!empty($data["deleted"]))? " AND deleted = '" . $data["deleted"] ."' " : "";
        
        $sql = "SELECT tpl_id FROM tpl WHERE tpl_id = '" . $id . "' " . $active_sentence . $locked_sentence . $deleted_sentence;
        $next = $this->DbConnection->getValue($sql);
        
        parent::$sql = $sql;
        return ($next) ? (int)$next : 1;
    }

    public function getNextCollection(array $data = array())
    {
        $this->assertLoaded();
        $active_sentence = (!empty($data["active"]))? " AND active = '" . $data["active"] ."' " : "";
        $locked_sentence = (!empty($data["locked"]))? " AND locked = '" . $data["locked"] ."' " : "";
        $deleted_sentence = (!empty($data["deleted"]))? " AND deleted = '" . $data["deleted"] ."' " : "";
        
        $sql_start = "SELECT tpl_id FROM tpl WHERE tpl_module_id = '" . $this->data["tpl_module_id"] . "' " . $active_sentence . $locked_sentence . $deleted_sentence . " ORDER BY tpl_id ASC";
        $sql_end = "SELECT tpl_id FROM tpl WHERE tpl_module_id = '" . $this->data["tpl_module_id"] . "' " . $active_sentence . $locked_sentence . $deleted_sentence . " ORDER BY tpl_id DESC";
        $start = $this->DbConnection->getValue($sql_start);
        $end = $this->DbConnection->getValue($sql_end);

        $sql_previous_module = "SELECT tpl_id FROM tpl WHERE tpl_id = '" . ($start -1) . "' " . $active_sentence . $locked_sentence . $deleted_sentence ;
        $sql_next_id = "SELECT tpl_id FROM tpl WHERE tpl_id = '" . ($end +1) . "' " . $active_sentence . $locked_sentence . $deleted_sentence ;
        $previous_module = $this->DbConnection->getValue($sql_previous_module);
        $next = $this->DbConnection->getValue($sql_next_id);

        $sql_previous_id = "SELECT tpl_id FROM tpl WHERE tpl_module_id = '" . $previous_module . "' " . $active_sentence . $locked_sentence . $deleted_sentence . " ORDER BY tpl_id ASC";
        $previous = $this->DbConnection->getValue($sql_previous_id);
                
        $return_data = array( "previous" => (int)$previous, "next" => (int)$next );

        return $return_data;
    }

}