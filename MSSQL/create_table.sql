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
	rentTime nvarchar(30),/*需檢查date*/
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





/*檢查*/

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
INSERT INTO dbo.Applicant(applicant,contact,aplySupv,address,phone,email) VALUES('7','andy','aplySupv','address','phone','email')
/*SET IDENTITY_INSERT dbo.Applicant ON*/
INSERT INTO dbo.Ordering(aplyDate,applicant,facility,aplyfor,participant,record,stageTear,actContent,attachment,receipt,taxId) VALUES('2020-06-26','7','音樂廳','藝文展演活動','1','Y','2020-06-19T00:30','123','演出企劃書','123','123')
USE FinalProject
GO 
EXEC sp_MSforeachtable @command1="ALTER TABLE ? WITH NOCHECK CHECK CONSTRAINT ALL" 
GO
