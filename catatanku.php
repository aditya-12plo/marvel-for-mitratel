





level
'ADMINISTRATOR','REGIONAL','HQ'


posisi
'AM SUPPORT','ACCOUNT MANAGER','MANAGER MARKETING','MANAGER'













/*   VIEW    */

CREATE VIEW vusersregional 
AS
SELECT * FROM users where level = 'REGIONAL'






CREATE VIEW vjobcommunication 
AS
SELECT project_status.id,project_status.project_id,project_status.users_id,project_status.status,project_status.message,users_exist.name,users_exist.email,users_exist.level,users_exist.posisi,users_exist.area,users_exist.regional,project_status.created_at FROM project_status join users_exist on project_status.users_id=users_exist.id



CREATE OR REPLACE VIEW vnotifications 
AS 
SELECT project.id,project.projectid ,notification.id as notificationid , project.area, project.regional, notification.status , notification.created_at 
FROM notification
join project
on notification.project_id=project.id
WHERE notification.id IN (
    SELECT MAX(id)
    FROM notification
    GROUP BY project_id
) 




CREATE OR REPLACE VIEW vprojectstatus 
AS 
SELECT project.id,status.detail
FROM project
join status
on project.status_id=status.id 




CREATE VIEW vhistorydropsite 
AS
SELECT drop_site_history.id,drop_site_history.projectid,drop_site_history.no_wo,drop_site_history.wo_date,
CONCAT("Batch #",drop_site_history.batch, " ", drop_site_history.years) AS batchnya,
drop_site_history.batch,drop_site_history.years,drop_site_history.infratype,drop_site_history.area,drop_site_history.regional,drop_site_history.site_id_spk,drop_site_history.site_name_spk,drop_site_history.address_spk,drop_site_history.longitude_spk,drop_site_history.latitude_spk,drop_site_history.status_id,drop_site_history.project_status_id,status.detail as statusnya,drop_site_history.created_at FROM drop_site_history join status on drop_site_history.status_id=status.id 




CREATE VIEW vhistorymappingsite 
AS
SELECT mapping_site_history.id,mapping_site_history.projectid,mapping_site_history.no_wo,mapping_site_history.wo_date,
CONCAT("Batch #",mapping_site_history.batch, " ", mapping_site_history.years) AS batchnya,
mapping_site_history.batch,mapping_site_history.years,mapping_site_history.infratype,mapping_site_history.area,mapping_site_history.regional,mapping_site_history.site_id_spk,mapping_site_history.site_name_spk,mapping_site_history.address_spk,mapping_site_history.longitude_spk,mapping_site_history.latitude_spk,mapping_site_history.status_id,mapping_site_history.project_status_id,status.detail as statusnya,mapping_site_history.created_at FROM mapping_site_history join status on mapping_site_history.status_id=status.id 





CREATE VIEW vjobsdocumentsis 
AS
SELECT project.id,project.projectid,project.no_wo,project.wo_date,
CONCAT("Batch #",project.batch, " ", project.years) AS batchnya,
project.batch,project.years,project.infratype,project.area,project.regional,project.site_id_spk,project.site_name_spk,project.address_spk,project.longitude_spk,project.latitude_spk,project.status_id,project.project_status_id,status.detail as statusnya,project.created_at FROM project join status on project.status_id=status.id where project.status_id = '1'


CREATE VIEW vjobsdocumentsisrevisi 
AS
SELECT project.id,project.projectid,project.no_wo,project.wo_date,CONCAT("Batch #",project.batch, " ", project.years) AS batchnya,project.batch,project.years,project.infratype,project.area,project.regional,project.site_id_spk,project.site_name_spk,project.address_spk,project.longitude_spk,project.latitude_spk,project.status_id,project.project_status_id,status.detail as statusnya,document_sis.id as documentsisid,document_sis.document_sis,project.updated_at as created_at FROM project join status on project.status_id=status.id join document_sis on project.id=document_sis.project_id where project.status_id = '3'



