<?php
/*
 * Base class; DO NOT EDIT
 *
 * auto-generated by the sfDoctrine plugin
 */
class CsResponser extends Doctrine_Record
{
  
  
  public function setTableDefinition()
  {
    $this->setTableName('cs_responser');

    $this->hasColumn('name', 'string', 150, array ());
    $this->hasColumn('description', 'string', 4000, array ());
    $this->hasColumn('account_id', 'integer', 11, array ());
    $this->hasColumn('is_active', 'boolean', null, array (  'default' => true,));
  }
  

  
  public function setUp()
  {
    $this->hasOne('CsAccount as CsAccount', array('local' => 'account_id', 'foreign' => 'id'));
  }
  
}
