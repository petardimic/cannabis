<?php
/*
 * Base class; DO NOT EDIT
 *
 * auto-generated by the sfDoctrine plugin
 */
class CsAccount extends Doctrine_Record
{
  
  
  public function setTableDefinition()
  {
    $this->setTableName('cs_account');

    $this->hasColumn('parent_id', 'integer', 11, array ());
    $this->hasColumn('name', 'string', 150, array ());
    $this->hasColumn('description', 'string', 4000, array ());
    $this->hasColumn('permission_id', 'integer', 11, array ());
    $this->hasColumn('passwd', 'string', 150, array ());
    $this->hasColumn('email', 'string', 150, array ());
    $this->hasColumn('icq', 'string', 150, array ());
    $this->hasColumn('jabber', 'string', 150, array ());
    $this->hasColumn('is_active', 'boolean', null, array (  'default' => true,));
    $this->hasColumn('cell', 'string', 150, array ());
    $this->hasColumn('cellop_id', 'integer', 11, array ());
    $this->hasColumn('division_id', 'integer', 11, array ());
  }
  

  
  public function setUp()
  {
    $this->hasOne('CsAccount as CsAccount', array('local' => 'parent_id', 'foreign' => 'id'));
    $this->hasOne('CsPermission as CsPermission', array('local' => 'permission_id', 'foreign' => 'id'));
    $this->hasOne('CsCellop as CsCellop', array('local' => 'cellop_id', 'foreign' => 'id'));
    $this->hasOne('CsDivision as CsDivision', array('local' => 'division_id', 'foreign' => 'id'));
    $this->hasMany('CsAccount as CsAccounts', array('local' => 'id', 'foreign' => 'parent_id'));
    $this->hasMany('CsAccountDivision as CsAccountDivisions', array('local' => 'id', 'foreign' => 'account_id'));
    $this->hasMany('CsAccountPost as CsAccountPosts', array('local' => 'id', 'foreign' => 'account_id'));
    $this->hasMany('CsAccountToday as CsAccountTodays', array('local' => 'id', 'foreign' => 'account_id'));
    $this->hasMany('CsCalendar as CsCalendars', array('local' => 'id', 'foreign' => 'owner_id'));
    $this->hasMany('CsCalendarEvent as CsCalendarEvents', array('local' => 'id', 'foreign' => 'author_id'));
    $this->hasMany('CsCalendarEventReciever as CsCalendarEventRecievers', array('local' => 'id', 'foreign' => 'account_id'));
    $this->hasMany('CsCalendarPermission as CsCalendarPermissions', array('local' => 'id', 'foreign' => 'account_id'));
    $this->hasMany('CsChrono as CsChronos', array('local' => 'id', 'foreign' => 'account_id'));
    $this->hasMany('CsChronoAction as CsChronoInitiatorActions', array('local' => 'id', 'foreign' => 'initiator_id'));
    $this->hasMany('CsChronoAction as CsChronoPerformerActions', array('local' => 'id', 'foreign' => 'performer_id'));
    $this->hasMany('CsContact as CsContacts', array('local' => 'id', 'foreign' => 'owner_id'));
    $this->hasMany('CsContactList as CsContactLists', array('local' => 'id', 'foreign' => 'account_id'));
    $this->hasMany('CsContactPermission as CsContactPermissions', array('local' => 'id', 'foreign' => 'account_id'));
    $this->hasMany('CsCustomSetting as CsCustomSettings', array('local' => 'id', 'foreign' => 'account_id'));
    $this->hasMany('CsDelegate as CsAccountDelegates', array('local' => 'id', 'foreign' => 'account_id'));
    $this->hasMany('CsDelegate as CsDelegateDelegates', array('local' => 'id', 'foreign' => 'delegate_id'));
    $this->hasMany('CsDivision as CsDivisions', array('local' => 'id', 'foreign' => 'boss_id'));
    $this->hasMany('CsFile as CsOwnerFiles', array('local' => 'id', 'foreign' => 'owner_id'));
    $this->hasMany('CsFile as CsUpdaterFiles', array('local' => 'id', 'foreign' => 'updated_by'));
    $this->hasMany('CsFilePermission as CsFilePermissions', array('local' => 'id', 'foreign' => 'account_id'));
    $this->hasMany('CsMessage as CsMessages', array('local' => 'id', 'foreign' => 'author_id'));
    $this->hasMany('CsMessageReciever as CsMessageRecievers', array('local' => 'id', 'foreign' => 'reciever_id'));
    $this->hasMany('CsProcess as CsProcesss', array('local' => 'id', 'foreign' => 'author_id'));
    $this->hasMany('CsProcessCurrentAction as CsProcessInitiatorCurrentActions', array('local' => 'id', 'foreign' => 'initiator_id'));
    $this->hasMany('CsProcessCurrentAction as CsProcessPerformerCurrentActions', array('local' => 'id', 'foreign' => 'performer_id'));
    $this->hasMany('CsProcessCurrentActionPerformer as CsProcessInitiatorCurrentActionPerformers', array('local' => 'id', 'foreign' => 'initiator_id'));
    $this->hasMany('CsProcessCurrentActionPerformer as CsProcessPerformerCurrentActionPerformers', array('local' => 'id', 'foreign' => 'performer_id'));
    $this->hasMany('CsProcessInstance as CsProcessInstances', array('local' => 'id', 'foreign' => 'initiator_id'));
    $this->hasMany('CsProcessRole as CsProcessRoles', array('local' => 'id', 'foreign' => 'account_id'));
    $this->hasMany('CsProject as CsProjects', array('local' => 'id', 'foreign' => 'author_id'));
    $this->hasMany('CsProjectInstance as CsProjectInstances', array('local' => 'id', 'foreign' => 'initiator_id'));
    $this->hasMany('CsPublicDocument as CsPublicCreatorDocuments', array('local' => 'id', 'foreign' => 'created_by'));
    $this->hasMany('CsPublicDocument as CsPublicUpdaterDocuments', array('local' => 'id', 'foreign' => 'updated_by'));
    $this->hasMany('CsResponser as CsResponsers', array('local' => 'id', 'foreign' => 'account_id'));
  }
  
}
