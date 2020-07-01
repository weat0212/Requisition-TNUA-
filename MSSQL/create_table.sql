CREATE DATABASE FinalProject;

CREATE TABLE Applicant(
	applicant nvarchar(30),
	contact nvarchar(30),
	aplySupv nvarchar(30),
	address  nvarchar(50),
	phone  nvarchar(30),
	email  nvarchar(50),
	PRIMARY KEY(applicant)
)

CREATE TABLE Ordering(
	O_Id INT IDENTITY  PRIMARY KEY , 
	aplyDate nvarchar(30),
	applicant  nvarchar(30) REFERENCES Applicant(applicant),
	aplyfor  nvarchar(30),
	participant  INT,
	record  nvarchar(10),
	stageTear   nvarchar(50),
	actContent  nvarchar(150),
	attachment  nvarchar(30),
	receipt nvarchar(30),
	taxId nvarchar(30),
	returnBank nvarchar(50),
	returnBranch nvarchar(50),
	returnAcc nvarchar(50),
	accName nvarchar(50)
)

CREATE TABLE Rentaltime(
	facility  nvarchar(10),	
	rentDate   nvarchar(30),
	rehearsalShow nvarchar(30),
	rentTime nvarchar(30), 
	O_Id INT,
	PRIMARY KEY (facility,rentDate, rehearsalShow,rentTime)
)

ALTER TABLE Rentaltime
ADD FOREIGN KEY (O_Id) REFERENCES Ordering (O_Id);





/*檢查*/

SELECT * FROM	Applicant;
/*SELECT * FROM   Margin;*/
SELECT * FROM	Ordering;
SELECT * FROM	Rentaltime;

/*Del*/

/*Test*/

DBCC CHECKIDENT('Ordering',NORESEED);
GO


USE FinalProject 
GO 
EXEC sp_MSforeachtable @command1="ALTER TABLE ? NOCHECK CONSTRAINT ALL" 
GO
SET IDENTITY_INSERT dbo.Ordering ON;

INSERT INTO dbo.Applicant(applicant,contact,aplySupv,address,phone,email) VALUES('7','andy','aplySupv','address','phone','email')
INSERT INTO dbo.Ordering(aplyDate,applicant,facility,aplyfor,participant,record,stageTear,actContent,attachment,receipt,taxId) VALUES('2020-06-26','7','音樂廳','藝文展演活動','1','Y','2020-06-19T00:30','123','演出企劃書','123','123')

USE FinalProject
GO 
EXEC sp_MSforeachtable @command1="ALTER TABLE ? WITH NOCHECK CHECK CONSTRAINT ALL" 
GO

SET IDENTITY_INSERT dbo.Ordering OFF;

