-- auto-generated definition
create table passage_periodes
(
	id bigint not null identity
		primary key,
	passage_id int not null,
	libelle varchar(100) not null,
	type_pied varchar(1) not null,
	type_periode varchar(30) not null,
	date_debut varchar(30) not null,
	date_fin varchar(30) default NULL,
	date_creation varchar(30) default NULL,
	date_modification varchar(30) default NULL,
	date_suppression varchar(30) default NULL,
	id_supp int default 0,
	id_enregistrement int not null,
	id_modification int default NULL,
	id_suppression int default NULL,
	campagne varchar(20),
	supp int default 0,
	activev int default 0,
	nump int
)
go

create table tb_agent
(
	matricule varchar(30),
	nom varchar(30) default '0' not null,
	prenoms varchar(100) default '0' not null,
	contact varchar(36) default '0',
	photo varchar(50) default '0',
	numero_cni varchar(30) default NULL,
	fonction varchar(30) default NULL,
	date_creation varchar(30),
	est_admin int default 0,
	est_agent int default 0,
	est_dg int default 0,
	est_dr int default 0,
	active int default 1,
	id_supp int default 0,
	id_creation int not null,
	id_modification int,
	date_modification varchar(30),
	date_suppression varchar(30),
	delegation_code varchar(50),
	login varchar(300),
	email varchar(130),
	id int not null identity
		primary key
)
go
-- auto-generated definition
create table tb_comptage_cacao
(
	idpassage int not null
		constraint FK_comptagecacao2_tbpassage
			references tb_passage,
	fruit_a int,
	fruit_b int,
	fruit_c int,
	fruit_d int,
	pertes_a int,
	pertes_b int,
	aspect_a text,
	aspect_b text,
	aspect_c text,
	fe int,
	flo int,
	pese_f float,
	Noue int,
	Production_oct_mars float,
	Production_avril_sept float,
	supp int,
	date_suppression datetime,
	id_supp int default 0,
	id_modification int,
	date_creation datetime,
	date_modification datetime,
	posX varchar(30),
	posY varchar(30),
	pied_code varchar(50)
		constraint FK_comptagecacao2_pied
			references tb_pied,
	parcelle_code varchar(50),
	raison_supp text,
	an_campagne varchar(15),
	id int not null identity
		constraint comptagecacao2_id_pk
			primary key,
	village_code varchar(50),
	aspect_d text,
	agent_id int,
	active int,
	uuid char(32),
	code_del varchar(30),
	code_dep varchar(20)
)
go

-- auto-generated definition
create table tb_comptage_cacao_non
(
	idpassage int not null,
	fruit_a int,
	fruit_b int,
	fruit_c int,
	fruit_d int,
	pertes_a int,
	pertes_b int,
	aspect_a text,
	aspect_b text,
	aspect_c text,
	fe int,
	flo int,
	pese_f float,
	Noue int,
	Production_oct_mars float,
	Production_avril_sept float,
	supp int,
	date_suppression datetime,
	id_supp int default 0,
	id_modification int,
	date_creation datetime,
	date_modification datetime,
	posX varchar(30),
	posY varchar(30),
	pied_code varchar(50),
	parcelle_code varchar(50),
	raison_supp text,
	an_campagne varchar(15),
	id int not null identity
		constraint comptagecacaonon_id_pk
			primary key,
	village_code varchar(50),
	aspect_d text,
	agent_id int,
	active int,
	uuid char(32),
	code_del varchar(30),
	code_dep varchar(20)
)
go

-- auto-generated definition
create table tb_comptage_cafe
(
	idpassage int not null
		constraint FK_comptagecafe_tbpassage
			references tb_passage,
	grappe int,
	fruit int,
	Fe int,
	Flo int,
	peseF int,
	Noue int,
	observation text,
	production_oct_mars float,
	production_avril_sept float,
	supp int,
	agent_id int,
	date_suppression datetime,
	id_supp int default 0,
	id_modification int,
	date_creation datetime,
	date_modification datetime,
	posX varchar(30),
	posY varchar(30),
	pied_code varchar(50)
		constraint FK_comptagecafe_pied
			references tb_pied,
	parcelle_code varchar(50)
		constraint FK_comptagecafe_parcelle
			references tb_parcelle,
	village_code varchar(50),
	raison_supp text,
	an_campagne varchar(15),
	id int not null identity
		primary key
)
go

-- auto-generated definition
create table tb_delegation
(
	id int not null,
	code_delegation varchar(50) not null
		constraint PK_tbdelegation
			primary key,
	designation varchar(50) default NULL,
	datecrea datetime default NULL,
	identifient varchar(30),
	secret varchar(125),
	active int default 1
)
go

-- auto-generated definition
create table tb_departement
(
	code_departement varchar(50) not null
		constraint PK_tbdepartement
			primary key,
	designation varchar(50) default NULL,
	delegation_code varchar(50) default NULL,
	id int not null identity,
	datecrea varchar(50),
	uuid char(32),
	statut int,
	id_supp int,
	id_modification int,
	id_enregistrement int,
	date_creation datetime,
	date_modification datetime,
	date_destruction datetime,
	date_suppression datetime
)
go