CREATE VIEW vjobsapprovaldocumentsis 
AS
SELECT project.id,project.projectid,project.no_wo,project.wo_date,CONCAT("Batch #",project.batch, " ", project.years) AS batchnya,project.batch,project.years,project.infratype,project.area,project.regional,project.site_id_spk,project.site_name_spk,project.address_spk,project.longitude_spk,project.latitude_spk,project.status_id,project.project_status_id,status.detail as statusnya,document_sis.id as documentid,document_sis.document_sis,document_sis.created_at FROM project join status on project.status_id=status.id join document_sis on project.id=document_sis.project_id where project.status_id = '2'


CREATE VIEW vjobsdocumentdrm 
AS
SELECT 
project.id,
project.projectid,
project.no_wo,
project.wo_date,
CONCAT("Batch #",project.batch, " ", project.years) AS batchnya,
project.batch,
project.years,
project.infratype,
project.area,
project.regional,
project.site_id_spk,
project.site_name_spk,
project.address_spk,
project.longitude_spk,
project.latitude_spk,
project.status_id,
project.project_status_id,status.detail as statusnya,
document_sis.id as documentid,
document_sis.document_sis,
document_drm.id as documentdrmid,
document_drm.site_id_actual ,
document_drm.site_name_actual ,
document_drm.province ,
document_drm.city ,
document_drm.address_actual ,
document_drm.longitude_actual ,
document_drm.latitude_actual ,
document_drm.kom_date ,
document_drm.drm_date ,
document_drm.document_kom ,
document_drm.document_drm ,
document_drm.created_at as drm_create ,
document_drm.updated_at as drm_update ,
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
left join document_sis on 
project.id=document_sis.project_id 
left join document_drm on 
project.id=document_drm.project_id 
where project.status_id = '4'


 CREATE VIEW vjobsapprovaldocumentdrm 
AS
SELECT 
project.id,
project.projectid,
project.no_wo,
project.wo_date,
CONCAT("Batch #",project.batch, " ", project.years) AS batchnya,
project.batch,
project.years,
project.infratype,
project.area,
project.regional,
project.site_id_spk,
project.site_name_spk,
project.address_spk,
project.longitude_spk,
project.latitude_spk,
project.status_id,
project.project_status_id,status.detail as statusnya,
document_sis.id as documentid,
document_sis.document_sis,
document_drm.id as documentdrmid,
document_drm.site_id_actual ,
document_drm.site_name_actual ,
document_drm.province ,
document_drm.city ,
document_drm.address_actual ,
document_drm.longitude_actual ,
document_drm.latitude_actual ,
document_drm.kom_date ,
document_drm.drm_date ,
document_drm.document_kom ,
document_drm.document_drm ,
document_drm.created_at as drm_create ,
document_drm.updated_at as drm_update ,
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
left join document_sis on 
project.id=document_sis.project_id 
left join document_drm on 
project.id=document_drm.project_id 
where project.status_id = '5'


 CREATE VIEW vjobsdocumentdrmrevisi 
AS
SELECT 
project.id,
project.projectid,
project.no_wo,
project.wo_date,
CONCAT("Batch #",project.batch, " ", project.years) AS batchnya,
project.batch,
project.years,
project.infratype,
project.area,
project.regional,
project.site_id_spk,
project.site_name_spk,
project.address_spk,
project.longitude_spk,
project.latitude_spk,
project.status_id,
project.project_status_id,status.detail as statusnya,
document_sis.id as documentid,
document_sis.document_sis,
document_drm.id as documentdrmid,
document_drm.site_id_actual ,
document_drm.site_name_actual ,
document_drm.province ,
document_drm.city ,
document_drm.address_actual ,
document_drm.longitude_actual ,
document_drm.latitude_actual ,
document_drm.kom_date ,
document_drm.drm_date ,
document_drm.document_kom ,
document_drm.document_drm ,
document_drm.created_at as drm_create ,
document_drm.updated_at as drm_update ,
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
left join document_sis on 
project.id=document_sis.project_id 
left join document_drm on 
project.id=document_drm.project_id 
where project.status_id = '6'


 


