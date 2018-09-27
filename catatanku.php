level
'ADMINISTRATOR','REGIONAL','HQ'


posisi
'AM SUPPORT','ACCOUNT MANAGER','MANAGER MARKETING','MANAGER','HAKI - ACCOUNT MANAGER','HAKI - MANAGER','BISNIS'




this.DeleteSIS(this.rowDatanya.project.documentid,this.rowDatanya.project.projectid ,this.rowDatanya.project.document_sis);       
this.DeleteDRM(this.rowDatanya.project.documentdrmid,this.rowDatanya.project.projectid ,this.rowDatanya.project.document_kom ,this.rowDatanya.project.document_drm);       
this.DeleteSITAC(this.rowDatanya.project.documentsitacid,this.rowDatanya.project.projectid ,this.rowDatanya.project.document_ban_bak ,this.rowDatanya.project.document_ijin_warga ,this.rowDatanya.project.document_pks ,this.rowDatanya.project.document_imb);             
this.DeleteRFC(this.rowDatanya.project.documentrfcid,this.rowDatanya.project.projectid ,this.rowDatanya.project.document_rfc); 
               








/*   VIEW    */

CREATE OR REPLACE VIEW vusersregional 
AS
SELECT * FROM users where level = 'REGIONAL';



CREATE OR REPLACE VIEW vusershq 
AS
SELECT * FROM users where level = 'HQ';






CREATE OR REPLACE VIEW vjobcommunication 
AS
SELECT project_status.id,project_status.project_id,project_status.users_id,project_status.status,project_status.message,users_exist.name,users_exist.email,users_exist.level,users_exist.posisi,users_exist.area,users_exist.regional,project_status.created_at FROM project_status join users_exist on project_status.users_id=users_exist.id;








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
); 




CREATE OR REPLACE VIEW vprojectstatus 
AS 
SELECT project.id,status.detail
FROM project
join status
on project.status_id=status.id; 




CREATE OR REPLACE VIEW vhistorydropsite 
AS
SELECT drop_site_history.id,drop_site_history.projectid,drop_site_history.no_wo,drop_site_history.wo_date,
CONCAT("Batch #",drop_site_history.batch, " ", drop_site_history.years) AS batchnya,
drop_site_history.batch,drop_site_history.years,drop_site_history.infratype,drop_site_history.area,drop_site_history.regional,drop_site_history.site_id_spk,drop_site_history.site_name_spk,drop_site_history.address_spk,drop_site_history.longitude_spk,drop_site_history.latitude_spk,drop_site_history.status_id,drop_site_history.project_status_id,status.detail as statusnya,drop_site_history.created_at FROM drop_site_history join status on drop_site_history.status_id=status.id ;




CREATE OR REPLACE VIEW vcountboqsubmit
as
select count(*) as jumlah from boq_submit;












CREATE OR REPLACE VIEW vboqsubmitdata
AS
SELECT 
  id, 
  boq_code, 
  title,
  nama_telkomsel,
  posisi_telkomsel,
  nama_manager,
  posisi_manager,
  nama_user,
  posisi_user,
  IF(project_id='', 0 ,IFNULL((CHAR_LENGTH(project_id) - CHAR_LENGTH(REPLACE(project_id, ',', '')) + 1),0)) as total,
  CASE status
        WHEN 0 THEN 'MENUNGGU APPROVAL'
        WHEN 1 THEN 'REPAIR BOQ'
        WHEN 2 THEN 'APPROVED'
        WHEN 3 THEN 'BOQ VERFIFIKASI'
        WHEN 4 THEN 'BOQ PROSES PR'
        WHEN 5 THEN 'BOQ PO RELEASE' 
        ELSE 'CANCEL' END
        AS 'statusnya',
        project_id,
  area,area2,message,status,created_at,updated_at
FROM boq_submit
where status=0
;


CREATE OR REPLACE VIEW vboqsubmitdatarepair
AS
SELECT 
  id, 
  boq_code, 
  title,
  nama_telkomsel,
  posisi_telkomsel,
  nama_manager,
  posisi_manager,
  nama_user,
  posisi_user,
 IF(project_id='', 0 ,IFNULL((CHAR_LENGTH(project_id) - CHAR_LENGTH(REPLACE(project_id, ',', '')) + 1),0)) as total, 
  CASE status
        WHEN 0 THEN 'MENUNGGU APPROVAL'
        WHEN 1 THEN 'REPAIR BOQ'
        WHEN 2 THEN 'APPROVED'
        WHEN 3 THEN 'BOQ VERFIFIKASI'
        WHEN 4 THEN 'BOQ PROSES PR'
        WHEN 5 THEN 'BOQ PO RELEASE' 
        ELSE 'CANCEL' END
        AS 'statusnya',
        project_id,
  area,area2,message,status,created_at,updated_at
FROM boq_submit
where status=1
;


CREATE OR REPLACE VIEW vboqsubmitdataapproval
AS
SELECT 
  id, 
  boq_code, 
  title,
  nama_telkomsel,
  posisi_telkomsel,
  nama_manager,
  posisi_manager,
  nama_user,
  posisi_user,
 IF(project_id='', 0 ,IFNULL((CHAR_LENGTH(project_id) - CHAR_LENGTH(REPLACE(project_id, ',', '')) + 1),0)) as total, 
  CASE status
        WHEN 0 THEN 'MENUNGGU APPROVAL'
        WHEN 1 THEN 'REPAIR BOQ'
        WHEN 2 THEN 'APPROVED'
        WHEN 3 THEN 'BOQ VERFIFIKASI'
        WHEN 4 THEN 'BOQ PROSES PR'
        WHEN 5 THEN 'BOQ PO RELEASE' 
        ELSE 'CANCEL' END
        AS 'statusnya',
        project_id,
  area,area2,message,status,created_at,updated_at
FROM boq_submit
where status=2
;



CREATE OR REPLACE VIEW vboqsubmitdataverifikasi
AS
SELECT 
  id, 
  boq_code, 
  title,
  nama_telkomsel,
  posisi_telkomsel,
  nama_manager,
  posisi_manager,
  nama_user,
  posisi_user,
 IF(project_id='', 0 ,IFNULL((CHAR_LENGTH(project_id) - CHAR_LENGTH(REPLACE(project_id, ',', '')) + 1),0)) as total,

  CASE status
        WHEN 0 THEN 'MENUNGGU APPROVAL'
        WHEN 1 THEN 'REPAIR BOQ'
        WHEN 2 THEN 'APPROVED'
        WHEN 3 THEN 'BOQ VERFIFIKASI'
        WHEN 4 THEN 'BOQ PROSES PR'
        WHEN 5 THEN 'BOQ PO RELEASE' 
        ELSE 'CANCEL' END
        AS 'statusnya',
  project_id,
  area,area2,message,status,created_at,updated_at
