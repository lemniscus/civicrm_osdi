<?php
use CRM_Osdi_ExtensionUtil as E;

class CRM_Osdi_Page_OSDIResponse extends CRM_Core_Page {

  public function run() {

    $params = array();

    if (!isset($_GET["object"])) {
        print "must set 'object' parameter";

        CRM_Utils_System::civiExit();
        parent::run();
        return;
    }

    $params["object"] = $_GET["object"];

    $optionals = array("apikey", "sitekey", "page", "limit");
    foreach ($optionals as $optional) {
        if (isset($_GET[$optional])) {
            $params[$optional] = $_GET[$optional];
        }
    }
    
    $result = civicrm_api3('Exporter', 'export', $params);

    print json_encode($result["values"]);

    CRM_Utils_System::civiExit();
    parent::run();
  }

}