CREATE VIEW vjobsdocumentsitac 
AS
SELECT 
project.id,
project.projectid,
project.no_wo,
project.wo_date,
CONCAT("Batch #",project.batch, " ", project.years) AS batchnya,
project.batch,
project.years,
project.infratype,
project.area,
project.regional,
project.site_id_spk,
project.site_name_spk,
project.address_spk,
project.longitude_spk,
project.latitude_spk,
project.status_id,
project.project_status_id,status.detail as statusnya,
document_sis.id as documentid,
document_sis.document_sis,
document_drm.id as documentdrmid,
document_drm.site_id_actual ,
document_drm.site_name_actual ,
document_drm.province ,
document_drm.city ,
document_drm.address_actual ,
document_drm.longitude_actual ,
document_drm.latitude_actual ,
document_drm.kom_date ,
document_drm.drm_date ,
document_drm.document_kom ,
document_drm.document_drm ,
document_sitac.id as documentsitacid,
document_sitac.no_ban_bak ,
document_sitac.date_ban_bak ,
document_sitac.document_ban_bak ,
document_sitac.ijin_warga_date ,
document_sitac.document_ijin_warga ,
document_sitac.no_pks ,
document_sitac.pks_date ,
document_sitac.no_imb ,
document_sitac.imb_date ,
document_sitac.document_imb ,
document_sitac.document_pks ,
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
left join document_sis on 
project.id=document_sis.project_id 
left join document_drm on 
project.id=document_drm.project_id 
left join document_sitac on 
project.id=document_sitac.project_id 
where project.status_id = '7'







CREATE VIEW vjobsapprovaldocumentsitac 
AS
SELECT 
project.id,
project.projectid,
project.no_wo,
project.wo_date,
CONCAT("Batch #",project.batch, " ", project.years) AS batchnya,
project.batch,
project.years,
project.infratype,
project.area,
project.regional,
project.site_id_spk,
project.site_name_spk,
project.address_spk,
project.longitude_spk,
project.latitude_spk,
project.status_id,
project.project_status_id,status.detail as statusnya,
document_sis.id as documentid,
document_sis.document_sis,
document_drm.id as documentdrmid,
document_drm.site_id_actual ,
document_drm.site_name_actual ,
document_drm.province ,
document_drm.city ,
document_drm.address_actual ,
document_drm.longitude_actual ,
document_drm.latitude_actual ,
document_drm.kom_date ,
document_drm.drm_date ,
document_drm.document_kom ,
document_drm.document_drm ,
document_sitac.id as documentsitacid,
document_sitac.no_ban_bak ,
document_sitac.date_ban_bak ,
document_sitac.document_ban_bak ,
document_sitac.ijin_warga_date ,
document_sitac.document_ijin_warga ,
document_sitac.no_pks ,
document_sitac.pks_date ,
document_sitac.no_imb ,
document_sitac.imb_date ,
document_sitac.document_imb ,
document_sitac.document_pks ,
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
left join document_sis on 
project.id=document_sis.project_id 
left join document_drm on 
project.id=document_drm.project_id 
left join document_sitac on 
project.id=document_sitac.project_id 
where project.status_id = '8'


