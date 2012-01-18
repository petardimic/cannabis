<?php
/*
 * Base class; DO NOT EDIT
 *
 * auto-generated by the sfDoctrine plugin
 */
class CsCalendar extends Doctrine_Record
{
  
  
  public function setTableDefinition()
  {
    $this->setTableName('cs_calendar');

    $this->hasColumn('name', 'string', 150, array ());
    $this->hasColumn('description', 'string', 4000, array ());
    $this->hasColumn('owner_id', 'integer', 11, array ());
    $this->hasColumn('is_public', 'boolean', null, array ());
    $this->hasColumn('is_deleted', 'boolean', null, array (  'default' => false,));
  }
  

  
  public function setUp()
  {
    $this->hasOne('CsAccount as CsAccount', array('local' => 'owner_id', 'foreign' => 'id'));
    $this->hasMany('CsCalendarEvent as CsCalendarEvents', array('local' => 'id', 'foreign' => 'calendar_id'));
    $this->hasMany('CsCalendarPermission as CsCalendarPermissions', array('local' => 'id', 'foreign' => 'calendar_id'));
  }
  
}
