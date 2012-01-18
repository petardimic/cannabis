<?php
/*
 * Base class; DO NOT EDIT
 *
 * auto-generated by the sfDoctrine plugin
 */
class CsDirectory extends Doctrine_Record
{
  
  
  public function setTableDefinition()
  {
    $this->setTableName('cs_directory');

    $this->hasColumn('name', 'string', 150, array ());
    $this->hasColumn('description', 'string', 4000, array ());
    $this->hasColumn('tablename', 'string', 150, array ());
    $this->hasColumn('readonly', 'boolean', null, array (  'default' => true,));
    $this->hasColumn('parameters', 'string', 150, array ());
    $this->hasColumn('custom', 'boolean', null, array (  'default' => false,));
  }
  

  
  public function setUp()
  {
    $this->hasMany('CsDirectoryField as CsDirectoryFields', array('local' => 'id', 'foreign' => 'directory_id'));
    $this->hasMany('CsDirectoryRecord as CsDirectoryRecords', array('local' => 'id', 'foreign' => 'directory_id'));
    $this->hasMany('CsProcessProperty as CsProcessPropertys', array('local' => 'id', 'foreign' => 'directory_id'));
  }
  
}