FROM boq_submit
where
status=2;


CREATE OR REPLACE VIEW vboqsubmitdataprosespr
AS
SELECT 
  id, 
  boq_code, 
  title,
  nama_telkomsel,
  posisi_telkomsel,
  nama_manager,
  posisi_manager,
  nama_user,
  posisi_user,
 IF(project_id='', 0 ,IFNULL((CHAR_LENGTH(project_id) - CHAR_LENGTH(REPLACE(project_id, ',', '')) + 1),0)) as total,
 CASE status
        WHEN 0 THEN 'MENUNGGU APPROVAL'
        WHEN 1 THEN 'REPAIR BOQ'
        WHEN 2 THEN 'APPROVED'
        WHEN 3 THEN 'BOQ VERFIFIKASI'
        WHEN 4 THEN 'BOQ PROSES PR'
        WHEN 5 THEN 'BOQ PO RELEASE' 
        ELSE 'CANCEL' END
        AS 'statusnya',
  project_id,
  area,area2,message,status,created_at,updated_at
FROM boq_submit
where
status=3;



CREATE OR REPLACE VIEW vboqsubmitdataporelease
AS
SELECT 
  id, 
  boq_code, 
  title,
  nama_telkomsel,
  posisi_telkomsel,
  nama_manager,
  posisi_manager,
  nama_user,
  posisi_user,
 IF(project_id='', 0 ,IFNULL((CHAR_LENGTH(project_id) - CHAR_LENGTH(REPLACE(project_id, ',', '')) + 1),0)) as total,
 CASE status
        WHEN 0 THEN 'MENUNGGU APPROVAL'
        WHEN 1 THEN 'REPAIR BOQ'
        WHEN 2 THEN 'APPROVED'
        WHEN 3 THEN 'BOQ VERFIFIKASI'
        WHEN 4 THEN 'BOQ PROSES PR'
        WHEN 5 THEN 'BOQ PO RELEASE' 
        ELSE 'CANCEL' END
        AS 'statusnya',
  project_id,
  area,area2,message,status,created_at,updated_at
FROM boq_submit
where
status=4;





CREATE OR REPLACE VIEW vhistorymappingsite 
AS
SELECT mapping_site_history.id,mapping_site_history.projectid,mapping_site_history.no_wo,mapping_site_history.wo_date,
CONCAT("Batch #",mapping_site_history.batch, " ", mapping_site_history.years) AS batchnya,
mapping_site_history.batch,mapping_site_history.years,mapping_site_history.infratype,mapping_site_history.area,mapping_site_history.regional,mapping_site_history.site_id_spk,mapping_site_history.site_name_spk,mapping_site_history.address_spk,mapping_site_history.longitude_spk,mapping_site_history.latitude_spk,mapping_site_history.status_id,mapping_site_history.project_status_id,status.detail as statusnya,mapping_site_history.created_at FROM mapping_site_history join status on mapping_site_history.status_id=status.id;




CREATE OR REPLACE VIEW vjobsdocumentsis 
AS
SELECT project.id,project.projectid,project.no_wo,project.wo_date,
CONCAT("Batch #",project.batch, " ", project.years) AS batchnya,
project.batch,project.years,project.infratype,project.area,project.regional,project.site_id_spk,project.site_name_spk,project.address_spk,project.longitude_spk,project.latitude_spk,project.status_id,project.project_status_id,status.detail as statusnya,project.created_at FROM project join status on project.status_id=status.id where project.status_id = '1';


CREATE OR REPLACE VIEW vjobsdocumentsisrevisi 
AS
SELECT project.id,project.projectid,project.no_wo,project.wo_date,CONCAT("Batch #",project.batch, " ", project.years) AS batchnya,project.batch,project.years,project.infratype,project.area,project.regional,project.site_id_spk,project.site_name_spk,project.address_spk,project.longitude_spk,project.latitude_spk,project.status_id,project.project_status_id,status.detail as statusnya,document_sis.id as documentsisid,document_sis.document_sis,project.updated_at as created_at FROM project join status on project.status_id=status.id join document_sis on project.id=document_sis.project_id where project.status_id = '3';



CREATE OR REPLACE VIEW vjobsapprovaldocumentsis 
AS
SELECT project.id,project.projectid,project.no_wo,project.wo_date,CONCAT("Batch #",project.batch, " ", project.years) AS batchnya,project.batch,project.years,project.infratype,project.area,project.regional,project.site_id_spk,project.site_name_spk,project.address_spk,project.longitude_spk,project.latitude_spk,project.status_id,project.project_status_id,status.detail as statusnya,document_sis.id as documentid,document_sis.document_sis,document_sis.created_at FROM project join status on project.status_id=status.id join document_sis on project.id=document_sis.project_id where project.status_id = '2';


CREATE OR REPLACE VIEW vjobsdocumentdrm 
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
where project.status_id = '4';


 CREATE OR REPLACE VIEW vjobsapprovaldocumentdrm 
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
where project.status_id = '5';


 CREATE OR REPLACE VIEW vjobsdocumentdrmrevisi 
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
where project.status_id = '6';


 


CREATE OR REPLACE VIEW vjobsdocumentsitac 
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
where project.status_id = '7';







CREATE OR REPLACE VIEW vjobsapprovaldocumentsitac 
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
where project.status_id = '8';


CREATE OR REPLACE VIEW vjobsdocumentsitacrevisi 
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
where project.status_id = '9';



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
where project.status_id = '10';



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
where project.status_id = '11';


CREATE OR REPLACE VIEW v_check_invoice_data
AS
SELECT
invoice.project_id,project.projectid
from 
invoice
join
project
on invoice.project_id=project.id;

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
where project.status_id = '12';




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
document_boq.harga_bulan,
document_boq.harga_tahun,
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
where project.boq_status = '13';



CREATE OR REPLACE VIEW vjobpo 
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
document_boq.harga_bulan,
document_boq.harga_tahun,
po.id as poid,
po.no_po,
po.po_date,
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
left join po on 
project.id=po.project_id 
where project.boq_status = '20';



CREATE OR REPLACE VIEW vjobsubmitboq 
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
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
where project.boq_status = '14';



CREATE OR REPLACE VIEW vallprojectboq 
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
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
project.id=document_boq.project_id  ;


