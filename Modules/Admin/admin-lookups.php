{
    "communicationTemplate-admin": {
  "client_entry_new_sms": "Client Entry SMS",
  "client_entry_new_whatsapp": "Client Entry Whatsapp",
  "client_entry_new_email": "Client Entry Email",
  "client_entry_update_sms": "Client Entry Update SMS",
  "client_entry_update_whatsapp": "Client Entry Update Whatsapp",
  "client_entry_update_email": "Client Entry Update Email",
  "client_scheduleddeletion_new_sms": "Client Entry Scheduled Deletion SMS",
  "client_scheduleddeletion_new_whatsapp": "Client Entry Scheduled Deletion Whatsapp",
  "client_scheduleddeletion_new_email": "Client Entry Scheduled Deletion Email"
},
"menuItem-admin": {},
"pgStructure-admin": {},
"columnNameMapping-client": {
  "ptr": "SNo",
  "date": "Date",
  "client_id": "ID",
  "client_official_name": "Name",
  "client_official_address": "Address",
  "client_official_email": "Email",
  "client_official_phone": "Phone",
  "sale_by": "Sold By"
},
"mandatoryFields-client_entry_update": [
  "subscription_plan_id",
  "client_official_name",
  "client_official_address",
  "client_official_email",
  "client_official_phone"
],
"mandatoryFields-client_renewal-entry_update": ["renewal_key"],
"listFilters-client_list": {
  "admin": {
    "client_module_filter": "Module/parent_subscription_id/subscription_plan-json",
    "client_filter": "Client/client_id/client-json",
    "client_status_filter": "Status/status/client_status-json",
    "client_renewal_status_filter": "Renewal Status/renewal_status/client_renewal_status-json"
  },
  "portal": {
    "client_module_filter": "Module/parent_subscription_id/subscription_plan-json",
    "client_filter": "Client/client_id/client-json",
    "client_status_filter": "Status/status/client_status-json",
    "client_renewal_status_filter": "Renewal Status/renewal_status/client_renewal_status-json"
  }
},
"listFilters-client_detail_update": {},

}