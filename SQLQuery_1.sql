/* Create database */
CREATE DATABASE SP;
GO

/* Change to the Music database */
USE SP;
GO

/* Create tables */
CREATE TABLE Project_Table (
    ProjectID int,
    Project_Details_Name varchar(255),
    Video_presentation_Name varchar(255),
    Project_Contract_Name varchar(255),
    Project_Details_Content varbinary(MAX),
    Video_presentation_Content varbinary(MAX),
    file_name varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    uploaded_on datetime NOT NULL,
    Project_Contract_Content varbinary(MAX)
) 
CREATE TABLE [dbo].[tblFiles](  
    [id] [int] IDENTITY(1,1) NOT NULL,  
    [Name] [varchar](50) NOT NULL,  
    [ContentType] [nvarchar](200) NOT NULL,  
    [Data] [varbinary](max) NOT NULL  
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