CREATE OR REPLACE VIEW vjobsubmitboqgroup
AS
select batchnya,batch,years,area,count(*) as totalsite from vjobsubmitboq group by batchnya,batch,years,area;


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
where project.status_id = '102';


CREATE OR REPLACE VIEW vtinggitower
AS
select distinct(tower_high) from document_boq ;


CREATE OR REPLACE VIEW vinfratype
AS
select distinct(infratype) from project; 


CREATE OR REPLACE VIEW vallregional
AS
select distinct(regional) from project; 



CREATE OR REPLACE VIEW vtahun
AS
select distinct(years) from project ;




CREATE OR REPLACE VIEW vbiayasewanational
AS
select infratype,years,
IFNULL(avg(nilai_revenue),0) as jumlah 
from vallproject
where
nilai_revenue > 0
group by infratype,years  ;



CREATE OR REPLACE VIEW vbiayasewaarea
AS
select years,area,
IFNULL(avg(nilai_revenue),0) as jumlah
from vallproject
where
nilai_revenue > 0
group by years,area ;




CREATE OR REPLACE VIEW vbiayasewaregional
AS
select years,regional,
IFNULL(avg(nilai_revenue),0) as jumlah
from vallproject
where
nilai_revenue > 0
group by years,regional ;




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
where project.status_id = '103';



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
where project.status_id = '104' ;


CREATE OR REPLACE VIEW vjobsapprovaldropsiteHQ 
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
where project.status_id = '106'; 



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





CREATE OR REPLACE VIEW vtotalproject 
AS  
SELECT years,
(select count(*) from project where status_id in(1) and years=p.years) as jumlahnew,
(select count(*) from project where status_id in(2,3) and years=p.years) as jumlahsis,
(select count(*) from project where status_id in(4,5,6) and years=p.years) as jumlahdrm,
(select count(*) from project where status_id in(7,8,9) and years=p.years) as jumlahsitac,
(select count(*) from project where status_id in(10,11,12) and years=p.years) as jumlahrfc,
(select count(*) from project where status_id in(13,14,15,16,17) and years=p.years) as jumlahboq,
(select count(*) from project where boq_status in(18) and years=p.years) as jumlahboqverifikasi,
(select count(*) from project where boq_status in(19) and years=p.years) as jumlahboqprosespr,
(select count(*) from project where boq_status in(20) and years=p.years) as jumlahboqrelease,
(select count(*) from project where status_id in(21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45) and years=p.years) as cme,
(select count(*) from project where status_id in(105) and years=p.years) as jumlahdrop,
COUNT(*) as jumlah from project as p GROUP BY years;




CREATE OR REPLACE VIEW vtotalprojectregional 
AS  
SELECT p.years,p.regional,
(select count(*) from project where status_id in(1) and years=p.years and regional=p.regional) as jumlahnew,
(select count(*) from project where status_id in(2,3) and years=p.years and regional=p.regional) as jumlahsis,
(select count(*) from project where status_id in(4,5,6) and years=p.years and regional=p.regional) as jumlahdrm,
(select count(*) from project where status_id in(7,8,9) and years=p.years and regional=p.regional) as jumlahsitac,
(select count(*) from project where status_id in(10,11,12) and years=p.years and regional=p.regional) as jumlahrfc,
(select count(*) from project where status_id in(13,14,15,16,17) and years=p.years and regional=p.regional) as jumlahboq,
(select count(*) from project where status_id in(18) and years=p.years and regional=p.regional) as jumlahboqverifikasi,
(select count(*) from project where status_id in(19) and years=p.years and regional=p.regional) as jumlahboqprosespr,
(select count(*) from project where status_id in(20) and years=p.years and regional=p.regional) as jumlahboqrelease,
(select count(*) from project where status_id in(105) and years=p.years and regional=p.regional) as jumlahdrop,
COUNT(*) as jumlah 
from project as p 
GROUP BY years,regional;





CREATE OR REPLACE VIEW vtotalprojectarea 
AS  
SELECT p.years,p.area,
(select count(*) from project where status_id in(1) and years=p.years and area=p.area) as jumlahnew,
(select count(*) from project where status_id in(2,3) and years=p.years and area=p.area) as jumlahsis,
(select count(*) from project where status_id in(4,5,6) and years=p.years and area=p.area) as jumlahdrm,
(select count(*) from project where status_id in(7,8,9) and years=p.years and area=p.area) as jumlahsitac,
(select count(*) from project where status_id in(10,11,12) and years=p.years and area=p.area) as jumlahrfc,
(select count(*) from project where status_id in(13,14,15,16,17) and years=p.years and area=p.area) as jumlahboq,
(select count(*) from project where status_id in(18) and years=p.years and area=p.area) as jumlahboqverifikasi,
(select count(*) from project where status_id in(19) and years=p.years and area=p.area) as jumlahboqprosespr,
(select count(*) from project where status_id in(20) and years=p.years and area=p.area) as jumlahboqrelease,
(select count(*) from project where status_id in(105) and years=p.years and area=p.area) as jumlahdrop,
COUNT(*) as jumlah 
from project p 
GROUP BY years,area;




CREATE OR REPLACE VIEW vallbatch 
AS 
SELECT 
distinct(CONCAT("Batch #",project.batch, " ", project.years))AS batchnya from project;







CREATE OR REPLACE VIEW vsiteopening 
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
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
left join site_opening on 
project.id=site_opening.project_id
where project.status_id=21;




CREATE OR REPLACE VIEW vsiteopeningrevisi 
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
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
left join site_opening on 
project.id=site_opening.project_id
where project.status_id=22 ;


CREATE OR REPLACE VIEW vsiteexcavation 
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
where project.status_id = 23;


CREATE OR REPLACE VIEW vsiteexcavationrevisi 
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
where project.status_id = 24;





CREATE OR REPLACE VIEW vsiterebaring 
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
where project.status_id = 25;





CREATE OR REPLACE VIEW vsiterebaringrevisi 
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
where project.status_id = 26;




CREATE OR REPLACE VIEW vsitepouring 
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
where project.status_id = 27;




CREATE OR REPLACE VIEW vsitepouringrevisi 
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
where project.status_id = 28;





CREATE OR REPLACE VIEW vsitecuring 
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
where project.status_id = 29;




CREATE OR REPLACE VIEW vsitecuringrevisi 
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
where project.status_id = 30;





CREATE OR REPLACE VIEW vsitetowererection 
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
where project.status_id = 31;






CREATE OR REPLACE VIEW vsitetowererectionrevisi 
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
where project.status_id = 32;





CREATE OR REPLACE VIEW vsitemeprocess 
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
where project.status_id = 33;