CREATE VIEW vjobsdocumentsitacrevisi 
AS
SELECT 
project.id,
project.projectid,
project.no_wo,
project.wo_date,
CONCAT("Batch #",project.batch, " ", project.years) AS batchnya,
project.batch,
project.years,
project.infratype,
project.area,
project.regional,
project.site_id_spk,
project.site_name_spk,
project.address_spk,
project.longitude_spk,
project.latitude_spk,
project.status_id,
project.project_status_id,status.detail as statusnya,
document_sis.id as documentid,
document_sis.document_sis,
document_drm.id as documentdrmid,
document_drm.site_id_actual ,
document_drm.site_name_actual ,
document_drm.province ,
document_drm.city ,
document_drm.address_actual ,
document_drm.longitude_actual ,
document_drm.latitude_actual ,
document_drm.kom_date ,
document_drm.drm_date ,
document_drm.document_kom ,
document_drm.document_drm ,
document_sitac.id as documentsitacid,
document_sitac.no_ban_bak ,
document_sitac.date_ban_bak ,
document_sitac.document_ban_bak ,
document_sitac.ijin_warga_date ,
document_sitac.document_ijin_warga ,
document_sitac.no_pks ,
document_sitac.pks_date ,
document_sitac.no_imb ,
document_sitac.imb_date ,
document_sitac.document_imb ,
document_sitac.document_pks ,
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
left join document_sis on 
project.id=document_sis.project_id 
left join document_drm on 
project.id=document_drm.project_id 
left join document_sitac on 
project.id=document_sitac.project_id 
where project.status_id = '9'



CREATE OR REPLACE VIEW vjobsdocumentrfc 
AS 
SELECT 
project.id,
project.projectid,
project.no_wo,
project.wo_date,
CONCAT("Batch #",project.batch, " ", project.years) AS batchnya,
project.batch,
project.years,
project.infratype,
project.area,
project.regional,
project.site_id_spk,
project.site_name_spk,
project.address_spk,
project.longitude_spk,
project.latitude_spk,
project.status_id,
project.project_status_id,status.detail as statusnya,
document_sis.id as documentid,
document_sis.document_sis,
document_drm.id as documentdrmid,
document_drm.site_id_actual ,
document_drm.site_name_actual ,
document_drm.province ,
document_drm.city ,
document_drm.address_actual ,
document_drm.longitude_actual ,
document_drm.latitude_actual ,
document_drm.kom_date ,
document_drm.drm_date ,
document_drm.document_kom ,
document_drm.document_drm ,
document_sitac.id as documentsitacid,
document_sitac.no_ban_bak ,
document_sitac.date_ban_bak ,
document_sitac.document_ban_bak ,
document_sitac.ijin_warga_date ,
document_sitac.document_ijin_warga ,
document_sitac.no_pks ,
document_sitac.pks_date ,
document_sitac.no_imb ,
document_sitac.imb_date ,
document_sitac.document_imb ,
document_sitac.document_pks ,
document_rfc.id as documentrfcid,
document_rfc.no_rfc,
document_rfc.rfc_date,
document_rfc.document_rfc,
document_rfc.id_pln,
document_rfc.target_rfi,
document_rfc.power_capacity,
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
left join document_sis on 
project.id=document_sis.project_id 
left join document_drm on 
project.id=document_drm.project_id 
left join document_sitac on 
project.id=document_sitac.project_id 
left join document_rfc on 
project.id=document_rfc.project_id 
where project.status_id = '10'



CREATE OR REPLACE VIEW vjobsapprovaldocumentrfc 
AS 
SELECT 
project.id,
project.projectid,
project.no_wo,
project.wo_date,
CONCAT("Batch #",project.batch, " ", project.years) AS batchnya,
project.batch,
project.years,
project.infratype,
project.area,
project.regional,
project.site_id_spk,
project.site_name_spk,
project.address_spk,
project.longitude_spk,
project.latitude_spk,
project.status_id,
project.project_status_id,status.detail as statusnya,
document_sis.id as documentid,
document_sis.document_sis,
document_drm.id as documentdrmid,
document_drm.site_id_actual ,
document_drm.site_name_actual ,
document_drm.province ,
document_drm.city ,
document_drm.address_actual ,
document_drm.longitude_actual ,
document_drm.latitude_actual ,
document_drm.kom_date ,
document_drm.drm_date ,
document_drm.document_kom ,
document_drm.document_drm ,
document_sitac.id as documentsitacid,
document_sitac.no_ban_bak ,
document_sitac.date_ban_bak ,
document_sitac.document_ban_bak ,
document_sitac.ijin_warga_date ,
document_sitac.document_ijin_warga ,
document_sitac.no_pks ,
document_sitac.pks_date ,
document_sitac.no_imb ,
document_sitac.imb_date ,
document_sitac.document_imb ,
document_sitac.document_pks ,
document_rfc.id as documentrfcid,
document_rfc.no_rfc,
document_rfc.rfc_date,
document_rfc.document_rfc,
document_rfc.id_pln,
document_rfc.target_rfi,
document_rfc.power_capacity,
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
left join document_sis on 
project.id=document_sis.project_id 
left join document_drm on 
project.id=document_drm.project_id 
left join document_sitac on 
project.id=document_sitac.project_id 
left join document_rfc on 
project.id=document_rfc.project_id 
where project.status_id = '11'




