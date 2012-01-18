<?php
/*
 * Base class; DO NOT EDIT
 *
 * auto-generated by the sfDoctrine plugin
 */
class CsModule extends Doctrine_Record
{
  
  
  public function setTableDefinition()
  {
    $this->setTableName('cs_module');

    $this->hasColumn('parent_id', 'integer', 11, array ());
    $this->hasColumn('name', 'string', 150, array ());
    $this->hasColumn('description', 'string', 4000, array ());
    $this->hasColumn('caption', 'string', 150, array ());
    $this->hasColumn('is_hidden', 'boolean', null, array ('default' => false));
  }
  

  
  public function setUp()
  {
    $this->hasOne('CsModule as CsModule', array('local' => 'parent_id', 'foreign' => 'id'));
    $this->hasMany('CsModule as CsModules', array('local' => 'id', 'foreign' => 'parent_id'));
    $this->hasMany('CsPermissionList as CsPermissionLists', array('local' => 'id', 'foreign' => 'module_id'));
  }
  
}