CREATE OR REPLACE VIEW vsitefenceyard
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
fence_yard.id as fenceyardid,
fence_yard.fence_yard_date,
fence_yard.fence_yard_document,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join fence_yard on 
project.id=fence_yard.project_id
where project.status_id = 35;



CREATE OR REPLACE VIEW vsitefenceyardrevisi
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
fence_yard.id as fenceyardid,
fence_yard.fence_yard_date,
fence_yard.fence_yard_document,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join fence_yard on 
project.id=fence_yard.project_id
where project.status_id = 36;




CREATE OR REPLACE VIEW vsitemeprocessrevisi 
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
where project.status_id = 34;







CREATE OR REPLACE VIEW vsiterfibaut 
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
rfi_baut.id as rfibautid,
rfi_baut.rfi_date,
rfi_baut.rfi_document,
rfi_baut.baut_date,
rfi_baut.baut_document,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join rfi_baut on 
project.id=rfi_baut.project_id
where project.status_id = 37;




CREATE OR REPLACE VIEW vsiterfibautrevisi 
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
rfi_baut.id as rfibautid,
rfi_baut.rfi_date,
rfi_baut.rfi_document,
rfi_baut.baut_date,
rfi_baut.baut_document,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join rfi_baut on 
project.id=rfi_baut.project_id
where project.status_id = 38;



CREATE OR REPLACE VIEW vsitecmeapproval
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
rfi_baut.id as rfibautid,
rfi_baut.rfi_date,
rfi_baut.rfi_document,
rfi_baut.baut_date,
rfi_baut.baut_document,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join rfi_baut on 
project.id=rfi_baut.project_id
where project.status_id = 39;



CREATE OR REPLACE VIEW vsitecrfidetail
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
rfi_baut.id as rfibautid,
rfi_baut.rfi_date,
rfi_baut.rfi_document,
rfi_baut.baut_date,
rfi_baut.baut_document,
rfi_detail.id as rfidetailid,
rfi_detail.rfi_detail_start_date,
rfi_detail.rfi_detail_end_date,
rfi_detail.rfi_detail_price_month,
rfi_detail.rfi_detail_price_year,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join rfi_baut on 
project.id=rfi_baut.project_id
left join rfi_detail on 
project.id=rfi_detail.project_id
where project.status_id = 40;



CREATE OR REPLACE VIEW vsitecrfidetailapproval
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
rfi_baut.id as rfibautid,
rfi_baut.rfi_date,
rfi_baut.rfi_document,
rfi_baut.baut_date,
rfi_baut.baut_document,
rfi_detail.id as rfidetailid,
rfi_detail.rfi_detail_start_date,
rfi_detail.rfi_detail_end_date,
rfi_detail.rfi_detail_price_month,
rfi_detail.rfi_detail_price_year,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join rfi_baut on 
project.id=rfi_baut.project_id
left join rfi_detail on 
project.id=rfi_detail.project_id
where project.status_id = 41;


CREATE OR REPLACE VIEW vsitecrfidetailrevisi
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
rfi_baut.id as rfibautid,
rfi_baut.rfi_date,
rfi_baut.rfi_document,
rfi_baut.baut_date,
rfi_baut.baut_document,
rfi_detail.id as rfidetailid,
rfi_detail.rfi_detail_start_date,
rfi_detail.rfi_detail_end_date,
rfi_detail.rfi_detail_price_month,
rfi_detail.rfi_detail_price_year,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join rfi_baut on 
project.id=rfi_baut.project_id
left join rfi_detail on 
project.id=rfi_detail.project_id
where project.status_id = 43;




CREATE OR REPLACE VIEW vsitesubmitcme
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
rfi_baut.id as rfibautid,
rfi_baut.rfi_date,
rfi_baut.rfi_document,
rfi_baut.baut_date,
rfi_baut.baut_document,
rfi_detail.id as rfidetailid,
rfi_detail.rfi_detail_start_date,
rfi_detail.rfi_detail_end_date,
rfi_detail.rfi_detail_price_month,
rfi_detail.rfi_detail_price_year,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join rfi_baut on 
project.id=rfi_baut.project_id
left join rfi_detail on 
project.id=rfi_detail.project_id
where project.haki_status = 44;





CREATE OR REPLACE VIEW vcmesubmitdata
AS
SELECT 
  id, 
  cme_code, 
  project_id, 
  area,
  area2,
  status,
  message,
  created_at,
  updated_at, 
   IFNULL((CHAR_LENGTH(project_id) - CHAR_LENGTH(REPLACE(project_id, ',', '')) + 1),0) as total,
   CASE status
        WHEN 0 THEN 'MENUNGGU APPROVAL'
        WHEN 1 THEN 'REPAIR CME'
        WHEN 2 THEN 'ACCRUAL'
        WHEN 3 THEN 'ACCRUED' 
        ELSE 'CANCEL' END
        AS 'statusnya'
 
FROM cme_submit
where status=0;






CREATE OR REPLACE VIEW vcmesubmitdatarevisi
AS
SELECT 
  id, 
  cme_code, 
  project_id, 
  area,
  area2,
  status,
  message,
  created_at,
  updated_at, 
   IFNULL((CHAR_LENGTH(project_id) - CHAR_LENGTH(REPLACE(project_id, ',', '')) + 1),0) as total,
   CASE status
        WHEN 0 THEN 'MENUNGGU APPROVAL'
        WHEN 1 THEN 'REPAIR CME'
        WHEN 2 THEN 'ACCRUAL'
        WHEN 3 THEN 'ACCRUED' 
        ELSE 'CANCEL' END
        AS 'statusnya'
FROM cme_submit
where status=1;




CREATE OR REPLACE VIEW vsiteapprovedcme
AS
SELECT 
  id, 
  cme_code, 
  project_id, 
  area,
  area2,
  status,
  message,
  created_at,
  updated_at, 
   IFNULL((CHAR_LENGTH(project_id) - CHAR_LENGTH(REPLACE(project_id, ',', '')) + 1),0) as total,
   CASE status
        WHEN 0 THEN 'MENUNGGU APPROVAL'
        WHEN 1 THEN 'REPAIR CME'
        WHEN 2 THEN 'ACCRUAL'
        WHEN 3 THEN 'ACCRUED' 
        ELSE 'CANCEL' END
        AS 'statusnya'
FROM cme_submit
where status in (2,3);


