<?php
/*
 * Base class; DO NOT EDIT
 *
 * auto-generated by the sfDoctrine plugin
 */
class CsPublicTopic extends Doctrine_Record
{
  
  
  public function setTableDefinition()
  {
    $this->setTableName('cs_public_topic');

    $this->hasColumn('name', 'string', 150, array ());
    $this->hasColumn('description', 'string', 4000, array ());
    $this->hasColumn('is_active', 'boolean', null, array (  'default' => false,));
  }
  

  
  public function setUp()
  {
    
  }
  
}