CREATE OR REPLACE VIEW vjobsdocumentrfcrevisi 
AS 
SELECT 
project.id,
project.projectid,
project.no_wo,
project.wo_date,
CONCAT("Batch #",project.batch, " ", project.years) AS batchnya,
project.batch,
project.years,
project.infratype,
project.area,
project.regional,
project.site_id_spk,
project.site_name_spk,
project.address_spk,
project.longitude_spk,
project.latitude_spk,
project.status_id,
project.project_status_id,status.detail as statusnya,
document_sis.id as documentid,
document_sis.document_sis,
document_drm.id as documentdrmid,
document_drm.site_id_actual ,
document_drm.site_name_actual ,
document_drm.province ,
document_drm.city ,
document_drm.address_actual ,
document_drm.longitude_actual ,
document_drm.latitude_actual ,
document_drm.kom_date ,
document_drm.drm_date ,
document_drm.document_kom ,
document_drm.document_drm ,
document_sitac.id as documentsitacid,
document_sitac.no_ban_bak ,
document_sitac.date_ban_bak ,
document_sitac.document_ban_bak ,
document_sitac.ijin_warga_date ,
document_sitac.document_ijin_warga ,
document_sitac.no_pks ,
document_sitac.pks_date ,
document_sitac.no_imb ,
document_sitac.imb_date ,
document_sitac.document_imb ,
document_sitac.document_pks ,
document_rfc.id as documentrfcid,
document_rfc.no_rfc,
document_rfc.rfc_date,
document_rfc.document_rfc,
document_rfc.id_pln,
document_rfc.target_rfi,
document_rfc.power_capacity,
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
left join document_sis on 
project.id=document_sis.project_id 
left join document_drm on 
project.id=document_drm.project_id 
left join document_sitac on 
project.id=document_sitac.project_id 
left join document_rfc on 
project.id=document_rfc.project_id 
where project.status_id = '12'




CREATE OR REPLACE VIEW vjobboq 
AS 
SELECT 
project.id,
project.projectid,
project.no_wo,
project.wo_date,
CONCAT("Batch #",project.batch, " ", project.years) AS batchnya,
project.batch,
project.years,
project.infratype,
project.area,
project.regional,
project.site_id_spk,
project.site_name_spk,
project.address_spk,
project.longitude_spk,
project.latitude_spk,
project.status_id,
project.project_status_id,status.detail as statusnya,
document_sis.id as documentid,
document_sis.document_sis,
document_drm.id as documentdrmid,
document_drm.site_id_actual ,
document_drm.site_name_actual ,
document_drm.province ,
document_drm.city ,
document_drm.address_actual ,
document_drm.longitude_actual ,
document_drm.latitude_actual ,
document_drm.kom_date ,
document_drm.drm_date ,
document_drm.document_kom ,
document_drm.document_drm ,
document_sitac.id as documentsitacid,
document_sitac.no_ban_bak ,
document_sitac.date_ban_bak ,
document_sitac.document_ban_bak ,
document_sitac.ijin_warga_date ,
document_sitac.document_ijin_warga ,
document_sitac.no_pks ,
document_sitac.pks_date ,
document_sitac.no_imb ,
document_sitac.imb_date ,
document_sitac.document_imb ,
document_sitac.document_pks ,
document_rfc.id as documentrfcid,
document_rfc.no_rfc,
document_rfc.rfc_date,
document_rfc.document_rfc,
document_rfc.id_pln,
document_rfc.target_rfi,
document_rfc.power_capacity,
document_boq.id as documentboqid,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
left join document_sis on 
project.id=document_sis.project_id 
left join document_drm on 
project.id=document_drm.project_id 
left join document_sitac on 
project.id=document_sitac.project_id 
left join document_rfc on 
project.id=document_rfc.project_id 
left join document_boq on 
project.id=document_boq.project_id 
where project.status_id = '13'