CREATE OR REPLACE VIEW vsiteapprovedcmetoaccrued
AS
SELECT 
  id, 
  cme_code, 
  project_id, 
  area,
  area2,
  status,
  message,
  created_at,
  updated_at, 
   IFNULL((CHAR_LENGTH(project_id) - CHAR_LENGTH(REPLACE(project_id, ',', '')) + 1),0) as total,
   CASE status
        WHEN 0 THEN 'MENUNGGU APPROVAL'
        WHEN 1 THEN 'REPAIR CME'
        WHEN 2 THEN 'ACCRUAL'
        WHEN 3 THEN 'ACCRUED' 
        ELSE 'CANCEL' END
        AS 'statusnya'
FROM cme_submit
where status=2;


CREATE OR REPLACE VIEW vsiteapprovedcmeaccrueddata
AS
SELECT 
  id, 
  cme_code, 
  project_id, 
  area,
  area2,
  status,
  message,
  created_at,
  updated_at, 
   IFNULL((CHAR_LENGTH(project_id) - CHAR_LENGTH(REPLACE(project_id, ',', '')) + 1),0) as total,
   CASE status
        WHEN 0 THEN 'MENUNGGU APPROVAL'
        WHEN 1 THEN 'REPAIR CME'
        WHEN 2 THEN 'ACCRUAL'
        WHEN 3 THEN 'ACCRUED' 
        ELSE 'CANCEL' END
        AS 'statusnya'
FROM cme_submit
where status=3;



CREATE OR REPLACE VIEW v_extract_accured_data_total
as
SELECT 
a.id,
  a.cme_code,  
  a.area,
  a.area2,
  a.status ,
GROUP_CONCAT(project_id SEPARATOR ',') as project_id,
 (
 SELECT  
   SUM(IFNULL((CHAR_LENGTH(project_id) - CHAR_LENGTH(REPLACE(project_id, ',', '')) + 1),0)) as total
FROM cme_submit
where cme_code = a.cme_code and area=a.area and area2=a.area2 and status=a.status
  )
  as total,
  a.created_at,a.updated_at
FROM cme_submit a
where 
a.status =3
group by
a.cme_code, a.area,a.area2,a.status
order by a.id desc




CREATE OR REPLACE VIEW vallprojectaccrual 
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
project.batch_accrue,
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
fence_yard.id as fenceyardid,
fence_yard.fence_yard_date,
fence_yard.fence_yard_document,
rfi_baut.id as rfibautid,
rfi_baut.rfi_date,
rfi_baut.rfi_document,
rfi_baut.baut_date,
rfi_baut.baut_document,
rfi_detail.id as rfidetailid,
rfi_detail.rfi_detail_start_date,
rfi_detail.rfi_detail_end_date,
rfi_detail.rfi_detail_price_month,
rfi_detail.rfi_detail_price_year,
IFNULL((((LAST_DAY(project.batch_accrue) - rfi_detail.rfi_detail_start_date)/DAY(LAST_DAY(project.batch_accrue)) * rfi_detail.rfi_detail_price_month)),0) as nilai_revenue,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join rfi_baut on 
project.id=rfi_baut.project_id
left join fence_yard on 
project.id=fence_yard.project_id
left join rfi_detail on 
project.id=rfi_detail.project_id 
where project.haki_status=47;




CREATE OR REPLACE VIEW vallprojectaccrued 
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
project.batch_accrue,
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
fence_yard.id as fenceyardid,
fence_yard.fence_yard_date,
fence_yard.fence_yard_document,
rfi_baut.id as rfibautid,
rfi_baut.rfi_date,
rfi_baut.rfi_document,
rfi_baut.baut_date,
rfi_baut.baut_document,
rfi_detail.id as rfidetailid,
rfi_detail.rfi_detail_start_date,
rfi_detail.rfi_detail_end_date,
rfi_detail.rfi_detail_price_month,
rfi_detail.rfi_detail_price_year,
IFNULL((((LAST_DAY(project.batch_accrue) - rfi_detail.rfi_detail_start_date)/DAY(LAST_DAY(project.batch_accrue)) * rfi_detail.rfi_detail_price_month)),0) as nilai_revenue,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join rfi_baut on 
project.id=rfi_baut.project_id
left join fence_yard on 
project.id=fence_yard.project_id
left join rfi_detail on 
project.id=rfi_detail.project_id 
where project.haki_status=48;





CREATE OR REPLACE VIEW vjobsdocumentbaksbauk 
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
project.batch_accrue,
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
fence_yard.id as fenceyardid,
fence_yard.fence_yard_date,
fence_yard.fence_yard_document,
rfi_baut.id as rfibautid,
rfi_baut.rfi_date,
rfi_baut.rfi_document,
rfi_baut.baut_date,
rfi_baut.baut_document,
rfi_detail.id as rfidetailid,
rfi_detail.rfi_detail_start_date,
rfi_detail.rfi_detail_end_date,
rfi_detail.rfi_detail_price_month,
rfi_detail.rfi_detail_price_year,
IFNULL((((LAST_DAY(project.batch_accrue) - rfi_detail.rfi_detail_start_date)/DAY(LAST_DAY(project.batch_accrue)) * rfi_detail.rfi_detail_price_month)),0) as nilai_revenue,
po.id as poid,
po.no_po,
po.po_date,
baks_bauk.id as baksbaukid,
baks_bauk.no_baks,
baks_bauk.date_baks,
baks_bauk.document_baks,
baks_bauk.document_wctr,
baks_bauk.document_boq_project,
baks_bauk.document_rfi_certificate,
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join rfi_baut on 
project.id=rfi_baut.project_id
left join fence_yard on 
project.id=fence_yard.project_id
left join rfi_detail on 
project.id=rfi_detail.project_id 
left join po on 
project.id=po.project_id 
left join baks_bauk on 
project.id=baks_bauk.project_id 
where project.status_id=42;





CREATE OR REPLACE VIEW vallprojectapprovalbaksbaukarea 
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
project.batch_accrue,
po.id as poid,
po.no_po,
po.po_date,
project.project_status_id,
status.detail as statusnya,
bqs.detail as statusnyaboq,
bqh.detail as statusnyahaki,
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
fence_yard.id as fenceyardid,
fence_yard.fence_yard_date,
fence_yard.fence_yard_document,
rfi_baut.id as rfibautid,
rfi_baut.rfi_date,
rfi_baut.rfi_document,
rfi_baut.baut_date,
rfi_baut.baut_document,
rfi_detail.id as rfidetailid,
rfi_detail.rfi_detail_start_date,
rfi_detail.rfi_detail_end_date,
rfi_detail.rfi_detail_price_month,
rfi_detail.rfi_detail_price_year,
baks_bauk.id as baksbaukid,
baks_bauk.no_baks,
baks_bauk.date_baks,
baks_bauk.document_baks,
baks_bauk.document_wctr,
baks_bauk.document_boq_project,
baks_bauk.document_rfi_certificate,
IFNULL((((LAST_DAY(project.batch_accrue) - rfi_detail.rfi_detail_start_date)/DAY(LAST_DAY(project.batch_accrue)) * rfi_detail.rfi_detail_price_month)),0) as nilai_revenue,
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
left join status  bqs on 
project.boq_status=bqs.id 
left join status  bqh on 
project.haki_status=bqh.id
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join rfi_baut on 
project.id=rfi_baut.project_id
left join fence_yard on 
project.id=fence_yard.project_id
left join rfi_detail on 
project.id=rfi_detail.project_id 
left join po on 
project.id=po.project_id  
left join baks_bauk on 
project.id=baks_bauk.project_id  
where project.status_id=49;




