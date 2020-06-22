CREATE TABLE Applicant(
	applyDate date,
	applicant nvarchar(30) PRIMARY KEY,
	applySupv  nvarchar(30),
	address  nvarchar(50),
	phone  nvarchar(30),
	email  nvarchar(30),
	receipt nvarchar(30) NULL,
	taxID  nvarchar(30) NULL
)

CREATE TABLE Margin(
	applicant nvarchar(30) REFERENCES Applicant(applicant) PRIMARY KEY,
	bankName  nvarchar(30),
	bankBranch  nvarchar(30),
	account  nvarchar(30),
	accountName  nvarchar(30)
)

CREATE TABLE Ordering(
	facility  nvarchar(30),
	activity  nvarchar(30),
	numofParts numeric,
	rentalDate date,
	record nvarchar(1),
	closeTime datetime2,
	actContent nvarchar(150),
	attachment nvarchar(30)
	PRIMARY KEY(facility, rentalDate)
)

CREATE TABLE Requisition(
	R_Id INT PRIMARY KEY IDENTITY,
	applyDate Date,
	applicant  nvarchar(30) REFERENCES Applicant(applicant),
	facility  nvarchar(30) /*REFERENCES Ordering(facility) ,*/,
	rentalDate date /*REFERENCES  Ordering(rentalDate)*/,
	CONSTRAINT PFK 
     FOREIGN KEY (facility, rentalDate) 
     REFERENCES Ordering(facility, rentalDate)
)

CREATE TABLE Showtime(
	facility  nvarchar(30) /*REFERENCES  Ordering(facility)*/,
	rentalDate date  /*REFERENCES  Ordering(rentalDate)*/,
	s_time  nvarchar(30) PRIMARY KEY,
	CONSTRAINT PFK2 
     FOREIGN KEY (facility, rentalDate) 
     REFERENCES Ordering(facility, rentalDate)
)

CREATE TABLE Rehearsal(
	facility  nvarchar(30) /*REFERENCES  Ordering(facility)*/,
	rentalDate date  /*REFERENCES  Ordering(rentalDate)*/,
	r_time  nvarchar(30) PRIMARY KEY,
	CONSTRAINT PFK3
     FOREIGN KEY (facility, rentalDate) 
     REFERENCES Ordering(facility, rentalDate)
)

