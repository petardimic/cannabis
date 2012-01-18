<?php
/*
 * Base class; DO NOT EDIT
 *
 * auto-generated by the sfDoctrine plugin
 */
class CsDivision extends Doctrine_Record
{
  
  
  public function setTableDefinition()
  {
    $this->setTableName('cs_division');

    $this->hasColumn('parent_id', 'integer', 11, array ());
    $this->hasColumn('name', 'string', 150, array ());
    $this->hasColumn('description', 'string', 4000, array ());
    $this->hasColumn('boss_id', 'integer', 11, array ());
  }
  

  
  public function setUp()
  {
    $this->hasOne('CsDivision as CsDivision', array('local' => 'parent_id', 'foreign' => 'id'));
    $this->hasOne('CsAccount as CsAccount', array('local' => 'boss_id', 'foreign' => 'id'));
    $this->hasMany('CsAccount as CsAccounts', array('local' => 'id', 'foreign' => 'division_id'));
    $this->hasMany('CsAccountDivision as CsAccountDivisions', array('local' => 'id', 'foreign' => 'division_id'));
    $this->hasMany('CsAccountPost as CsAccountPosts', array('local' => 'id', 'foreign' => 'division_id'));
    $this->hasMany('CsDivision as CsDivisions', array('local' => 'id', 'foreign' => 'parent_id'));
    $this->hasMany('CsPostRelation as CsPostRelations', array('local' => 'id', 'foreign' => 'division_id'));
    $this->hasMany('CsProjectRole as CsProjectRoles', array('local' => 'id', 'foreign' => 'division_id'));
  }
  
}
