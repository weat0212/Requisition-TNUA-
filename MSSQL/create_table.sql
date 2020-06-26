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

CREATE TABLE Rentaltime(
	rentDate date PRIMARY KEY,
	rehearsalShow nvarchar(30),
	rentTime date, /*ª›¿À¨ddate*/
)

CREATE TABLE Ordering(
	O_Id INT PRIMARY KEY IDENTITY,
	aplyDate date,
	applicant  nvarchar(30) REFERENCES Applicant(applicant),
	facility  nvarchar(30),
	aplyfor  nvarchar(30),
	rentDate date REFERENCES Rentaltime(rentDate),
	participant  nvarchar(30),
	record  nvarchar(1),
	stageTear  nvarchar(30),
	actContent  nvarchar(150),
	attachment  nvarchar(30),
	receipt nvarchar(30),
	taxId nvarchar(30),
)

CREATE TABLE Margin(
	O_Id INT REFERENCES Ordering(O_Id),
	returnBank nvarchar(30),
	returnBranch nvarchar(30),
	returnAcc nvarchar(30),
	PRIMARY KEY (O_Id)
)





/*¿À¨d*/

SELECT * FROM	Applicant;
SELECT * FROM   Margin;
SELECT * FROM	Ordering;
SELECT * FROM	Rentaltime;

