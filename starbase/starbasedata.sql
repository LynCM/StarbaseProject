# SQL-Front 5.1  (Build 4.16)

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE */;
/*!40101 SET SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES */;
/*!40103 SET SQL_NOTES='ON' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS */;


# Host: localhost    Database: starbase
# ------------------------------------------------------
# Server version 5.0.51b-community-nt-log

DROP DATABASE IF EXISTS `starbase`;
CREATE DATABASE `starbase` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `starbase`;

SET FOREIGN_KEY_CHECKS=1;

#
# Source for table users
#

Create Table If Not Exists Spacecraft(
	Spacecraft_ID		Integer NOT NULL AUTO_INCREMENT,
	Name				Varchar(100) UNIQUE,
	Tonnage				Integer,
	Max_Occupancy		Integer,
	Constraint Spacecraft_PK Primary Key(Spacecraft_ID)
);

Create Table If Not Exists Person(
	PID						Integer AUTO_INCREMENT,
	Username			Varchar(30) UNIQUE,
	First_Name				Varchar(100),
	Last_Name				Varchar(100),
	Password				Varchar(30),
	Type					Varchar(100),
	Constraint Person_PK Primary Key(PID)
);
Create Table If Not Exists Location(
	Name					Varchar(100),
	x						Integer,
	y						Integer,
	z						Integer,
	Constraint Location_PK Primary Key(Name)
);
Create Table If Not Exists Manufacturers(
	Spacecraft_ID			Integer NOT NULL,
	Manufacturer_Name		Varchar(100),
	Constraint Manufacturers_PK Primary Key(Spacecraft_ID, Manufacturer_Name),
	Constraint Manufacturers_Spacecraft_FK Foreign Key(Spacecraft_ID) References Spacecraft(Spacecraft_ID)
);
Create Table If Not Exists Module(
	Spacecraft_ID			Integer,
	Module_ID				Varchar(100),
	Constraint Module_PK Primary Key(Spacecraft_ID, Module_ID),
	Constraint Module_FK Foreign Key(Spacecraft_ID) References Spacecraft(Spacecraft_ID)
);
Create Table If Not Exists Spaceship(
	Spacecraft_ID			Integer,
	Model					Varchar(100),
	Role					Varchar(100),
	Station_Docked_At		Varchar(100),
	Constraint Spaceship_PK Primary Key(Spacecraft_ID),
	Constraint Spaceship_FK Foreign Key(Spacecraft_ID) References Spacecraft(Spacecraft_ID)
);

Create Table If Not Exists Cargo(
	Cargo_ID				Integer AUTO_INCREMENT,
	Mass					Integer,
	Is_Dangerous			Boolean,
	Description				Varchar(10000),
	Spacecraft_ID			Integer,
	Owner_PID				Integer,
	Constraint Cargo_PK Primary Key(Cargo_ID),
	Constraint Cargo_Spacecraft_FK Foreign Key(Spacecraft_ID) References Spacecraft(Spacecraft_ID),
	Constraint Cargo_Owner_FK Foreign Key(Owner_PID) References Person(PID)
);

Create Table If Not Exists Crew_Member(
	PID						Integer,
	Role					Varchar(100),
	Assigned_Spacecraft		Integer,
	Constraint Crew_Member_PK Primary Key(PID),
	Constraint Crew_Member_Craft_FK Foreign Key(Assigned_Spacecraft) References Spaceship(Spacecraft_ID),
	Constraint Crew_Member_FK Foreign Key(PID) References Person(PID)

);
Create Table If Not Exists Contact_Number(
	PID						Integer,
	Contact_Number			Integer,
	Constraint Contact_Number_PK Primary Key(PID, Contact_Number),
	Constraint Contact_Number_FK Foreign Key(PID) References Person(PID)
);
Create Table If Not Exists Flight_Plan(
	Spacecraft_ID			Integer,
	Start_Time				Timestamp NOT NULL UNIQUE,
	End_Time				Timestamp NOT NULL UNIQUE,
	Budget					Real,
	Start_Location			Varchar(100),
	Destination				Varchar(100),
	Constraint Flight_Plan_PK Primary Key(Spacecraft_ID, Start_Time, End_Time),

	Constraint Flight_Plan_Spaceship_FK Foreign Key(Spacecraft_ID) References Spaceship(Spacecraft_ID),
	Constraint Flight_Plan_Start_Location_FK Foreign Key (Start_Location) References Location(Name),
	Constraint Flight_Plan_Destination_FK Foreign Key(Destination) References Location(Name)

);

