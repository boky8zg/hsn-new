DROP FUNCTION IF EXISTS GetCategoryID;
CREATE FUNCTION GetCategoryID (
    BookCategory    TINYTEXT
)
RETURNS INT UNSIGNED
NOT DETERMINISTIC
BEGIN
    DECLARE CategoryID  INT UNSIGNED;

    IF EXISTS(SELECT IDCategory FROM Category WHERE Name = BookCategory) THEN
        RETURN (SELECT IDCategory FROM Category WHERE Name = BookCategory);
    ELSE
        INSERT INTO Category (Name) VALUES (BookCategory);
        RETURN LAST_INSERT_ID();
    END IF;
END;



DROP FUNCTION IF EXISTS GetFormatID;
CREATE FUNCTION GetFormatID (
    BookWidth   INT,
    BookHeight  INT
)
RETURNS INT UNSIGNED
NOT DETERMINISTIC
BEGIN
    DECLARE FormatID  INT UNSIGNED;

    IF EXISTS(SELECT IDBookFormat FROM BookFormat WHERE Width = BookWidth AND Height = BookHeight) THEN
        RETURN (SELECT IDBookFormat FROM BookFormat WHERE Width = BookWidth AND Height = BookHeight);
    ELSE
        INSERT INTO BookFormat (Width, Height) VALUES (BookWidth, BookHeight);
        RETURN LAST_INSERT_ID();
    END IF;
END;



DROP FUNCTION IF EXISTS GetBindingID;
CREATE FUNCTION GetBindingID (
    BookBinding TINYTEXT
)
RETURNS INT UNSIGNED
NOT DETERMINISTIC
BEGIN
    DECLARE BindingID   INT UNSIGNED;

    IF (ISNULL(BookBinding)) THEN
        RETURN NULL;
    END IF;

    IF EXISTS(SELECT IDBinding FROM Binding WHERE Name = BookBinding) THEN
        RETURN (SELECT IDBinding FROM Binding WHERE Name = BookBinding);
    ELSE
        INSERT INTO Binding (Name) VALUES (BookBinding);
        RETURN LAST_INSERT_ID();
    END IF;
END;



DROP FUNCTION IF EXISTS GetCategoryID;
CREATE FUNCTION GetCategoryID (
    BookCategory    TINYTEXT
)
RETURNS INT UNSIGNED
NOT DETERMINISTIC
BEGIN
    DECLARE CategoryID  INT UNSIGNED;

    IF EXISTS(SELECT IDCategory FROM Category WHERE Name = BookCategory) THEN
        RETURN (SELECT IDCategory FROM Category WHERE Name = BookCategory);
    ELSE
        INSERT INTO Category (Name) VALUES (BookCategory);
        RETURN LAST_INSERT_ID();
    END IF;
END;



DROP FUNCTION IF EXISTS GetAuthorID;
CREATE FUNCTION GetAuthorID (
    BookAuthor  TINYTEXT
)
RETURNS INT UNSIGNED
NOT DETERMINISTIC
BEGIN
    DECLARE AuthorID    INT UNSIGNED;

    IF EXISTS(SELECT IDAuthor FROM Author WHERE Name = BookAuthor) THEN
        RETURN (SELECT IDAuthor FROM Author WHERE Name = BookAuthor);
    ELSE
        INSERT INTO Author (Name) VALUES (BookAuthor);
        RETURN LAST_INSERT_ID();
    END IF;
END;


