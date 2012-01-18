<?php
/*
 * Base class; DO NOT EDIT
 *
 * auto-generated by the sfDoctrine plugin
 */
class CsContactPermission extends Doctrine_Record
{
  
  
  public function setTableDefinition()
  {
    $this->setTableName('cs_contact_permission');

    $this->hasColumn('contact_id', 'integer', 11, array ());
    $this->hasColumn('account_id', 'integer', 11, array ());
    $this->hasColumn('permission_id', 'integer', 11, array ());
  }
  

  
  public function setUp()
  {
    $this->hasOne('CsContact as CsContact', array('local' => 'contact_id', 'foreign' => 'id'));
    $this->hasOne('CsAccount as CsAccount', array('local' => 'account_id', 'foreign' => 'id'));
    $this->hasOne('CsObjectPermission as CsObjectPermission', array('local' => 'permission_id', 'foreign' => 'id'));
  }
  
}
