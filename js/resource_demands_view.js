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
    let tab_content_id = $("#tab_resourcedemands").attr('aria-controls');
    if (tab_content_id) {
      $(document).one('crmPopupFormSuccess.resource-demand-view', function () {
        $("#" + tab_content_id).crmSnippet('refresh');
      });
    }
    else {
      $(document).one('crmPopupFormSuccess.resource-demand-view', function () {
        // reload the page
        window.location.reload(false);
      });
    }

    $('.resource-demand-view-demands .action--resource--demand-delete')
      .on('click', function(event, target) {
        delete_resource_demand($(this).data('demand-id'));
      });
  });

  /**
   * Delete the given resource demand and refresh
   *
   * @param demand_id
   */
  function delete_resource_demand(demand_id) {
    CRM.confirm({
      title: ts("Confirm Deletion"),
      message: ts("Do you really want to delete this resource demand, including all conditions?"),
    }).one('crmConfirm:yes', function () {
      CRM.api3('ResourceDemand', 'delete', {id: demand_id})
        .then(function () {
          // try refresh: tab
          let tab_content_id = $("#tab_resourcedemands").attr('aria-controls');
          if (tab_content_id) {
            $("#" + tab_content_id).crmSnippet('refresh');
            CRM.alert(ts("Resource Demand deleted"), ts("Deleted"), "info");
          }
          else {
            // reload the page
            window.location.reload(false);
          }
        });
    });
  }

})(CRM.$, CRM._, CRM.ts('de.systopia.resource'));