-- auto-generated definition
create table tb_histo_agent
(
	id int not null,
	matricule varchar(15) not null
		constraint PK_tb_histo_agent
			primary key,
	id_agent int,
	nom varchar(30) default '0' not null,
	prenoms varchar(100) default '0' not null,
	contact varchar(36) default '0',
	photo varchar(50) default '0',
	numero_cni varchar(30) default NULL,
	fonction varchar(30) default NULL,
	date_creation datetime default NULL,
	est_admin int default 0,
	est_agent int default 0,
	est_dg int default 0,
	est_dr int default 0,
	active int default 1,
	id_supp int default 0,
	id_creation int not null,
	id_modification int,
	date_modification datetime,
	date_suppression datetime,
	delegation_code varchar(50)
)
go

-- auto-generated definition
create table tb_parcelle
(
	code_parcelle varchar(50) not null
		constraint PK_parcelle
			primary key,
	delegation_code varchar(50) default NULL
		constraint FK_parcelle_tbdelegation
			references tb_delegation,
	code_sous_prefecture varchar(50) default NULL
		constraint FK_parcelle_tbsousprefecture
			references tb_sousprefecture,
	village_code varchar(50) default NULL
		constraint FK_parcelle_tbvillage
			references tb_village,
	type_plantation varchar(50) default NULL,
	departement_code varchar(50) default NULL
		constraint FK_parcelle_tbdepartement
			references tb_departement,
	nom_parcelle varchar(50) default NULL,
	etat_parcelle int default NULL,
	mode_aquisition varchar(50) default NULL,
	date_creation varchar(50),
	id_enregistrement varchar(50) default NULL,
	date_suppression datetime default NULL,
	date_destruction datetime default NULL,
	date_modification datetime default NULL,
	code_prod varchar(15)
		constraint FK_parcelle_tbproducteur
			references tb_producteur,
	id int not null identity,
	variete varchar(50),
	superficie varchar(6),
	production_annuelle varchar(10),
	annnee_creation int,
	observation_variete text,
	parcelleeliminer varchar(100),
	id_supp int,
	id_modification int,
	active int,
	supp int,
	dateenr varchar(50),
	long varchar(20),
	lat varchar(20)
)
go

-- auto-generated definition
create table tb_passage
(
	id int not null
		constraint PK_tbpassage
			primary key,
	libelle varchar(50) default '0' not null,
	periode varchar(50) default '0' not null,
	type_pied varchar(6) not null,
	date_enregistrement datetime default NULL,
	date_suppression datetime default NULL,
	date_modification datetime default NULL,
	date_destruction datetime default NULL,
	id_enregistrement int default NULL,
	id_modification int default NULL,
	id_suppression int default NULL,
	id1 int not null identity,
	type_periode varchar(20),
	supp int
)
go

-- auto-generated definition
create table tb_pied
(
	code_pied varchar(50) not null
		constraint PK_pied
			primary key,
	numero_pied varchar(50) default NULL,
	type_pied varchar(5) default NULL,
	date_creation datetime default NULL,
	date_modification datetime default NULL,
	date_suppression datetime default NULL,
	id_suppression int default NULL,
	id_modification int default NULL,
	id_enregistrement int default NULL,
	id int not null identity,
	etat_pied int default 0,
	couleur varchar(10),
	special int default 0
)
go

-- auto-generated definition
create table tb_producteur
(
	code_producteur varchar(15) not null
		constraint PK_tbproducteur
			primary key,
	nom varchar(100) not null,
	date_de_naissance varchar(50),
	lieu_de_naissance varchar(50) default '',
	genre varchar(10) default '',
	numero_piece varchar(50) default '0',
	contact varchar(50) default '0',
	email varchar(50) default '0',
	active int default '0' not null,
	supp int default '0' not null,
	adresse_postale varchar(50) default NULL,
	date_modification varchar(50),
	date_creation varchar(50),
	date_suppression varchar(50),
	id_supp int default NULL,
	id_creation int default NULL,
	id_modification int default NULL,
	taille varchar(10),
	pointure varchar(10),
	type_piece varchar(50),
	nationalite varchar(30),
	cel varchar(60),
	id int not null identity,
	uuid char(32)
)
go

-- auto-generated definition
create table tb_sousprefecture
(
	code_sous_prefecture varchar(50) not null
		constraint PK_tbsousprefecture
			primary key,
	designation varchar(50) default NULL,
	datecrea varchar(50) default NULL,
	departement_code varchar(50) default NULL,
	id int not null identity,
	supp int,
	id_supp int,
	id_modification int,
	id_enregistrement int,
	date_creation datetime,
	date_modification datetime,
	date_destruction datetime,
	date_suppression datetime
)
go

-- auto-generated definition
create table tb_village
(
	code_village varchar(50) not null
		constraint PK_tbvillage
			primary key,
	designation varchar(50) default NULL,
	sous_prefecture_code varchar(50) default NULL,
	id int not null identity,
	supp int,
	id_supp int,
	id_modification int,
	id_enregistrement int,
	date_modification datetime,
	date_destruction datetime,
	date_suppression datetime,
	uuid char(32),
	date_creation datetime
)
go
-- auto-generated definition
create table tbconnexion
(
	compte_id bigint,
	date_connexion datetime2,
	statut int default NULL,
	id int not null identity
)
go