CREATE OR REPLACE VIEW vallprojectbaksbaukrevisi 
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
project.batch_accrue,
po.id as poid,
po.no_po,
po.po_date,
project.project_status_id,
status.detail as statusnya,
bqs.detail as statusnyaboq,
bqh.detail as statusnyahaki,
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
fence_yard.id as fenceyardid,
fence_yard.fence_yard_date,
fence_yard.fence_yard_document,
rfi_baut.id as rfibautid,
rfi_baut.rfi_date,
rfi_baut.rfi_document,
rfi_baut.baut_date,
rfi_baut.baut_document,
rfi_detail.id as rfidetailid,
rfi_detail.rfi_detail_start_date,
rfi_detail.rfi_detail_end_date,
rfi_detail.rfi_detail_price_month,
rfi_detail.rfi_detail_price_year,
baks_bauk.id as baksbaukid,
baks_bauk.no_baks,
baks_bauk.date_baks,
baks_bauk.document_baks,
baks_bauk.document_wctr,
baks_bauk.document_boq_project,
baks_bauk.document_rfi_certificate,
IFNULL((((LAST_DAY(project.batch_accrue) - rfi_detail.rfi_detail_start_date)/DAY(LAST_DAY(project.batch_accrue)) * rfi_detail.rfi_detail_price_month)),0) as nilai_revenue,
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
left join status  bqs on 
project.boq_status=bqs.id 
left join status  bqh on 
project.haki_status=bqh.id
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join rfi_baut on 
project.id=rfi_baut.project_id
left join fence_yard on 
project.id=fence_yard.project_id
left join rfi_detail on 
project.id=rfi_detail.project_id 
left join po on 
project.id=po.project_id  
left join baks_bauk on 
project.id=baks_bauk.project_id  
where project.status_id=50;





CREATE OR REPLACE VIEW vsiteapprovedinvoiceadd 
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
project.batch_accrue,
po.id as poid,
po.no_po,
po.po_date,
project.project_status_id,
status.detail as statusnya,
bqs.detail as statusnyaboq,
bqh.detail as statusnyahaki,
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
fence_yard.id as fenceyardid,
fence_yard.fence_yard_date,
fence_yard.fence_yard_document,
rfi_baut.id as rfibautid,
rfi_baut.rfi_date,
rfi_baut.rfi_document,
rfi_baut.baut_date,
rfi_baut.baut_document,
rfi_detail.id as rfidetailid,
rfi_detail.rfi_detail_start_date,
rfi_detail.rfi_detail_end_date,
rfi_detail.rfi_detail_price_month,
rfi_detail.rfi_detail_price_year,
baks_bauk.id as baksbaukid,
baks_bauk.no_baks,
baks_bauk.date_baks,
baks_bauk.document_baks,
baks_bauk.document_wctr,
baks_bauk.document_boq_project,
baks_bauk.document_rfi_certificate, 
invoice.tgl_mulai_sewa,
invoice.tgl_target_rfi,
invoice.document_boq_baps, 
invoice.tgL_akhir_sewa,
invoice.document_baps,
invoice.id as invoiceid,
invoice.no_receive,
invoice.no_kontrak,
invoice.no_invoice,
invoice.tgl_invoice,
IFNULL((((LAST_DAY(project.batch_accrue) - rfi_detail.rfi_detail_start_date)/DAY(LAST_DAY(project.batch_accrue)) * rfi_detail.rfi_detail_price_month)),0) as nilai_revenue,
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
left join status  bqs on 
project.boq_status=bqs.id 
left join status  bqh on 
project.haki_status=bqh.id
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join rfi_baut on 
project.id=rfi_baut.project_id
left join fence_yard on 
project.id=fence_yard.project_id
left join rfi_detail on 
project.id=rfi_detail.project_id 
left join po on 
project.id=po.project_id  
left join baks_bauk on 
project.id=baks_bauk.project_id   
left join invoice on 
project.id=invoice.project_id  
where project.status_id=51;





CREATE OR REPLACE VIEW vsitereportbisnis
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
project.batch_accrue,
po.id as poid,
po.no_po,
po.po_date,
project.project_status_id,
status.detail as statusnya,
bqs.detail as statusnyaboq,
bqh.detail as statusnyahaki,
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
fence_yard.id as fenceyardid,
fence_yard.fence_yard_date,
fence_yard.fence_yard_document,
rfi_baut.id as rfibautid,
rfi_baut.rfi_date,
rfi_baut.rfi_document,
rfi_baut.baut_date,
rfi_baut.baut_document,
rfi_detail.id as rfidetailid,
rfi_detail.rfi_detail_start_date,
rfi_detail.rfi_detail_end_date,
rfi_detail.rfi_detail_price_month,
rfi_detail.rfi_detail_price_year,
baks_bauk.id as baksbaukid,
baks_bauk.no_baks,
baks_bauk.date_baks,
baks_bauk.document_baks,
baks_bauk.document_wctr,
baks_bauk.document_boq_project,
baks_bauk.document_rfi_certificate, 
invoice.tgl_mulai_sewa,
invoice.tgl_target_rfi,
invoice.document_boq_baps, 
invoice.tgL_akhir_sewa,
invoice.document_baps,
invoice.id as invoiceid,
invoice.no_receive,
invoice.no_kontrak,
invoice.no_invoice,
invoice.tgl_invoice,
IFNULL((((LAST_DAY(project.batch_accrue) - rfi_detail.rfi_detail_start_date)/DAY(LAST_DAY(project.batch_accrue)) * rfi_detail.rfi_detail_price_month)),0) as nilai_revenue,
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
left join status  bqs on 
project.boq_status=bqs.id 
left join status  bqh on 
project.haki_status=bqh.id
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join rfi_baut on 
project.id=rfi_baut.project_id
left join fence_yard on 
project.id=fence_yard.project_id
left join rfi_detail on 
project.id=rfi_detail.project_id 
left join po on 
project.id=po.project_id  
left join baks_bauk on 
project.id=baks_bauk.project_id    
left join invoice on 
project.id=invoice.project_id  
where project.status_id=54;





