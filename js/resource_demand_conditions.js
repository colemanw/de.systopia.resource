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

(function ($, _, ts) {
  $(document).ready(function () {
    // refresh on pop close
    $(document).one('crmPopupFormSuccess', function () {
      $("div.resource-demand-view-info")
        .closest("div.crm-ajax-container")
        .crmSnippet('refresh');
    });

    $('.resource-demand-view-conditions .action--resource--demand_condition-delete')
      .on('click', function (event, target) {
        delete_resource_demand_condition($(this).data('condition-id'));
        return false;
      });
  });

  /**
   * Delete the given resource demand and refresh
   *
   * @param demand_id
   */
  function delete_resource_demand_condition(demand_id) {
    CRM.confirm({
      title: ts("Confirm Deletion"),
      message: ts("Do you really want to delete this condition?")
    }).on('crmConfirm:yes', function () {
      CRM.api3('ResourceDemandCondition', 'delete', {id: demand_id})
        .then(function () {
          // refresh popups
          $("div.resource-demand-view-conditions")
            .closest("div.crm-ajax-container")
            .crmSnippet('refresh');

          // refresh tab (if exists)
          let tab_content_id = $("#tab_resourcedemands").attr('aria-controls');
          if (tab_content_id) {
            $("#" + tab_content_id).crmSnippet('refresh');
            CRM.alert(ts("Condition deleted"), ts("Deleted"), "info");
          }
          else {
            // reload the page
            window.location.reload(false);
          }
        });
    });
  }

})(CRM.$, CRM._, CRM.ts('de.systopia.resource'));
