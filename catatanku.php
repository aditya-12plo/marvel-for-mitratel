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


 



CREATE VIEW vjobcommunication 
AS
SELECT project_status.id,project_status.project_id,project_status.users_id,project_status.status,project_status.message,users_exist.name,users_exist.email,users_exist.level,users_exist.posisi,users_exist.area,users_exist.regional,project_status.created_at FROM project_status join users_exist on project_status.users_id=users_exist.id