CREATE OR REPLACE VIEW vsiteapprovedboqbapsrevisi 
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
project.batch_accrue,
po.id as poid,
po.no_po,
po.po_date,
project.project_status_id,
status.detail as statusnya,
bqs.detail as statusnyaboq,
bqh.detail as statusnyahaki,
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
fence_yard.id as fenceyardid,
fence_yard.fence_yard_date,
fence_yard.fence_yard_document,
rfi_baut.id as rfibautid,
rfi_baut.rfi_date,
rfi_baut.rfi_document,
rfi_baut.baut_date,
rfi_baut.baut_document,
rfi_detail.id as rfidetailid,
rfi_detail.rfi_detail_start_date,
rfi_detail.rfi_detail_end_date,
rfi_detail.rfi_detail_price_month,
rfi_detail.rfi_detail_price_year,
baks_bauk.id as baksbaukid,
baks_bauk.no_baks,
baks_bauk.date_baks,
baks_bauk.document_baks,
baks_bauk.document_wctr,
baks_bauk.document_boq_project,
baks_bauk.document_rfi_certificate, 
invoice.id as invoiceid,
invoice.tgl_mulai_sewa,
invoice.tgl_target_rfi,
invoice.document_boq_baps, 
invoice.tgL_akhir_sewa,
invoice.document_baps,
invoice.no_receive,
invoice.no_kontrak,
invoice.no_invoice,
invoice.tgl_invoice,
IFNULL((((LAST_DAY(project.batch_accrue) - rfi_detail.rfi_detail_start_date)/DAY(LAST_DAY(project.batch_accrue)) * rfi_detail.rfi_detail_price_month)),0) as nilai_revenue,
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
left join status  bqs on 
project.boq_status=bqs.id 
left join status  bqh on 
project.haki_status=bqh.id
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join rfi_baut on 
project.id=rfi_baut.project_id
left join fence_yard on 
project.id=fence_yard.project_id
left join rfi_detail on 
project.id=rfi_detail.project_id 
left join po on 
project.id=po.project_id  
left join baks_bauk on 
project.id=baks_bauk.project_id   
left join invoice on 
project.id=invoice.project_id  
where project.status_id IN (54,55);





CREATE OR REPLACE VIEW vallproject 
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
project.batch_accrue,
po.id as poid,
po.no_po,
po.po_date,
project.project_status_id,
status.detail as statusnya,
bqs.detail as statusnyaboq,
bqh.detail as statusnyahaki,
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
ifnull(document_rfc.target_rfi,0) as target_rfi,
ifnull(document_rfc.power_capacity,0) as power_capacity,
document_boq.id as documentboqid,
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
ifnull(document_boq.roof_top_high,0) as roof_top_high,
ifnull(document_boq.tower_high,0) as tower_high,
ifnull(document_boq.rf_in_meters,0) as rf_in_meters,
ifnull(document_boq.mw_in_meters,0) as mw_in_meters,
ifnull(document_boq.harga_bulan,0) as harga_bulan,
ifnull(document_boq.harga_tahun,0) as harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
fence_yard.id as fenceyardid,
fence_yard.fence_yard_date,
fence_yard.fence_yard_document,
rfi_baut.id as rfibautid,
rfi_baut.rfi_date,
rfi_baut.rfi_document,
rfi_baut.baut_date,
rfi_baut.baut_document,
rfi_detail.id as rfidetailid,
rfi_detail.rfi_detail_start_date,
rfi_detail.rfi_detail_end_date,
rfi_detail.rfi_detail_price_month,
rfi_detail.rfi_detail_price_year,
baks_bauk.id as baksbaukid,
baks_bauk.no_baks,
baks_bauk.date_baks,
baks_bauk.document_baks,
baks_bauk.document_wctr,
baks_bauk.document_boq_project,
baks_bauk.document_rfi_certificate, 
invoice.tgl_mulai_sewa,
invoice.tgl_target_rfi,
invoice.document_boq_baps, 
invoice.tgL_akhir_sewa,
invoice.document_baps,
invoice.id as invoiceid,
invoice.no_receive,
invoice.no_kontrak,
invoice.no_invoice,
invoice.tgl_invoice,
IFNULL(
ROUND(
(((datediff(LAST_DAY(project.batch_accrue), rfi_detail.rfi_detail_start_date))/DAY(LAST_DAY(project.batch_accrue)) * rfi_detail.rfi_detail_price_month))
,0)
,0) as nilai_revenue,

project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
left join status  bqs on 
project.boq_status=bqs.id 
left join status  bqh on 
project.haki_status=bqh.id
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join rfi_baut on 
project.id=rfi_baut.project_id
left join fence_yard on 
project.id=fence_yard.project_id
left join rfi_detail on 
project.id=rfi_detail.project_id 
left join po on 
project.id=po.project_id  
left join baks_bauk on 
project.id=baks_bauk.project_id   
left join invoice on 
project.id=invoice.project_id;




CREATE OR REPLACE VIEW vallprojectbyyears 
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
project.batch_accrue,
po.id as poid,
po.no_po,
po.po_date,
project.project_status_id,
status.detail as statusnya,
bqs.detail as statusnyaboq,
bqh.detail as statusnyahaki,
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
fence_yard.id as fenceyardid,
fence_yard.fence_yard_date,
fence_yard.fence_yard_document,
rfi_baut.id as rfibautid,
rfi_baut.rfi_date,
rfi_baut.rfi_document,
rfi_baut.baut_date,
rfi_baut.baut_document,
rfi_detail.id as rfidetailid,
rfi_detail.rfi_detail_start_date,
rfi_detail.rfi_detail_end_date,
rfi_detail.rfi_detail_price_month,
rfi_detail.rfi_detail_price_year,
baks_bauk.id as baksbaukid,
baks_bauk.no_baks,
baks_bauk.date_baks,
baks_bauk.document_baks,
baks_bauk.document_wctr,
baks_bauk.document_boq_project,
baks_bauk.document_rfi_certificate, 
invoice.tgl_mulai_sewa,
invoice.tgl_target_rfi,
invoice.document_boq_baps, 
invoice.tgL_akhir_sewa,
invoice.document_baps,
invoice.id as invoiceid,
invoice.no_receive,
invoice.no_kontrak,
invoice.no_invoice,
invoice.tgl_invoice,
IFNULL(
ROUND(
(((datediff(LAST_DAY(project.batch_accrue), rfi_detail.rfi_detail_start_date))/DAY(LAST_DAY(project.batch_accrue)) * rfi_detail.rfi_detail_price_month))
,0)
,0) as nilai_revenue,