Create Table If Not Exists Celestial_Body(
	Location_Name			Varchar(100),
	Radius					Real,
	Mass					Real,
	Constraint Celestial_Body_PK Primary Key(Location_Name),
	Constraint Celestial_Body_FK Foreign Key(Location_Name) References Location(Name)
);

Create Table If Not Exists Space_Station(
	Location_Name			Varchar(100),
	Spacecraft_ID			Integer,
	Orbits_Celestial_Body	Varchar(100),
	Constraint Space_Station_PK Primary Key(Location_Name, Spacecraft_ID),
	Constraint Space_Station_Craft_FK Foreign Key(Spacecraft_ID) References Spacecraft(Spacecraft_ID),
	Constraint Space_Station_Orbit_FK Foreign Key(Orbits_Celestial_Body) References Location(Name),
	Constraint Space_Station_Location_FK Foreign Key(Location_Name) References Location(Name)

);
Create Table If Not Exists Guided_By(
	Spacecraft_ID			Integer,
	Ground_Control_PID		Integer,
	Constraint Guided_By_PK Primary Key(Spacecraft_ID, Ground_Control_PID),
	Constraint Guided_By_Craft_FK Foreign Key(Spacecraft_ID) References Spaceship(Spacecraft_ID),
	Constraint Guided_By_PID_FK Foreign Key(Ground_Control_PID) References Person(PID)
);

Create Table If Not Exists Planned_By(
	Spacecraft_ID			Integer,
	Flight_Plan_Start_Time	Timestamp NOT NULL UNIQUE,
	Flight_Plan_End_Time	Timestamp NOT NULL UNIQUE,
	Ground_Control_PID		Integer,
	Constraint Planned_By_PK Primary Key(Spacecraft_ID, Flight_Plan_Start_Time, Flight_Plan_End_Time, Ground_Control_PID),
	Constraint Planned_By_Craft_FK Foreign Key(Spacecraft_ID) References Spacecraft(Spacecraft_ID),
	Constraint Planned_By_Start_Time_FK Foreign Key(Flight_Plan_Start_Time) References Flight_Plan(Start_Time),
	Constraint Planned_By_End_Time_FK Foreign Key(Flight_Plan_End_Time) References Flight_Plan(End_Time),
	Constraint Planned_By_PID_FK Foreign Key(Ground_Control_PID) References Person(PID)
);

Create Table If Not Exists Transports(
	Spacecraft_ID			Integer,
	Flight_Plan_Start_Time	Timestamp NOT NULL UNIQUE,
	Flight_Plan_End_Time	Timestamp NOT NULL UNIQUE,
	Client_PID				Integer,
	Seat_No					Integer,
	Constraint Transports_PK Primary Key(Spacecraft_ID, Flight_Plan_Start_Time, Flight_Plan_End_Time, Client_PID),
	Constraint Transports_Craft_FK Foreign Key(Spacecraft_ID) References Spaceship(Spacecraft_ID),
	Constraint Transports_Flight_Start_FK Foreign Key(Flight_Plan_Start_Time) References Flight_Plan(Start_Time),
	Constraint Transports_Flight_End_FK Foreign Key(Flight_Plan_End_Time) References Flight_Plan(End_Time),
	Constraint Transports_Client_PK Foreign Key(Client_PID) References Person(PID)
);

#
# Initial data population
#

INSERT INTO Person (First_Name, Last_Name, Username, Password, Type) Values
('Celina', 'Ma', 'LynCM', 'admin', 'Ground Control'),
('Super', 'User', 'Admin', 'admin', 'Ground Control'),
('Captain', 'Holt', 'TheCaptain', 'admin', 'Crew');


INSERT INTO Spacecraft (Name, Tonnage, Max_Occupancy) Values
('ImAShip', 1000, 50),
('AlsoAShip', 2000, 80);

INSERT INTO Spaceship Values
(1, 'SomeModel', 'Touring', NULL);

INSERT INTO Crew_Member Values
(3, 'Captain', 1);

INSERT INTO Manufacturers Values
(1, 'MakeCraft'),
(2, 'StarParts');

INSERT INTO Location Values
('Earth', 50, 50, 50),
('Mars', 80, 80, 80);

INSERT INTO Flight_Plan Values
(1, '2019-04-15 15-00-00', '2019-04-18 18-00-00', 5000, 'Earth', 'Mars');


#
# Dumping data for table users
#

/* not sure what this part was for yet in the original file */

/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
