<?php
/*
 * Base class; DO NOT EDIT
 *
 * auto-generated by the sfDoctrine plugin
 */
class CsChronoAction extends Doctrine_Record
{
  
  
  public function setTableDefinition()
  {
    $this->setTableName('cs_chrono_action');

    $this->hasColumn('chrono_id', 'integer', 20, array ());
    $this->hasColumn('process_instance_id', 'integer', 20, array ());
    $this->hasColumn('action_instance_id', 'integer', 20, array ());
    $this->hasColumn('action_id', 'integer', 11, array ());
    $this->hasColumn('status_id', 'integer', 11, array ());
    $this->hasColumn('initiator_id', 'integer', 11, array ());
    $this->hasColumn('performer_id', 'integer', 11, array ());
    $this->hasColumn('planed', 'string', 4000, array ());
    $this->hasColumn('fixed_planed', 'boolean', null, array ());
    $this->hasColumn('started_at', 'timestamp', null, array ());
    $this->hasColumn('ended_at', 'timestamp', null, array ());
  }
  

  
  public function setUp()
  {
    $this->hasOne('CsProcessInstance as CsProcessInstance', array('local' => 'process_instance_id', 'foreign' => 'id'));
    $this->hasOne('CsProcessCurrentAction as CsProcessCurrentAction', array('local' => 'action_instance_id', 'foreign' => 'id'));
    $this->hasOne('CsProcessAction as CsProcessAction', array('local' => 'action_id', 'foreign' => 'id'));
    $this->hasOne('CsStatus as CsStatus', array('local' => 'status_id', 'foreign' => 'id'));
    $this->hasOne('CsAccount as CsInitiatorAccount', array('local' => 'initiator_id', 'foreign' => 'id'));
    $this->hasOne('CsAccount as CsPerformerAccount', array('local' => 'performer_id', 'foreign' => 'id'));
  }
  
}
