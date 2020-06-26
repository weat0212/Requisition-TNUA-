CREATE DATABASE FinalProject;

CREATE TABLE Applicant(
	applicant nvarchar(30),
	contact nvarchar(30),
	aplySupv nvarchar(30),
	address  nvarchar(50),
	phone  nvarchar(30),
	email  nvarchar(30),
	PRIMARY KEY(applicant)
)

CREATE TABLE Ordering(
	O_Id INT PRIMARY KEY IDENTITY,
	aplyDate  nvarchar(30),
	applicant  nvarchar(30) REFERENCES Applicant(applicant),
	facility  nvarchar(50),
	aplyfor  nvarchar(100),
	participant  nvarchar(30),
	record  nvarchar(30),
	stageTear   nvarchar(100),
	actContent  nvarchar(150),
	attachment  nvarchar(100),
	receipt nvarchar(30),
	taxId nvarchar(30),
)

CREATE TABLE Rentaltime(
	rentDate   nvarchar(30),
	rehearsalShow nvarchar(30),
	rentTime nvarchar(30),/*ª›¿À¨ddate*/
	O_Id INT REFERENCES Ordering(O_Id),
	PRIMARY KEY (rentDate, rehearsalShow,rentTime)
)

CREATE TABLE Margin(
	O_Id INT REFERENCES Ordering(O_Id),
	returnBank nvarchar(30),
	returnBranch nvarchar(30),
	returnAcc nvarchar(30),
	accName nvarchar(30),
	PRIMARY KEY (O_Id)
)





/*¿À¨d*/

SELECT * FROM	Applicant;
SELECT * FROM   Margin;
SELECT * FROM	Ordering;
SELECT * FROM	Rentaltime;

/*Del*/

/*Test*/
USE FinalProject 
GO 
EXEC sp_MSforeachtable @command1="ALTER TABLE ? NOCHECK CONSTRAINT ALL" 
GO
INSERT INTO dbo.Applicant(applicant,contact,aplySupv,address,phone,email) VALUES('123333','andy','aplySupv','address','phone','email')
/*SET IDENTITY_INSERT dbo.Applicant ON*/
INSERT INTO dbo.Ordering(aplyDate,applicant,facility,aplyfor,participant,record,stageTear,actContent,attachment,receipt,taxId) VALUES('aplyd','123333','12','123','12','Y','123','12','123','1','2')
USE FinalProject
GO 
EXEC sp_MSforeachtable @command1="ALTER TABLE ? WITH NOCHECK CHECK CONSTRAINT ALL" 
GO
