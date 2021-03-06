<?php
/*
 * Base class; DO NOT EDIT
 *
 * auto-generated by the sfDoctrine plugin
 */
class CsStatus extends Doctrine_Record
{
  
  
  public function setTableDefinition()
  {
    $this->setTableName('cs_status');

    $this->hasColumn('name', 'string', 150, array ());
    $this->hasColumn('description', 'string', 4000, array ());
  }
  

  
  public function setUp()
  {
  	$this->hasMany('CsAccountToday as CsAccountTodays', array('local' => 'id', 'foreign' => 'status_id'));
    $this->hasMany('CsChrono as CsChronos', array('local' => 'id', 'foreign' => 'status_id'));
    $this->hasMany('CsChronoAction as CsChronoActions', array('local' => 'id', 'foreign' => 'status_id'));
    $this->hasMany('CsProcessCurrentAction as CsProcessCurrentActions', array('local' => 'id', 'foreign' => 'status_id'));
    $this->hasMany('CsProcessCurrentActionPerformer as CsProcessCurrentActionPerformers', array('local' => 'id', 'foreign' => 'status_id'));
    $this->hasMany('CsProcessInstance as CsProcessInstances', array('local' => 'id', 'foreign' => 'status_id'));
    $this->hasMany('CsProjectInstance as CsProjectInstances', array('local' => 'id', 'foreign' => 'status_id'));
  }
  
}
