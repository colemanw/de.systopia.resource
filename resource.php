<?php
/*-------------------------------------------------------+
| SYSTOPIA Resource Framework                            |
| Copyright (C) 2021 SYSTOPIA                            |
| Author: B. Endres (endres@systopia.de)                 |
+--------------------------------------------------------+
| This program is released as free software under the    |
| Affero GPL license. You can redistribute it and/or     |
| modify it under the terms of this license which you    |
| can read by viewing the included agpl.txt or online    |
| at www.gnu.org/licenses/agpl.html. Removal of this     |
| copyright header is strictly prohibited without        |
| written permission from the original author(s).        |
+--------------------------------------------------------*/

require_once 'resource.civix.php';

// phpcs:disable
use CRM_Resource_ExtensionUtil as E;

// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function resource_civicrm_config(&$config)
{
    _resource_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function resource_civicrm_xmlMenu(&$files)
{
    _resource_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function resource_civicrm_install()
{
    _resource_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function resource_civicrm_postInstall()
{
    _resource_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function resource_civicrm_uninstall()
{
    _resource_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function resource_civicrm_enable()
{
    _resource_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function resource_civicrm_disable()
{
    _resource_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function resource_civicrm_upgrade($op, CRM_Queue_Queue $queue = null)
{
    return _resource_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function resource_civicrm_managed(&$entities)
{
    _resource_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Add CiviCase types provided by this extension.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function resource_civicrm_caseTypes(&$caseTypes)
{
    _resource_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Add Angular modules provided by this extension.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function resource_civicrm_angularModules(&$angularModules)
{
    // Auto-add module files from ./ang/*.ang.php
    _resource_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function resource_civicrm_alterSettingsFolders(&$metaDataFolders = null)
{
    _resource_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function resource_civicrm_entityTypes(&$entityTypes)
{
    _resource_civix_civicrm_entityTypes($entityTypes);
    $entityTypes['CRM_Resource_DAO_Resource'] = [
        'name'  => 'Resource',
        'class' => 'CRM_Resource_DAO_Resource',
        'table' => 'civicrm_resource',
        //'links_callback' => ['CRM_Resource_BAO_Resource::add_resource_links']
    ];
    $entityTypes['CRM_Resource_DAO_ResourceAssignment'] = [
        'name'  => 'ResourceAssignment',
        'class' => 'CRM_Resource_DAO_ResourceAssignment',
        'table' => 'civicrm_resource_assignment',
    ];
    $entityTypes['CRM_Resource_DAO_ResourceDemand'] = [
        'name'  => 'ResourceDemand',
        'class' => 'CRM_Resource_DAO_ResourceDemand',
        'table' => 'civicrm_resource_demand',
    ];
    $entityTypes['CRM_Resource_DAO_ResourceDemandCondition'] = [
        'name'  => 'ResourceDemandCondition',
        'class' => 'CRM_Resource_DAO_ResourceDemandCondition',
        'table' => 'civicrm_resource_demand_condition',
    ];
    $entityTypes['CRM_Resource_DAO_ResourceUnavailability'] = [
        'name'  => 'ResourceUnavailability',
        'class' => 'CRM_Resource_DAO_ResourceUnavailability',
        'table' => 'civicrm_resource_unavailability',
    ];
}

/**
 * Add contact summary tab for contact resources
 */
function resource_civicrm_tabset($tabsetName, &$tabs, $context)
{
    switch ($tabsetName) {
        case 'civicrm/contact/view':
        case 'civicrm/eck/entity':
            CRM_Resource_UI::addResourceTab($tabs, $tabsetName, $context);
            return;

        case 'civicrm/event/manage':
            CRM_Resource_UI::addEventResourceDemandTab($tabs, $context);
            return;

        default:
            return;
    }
}

function resource_civicrm_searchTasks($objectType, &$tasks)
{
    // add "Mark as resource" task to contact list
    if ($objectType == 'contact') {
        // ...but only, if any contact based resource type is active
        $contact_based_resource_types = CRM_Resource_Types::getForEntityTable('civicrm_contact');
        if (!empty($contact_based_resource_types)) {
            $tasks[] = [
                'title' => E::ts('Mark as Resource'),
                'class' => 'CRM_Resource_Form_Task_CreateContactResource',
                'result' => false
            ];
        }
    }
}

/**
 * Implements hook_civicrm_themes().
 */
function resource_civicrm_themes(&$themes)
{
    _resource_civix_civicrm_themes($themes);
}

/**
 * Implementation of hook_civicrm_copy
 */
function resource_civicrm_copy($objectName, &$object)
{
    if ($objectName == 'Event') {
        // we have the new event ID...
        $new_event_id = $object->id;

        // ...unfortunately, we have to dig up the original event ID:
        $callstack = debug_backtrace();
        foreach ($callstack as $call) {
            if (isset($call['class']) && isset($call['function'])) {
                if ($call['class'] == 'CRM_Event_BAO_Event' && $call['function'] == 'copy') {
                    // this should be it:
                    $original_event_id = $call['args'][0];
                    CRM_Resource_BAO_ResourceDemand::copyAllDemands('civicrm_event', $original_event_id, $new_event_id);
                    break;
                }
            }
        }
    }
}