CREATE OR REPLACE VIEW vjobsmappingsite 
AS 
SELECT 
project.id,
project.projectid,
project.no_wo,
project.wo_date,
CONCAT("Batch #",project.batch, " ", project.years) AS batchnya,
project.batch,
project.years,
project.infratype,
project.area,
project.regional,
project.site_id_spk,
project.site_name_spk,
project.address_spk,
project.longitude_spk,
project.latitude_spk,
project.status_id,
project.project_status_id,status.detail as statusnya, 
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id  
where project.status_id = '102'



CREATE OR REPLACE VIEW vjobsapprovedmappingsite 
AS 
SELECT 
project.id,
project.projectid,
project.no_wo,
project.wo_date,
CONCAT("Batch #",project.batch, " ", project.years) AS batchnya,
project.batch,
project.years,
project.infratype,
project.area,
project.regional,
project.site_id_spk,
project.site_name_spk,
project.address_spk,
project.longitude_spk,
project.latitude_spk,
project.status_id,
project.project_status_id,status.detail as statusnya, 
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id  
where project.status_id = '103'



CREATE OR REPLACE VIEW vjobsapprovaldropsiteregional 
AS 
SELECT 
project.id,
project.projectid,
project.no_wo,
project.wo_date,
CONCAT("Batch #",project.batch, " ", project.years) AS batchnya,
project.batch,
project.years,
project.infratype,
project.area,
project.regional,
project.site_id_spk,
project.site_name_spk,
project.address_spk,
project.longitude_spk,
project.latitude_spk,
project.status_id,
project.project_status_id,status.detail as statusnya,
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
where project.status_id = '104' 



// save jika table drop project jika project di drop dan mapping


DELIMITER $$
CREATE TRIGGER moveToHistory AFTER UPDATE ON project
FOR EACH ROW
BEGIN
IF NEW.status_id = 105 then
DELETE FROM drop_site_history WHERE id = NEW.id ;
      INSERT INTO drop_site_history(id, projectid, no_wo, wo_date ,batch , years , infratype , area , regional , site_id_spk , site_name_spk , address_spk , longitude_spk , latitude_spk , status_id , project_status_id , created_at , updated_at)
       VALUES(NEW.id, NEW.projectid, NEW.no_wo ,NEW.wo_date ,NEW.batch , NEW.years , NEW.infratype , NEW.area , NEW.regional , NEW.site_id_spk , NEW.site_name_spk , NEW.address_spk , NEW.longitude_spk , NEW.latitude_spk , NEW.status_id , NEW.project_status_id, NOW(), NOW());
ELSE
IF NEW.status_id = 103 then
DELETE FROM mapping_site_history WHERE id = NEW.id ;
      INSERT INTO mapping_site_history(id, projectid, no_wo, wo_date ,batch , years , infratype , area , regional , site_id_spk , site_name_spk , address_spk , longitude_spk , latitude_spk , status_id , project_status_id , created_at , updated_at)
       VALUES(NEW.id, NEW.projectid, NEW.no_wo ,NEW.wo_date ,NEW.batch , NEW.years , NEW.infratype , NEW.area , NEW.regional , NEW.site_id_spk , NEW.site_name_spk , NEW.address_spk , NEW.longitude_spk , NEW.latitude_spk , NEW.status_id , NEW.project_status_id, NOW(), NOW());
END IF ;
END IF ;
END;$$

DELIMITER ;

