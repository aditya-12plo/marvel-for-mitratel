lanjutkan dokumen DRM





level
'ADMINISTRATOR','REGIONAL','HQ'


posisi
'AM SUPPORT','ACCOUNT MANAGER','MANAGER MARKETING','MANAGER'













/*   VIEW    */

CREATE VIEW vusersregional 
AS
SELECT * FROM users where level = 'REGIONAL'





CREATE VIEW vjobsdocumentsis 
AS
SELECT project.id,project.projectid,project.no_wo,project.wo_date,project.batch,project.years,project.infratype,project.area,project.regional,project.site_id_spk,project.site_name_spk,project.address_spk,project.longitude_spk,project.latitude_spk,project.status_id,project.project_status_id,status.detail as statusnya,project.created_at FROM project join status on project.status_id=status.id where project.status_id = '1'


CREATE VIEW vjobsdocumentsisrevisi 
AS
SELECT project.id,project.projectid,project.no_wo,project.wo_date,project.batch,project.years,project.infratype,project.area,project.regional,project.site_id_spk,project.site_name_spk,project.address_spk,project.longitude_spk,project.latitude_spk,project.status_id,project.project_status_id,status.detail as statusnya,document_sis.id as documentsisid,document_sis.document_sis,project.updated_at as created_at FROM project join status on project.status_id=status.id join document_sis on project.id=document_sis.project_id where project.status_id = '3'



CREATE VIEW vjobsapprovaldocumentsis 
AS
SELECT project.id,project.projectid,project.no_wo,project.wo_date,project.batch,project.years,project.infratype,project.area,project.regional,project.site_id_spk,project.site_name_spk,project.address_spk,project.longitude_spk,project.latitude_spk,project.status_id,project.project_status_id,status.detail as statusnya,document_sis.id as documentid,document_sis.document_sis,document_sis.created_at FROM project join status on project.status_id=status.id join document_sis on project.id=document_sis.project_id where project.status_id = '2'


CREATE VIEW vjobsdocumentdrm 
AS
SELECT 
project.id,
project.projectid,
project.no_wo,
project.wo_date,
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