project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
left join status  bqs on 
project.boq_status=bqs.id 
left join status  bqh on 
project.haki_status=bqh.id
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join rfi_baut on 
project.id=rfi_baut.project_id
left join fence_yard on 
project.id=fence_yard.project_id
left join rfi_detail on 
project.id=rfi_detail.project_id 
left join po on 
project.id=po.project_id  
left join baks_bauk on 
project.id=baks_bauk.project_id   
left join invoice on 
project.id=invoice.project_id 
  where project.years = YEAR(CURDATE()) ;






















delete

VIEW vsiteapprovedboqbapsadd  , VIEW vsiteapprovedbapsadd 



CREATE OR REPLACE VIEW vsiteapprovedbapsadd 
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
project.batch_accrue,
po.id as poid,
po.no_po,
po.po_date,
project.project_status_id,
status.detail as statusnya,
bqs.detail as statusnyaboq,
bqh.detail as statusnyahaki,
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
fence_yard.id as fenceyardid,
fence_yard.fence_yard_date,
fence_yard.fence_yard_document,
rfi_baut.id as rfibautid,
rfi_baut.rfi_date,
rfi_baut.rfi_document,
rfi_baut.baut_date,
rfi_baut.baut_document,
rfi_detail.id as rfidetailid,
rfi_detail.rfi_detail_start_date,
rfi_detail.rfi_detail_end_date,
rfi_detail.rfi_detail_price_month,
rfi_detail.rfi_detail_price_year,
baks_bauk.id as baksbaukid,
baks_bauk.no_baks,
baks_bauk.date_baks,
baks_bauk.document_baks,
baks_bauk.document_wctr,
baks_bauk.document_boq_project,
baks_bauk.document_rfi_certificate,
boq_baps.id as boqbapsid,
boq_baps.tgl_mulai_sewa,
boq_baps.tgl_target_rfi,
boq_baps.document_boq_baps,
baps.id as bapsid,
baps.tgL_akhir_sewa,
baps.document_baps,
IFNULL((((LAST_DAY(project.batch_accrue) - rfi_detail.rfi_detail_start_date)/DAY(LAST_DAY(project.batch_accrue)) * rfi_detail.rfi_detail_price_month)),0) as nilai_revenue,
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
left join status  bqs on 
project.boq_status=bqs.id 
left join status  bqh on 
project.haki_status=bqh.id
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join rfi_baut on 
project.id=rfi_baut.project_id
left join fence_yard on 
project.id=fence_yard.project_id
left join rfi_detail on 
project.id=rfi_detail.project_id 
left join po on 
project.id=po.project_id  
left join baks_bauk on 
project.id=baks_bauk.project_id  
left join boq_baps on 
project.id=boq_baps.project_id  
left join baps on 
project.id=baps.project_id  
where project.status_id=52;



CREATE OR REPLACE VIEW vsiteapprovedboqbapsadd 
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
project.batch_accrue,
po.id as poid,
po.no_po,
po.po_date,
project.project_status_id,
status.detail as statusnya,
bqs.detail as statusnyaboq,
bqh.detail as statusnyahaki,
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
CONCAT(document_boq.site_type, " ", document_boq.tower_high ," ", document_boq.tower_type) AS towernya,
document_boq.site_type,
document_boq.tower_type,
document_boq.roof_top_high,
document_boq.tower_high,
document_boq.rf_in_meters,
document_boq.mw_in_meters,
document_boq.harga_bulan,
document_boq.harga_tahun,
site_opening.id as siteopeningid,
site_opening.site_opening_date,
site_opening.document_site_opening,
excavation.id as excavationid,
excavation.excavation_date,
excavation.excavation_document,
rebaring.id as rebaringid,
rebaring.rebaring_date,
rebaring.rebaring_document,
pouring.id as pouringid,
pouring.pouring_date,
pouring.pouring_document,
curing.id as curingid,
curing.curing_date,
curing.curing_document,
tower_erection.id as towererectionid,
tower_erection.tower_erection_date,
tower_erection.tower_erection_document,
m_e_process.id as meprocessid,
m_e_process.m_e_process_date,
m_e_process.m_e_process_document,
fence_yard.id as fenceyardid,
fence_yard.fence_yard_date,
fence_yard.fence_yard_document,
rfi_baut.id as rfibautid,
rfi_baut.rfi_date,
rfi_baut.rfi_document,
rfi_baut.baut_date,
rfi_baut.baut_document,
rfi_detail.id as rfidetailid,
rfi_detail.rfi_detail_start_date,
rfi_detail.rfi_detail_end_date,
rfi_detail.rfi_detail_price_month,
rfi_detail.rfi_detail_price_year,
baks_bauk.id as baksbaukid,
baks_bauk.no_baks,
baks_bauk.date_baks,
baks_bauk.document_baks,
baks_bauk.document_wctr,
baks_bauk.document_boq_project,
baks_bauk.document_rfi_certificate,
boq_baps.id as boqbapsid,
boq_baps.tgl_mulai_sewa,
boq_baps.tgl_target_rfi,
boq_baps.document_boq_baps,
IFNULL((((LAST_DAY(project.batch_accrue) - rfi_detail.rfi_detail_start_date)/DAY(LAST_DAY(project.batch_accrue)) * rfi_detail.rfi_detail_price_month)),0) as nilai_revenue,
project.updated_at as created_at
FROM project 
left join status on 
project.status_id=status.id 
left join status  bqs on 
project.boq_status=bqs.id 
left join status  bqh on 
project.haki_status=bqh.id
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
left join site_opening on 
project.id=site_opening.project_id
left join excavation on 
project.id=excavation.project_id
left join rebaring on 
project.id=rebaring.project_id
left join pouring on 
project.id=pouring.project_id
left join curing on 
project.id=curing.project_id
left join tower_erection on 
project.id=tower_erection.project_id
left join m_e_process on 
project.id=m_e_process.project_id
left join rfi_baut on 
project.id=rfi_baut.project_id
left join fence_yard on 
project.id=fence_yard.project_id
left join rfi_detail on 
project.id=rfi_detail.project_id 
left join po on 
project.id=po.project_id  
left join baks_bauk on 
project.id=baks_bauk.project_id  
left join boq_baps on 
project.id=boq_baps.project_id 
where project.status_id=51; 