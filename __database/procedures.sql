DROP PROCEDURE IF EXISTS BookCreate;
CREATE PROCEDURE BookCreate (
    IN BookCategories       TINYTEXT,
    IN BookTitle            TINYTEXT,
    IN BookSubtitle         TINYTEXT,
    IN BookShowSubtitle     BOOL,
    IN BookAuthors          TEXT,
    IN BookPublicationYear  SMALLINT,
    IN BookISBN             TINYTEXT,
    IN BookPrice            FLOAT,
    IN BookDiscountPrice    FLOAT,
    IN BookWidth            SMALLINT,
    IN BookHeight           SMALLINT,
    IN BookBinding          TINYTEXT,
    IN BookPages            SMALLINT,
    IN BookDescription      TEXT,
    IN BookCover            TINYTEXT,
    IN BookIsInGallery      BOOL
)
BEGIN
    DECLARE TmpBookID       INT;
    DECLARE Categories      TEXT;
    DECLARE TmpCategoryID   INT;
    DECLARE Authors         TEXT;
    DECLARE CommaPos        INT;
    DECLARE TmpAuthorID     INT;

    IF EXISTS(SELECT IDBook FROM Book WHERE ISBN = BookISBN) THEN
        SET TmpBookID = (SELECT IDBook FROM Book WHERE ISBN = BookISBN);
    ELSE
        /* Dodavanje knjige */
        INSERT INTO Book (
            Title,
            Subtitle,
            ShowSubtitle,
            PublicationYear,
            ISBN,
            Price,
            DiscountPrice,
            BookFormatID,
            BindingID,
            Pages,
            Description,
            Cover,
            IsInGallery
        )
        VALUES (
            BookTitle,
            BookSubtitle,
            BookShowSubtitle,
            BookPublicationYear,
            BookISBN,
            BookPrice,
            BookDiscountPrice,
            GetFormatID(BookWidth, BookHeight),
            GetBindingID(BookBinding),
            BookPages,
            BookDescription,
            BookCover,
            BookIsInGallery
        );

        SET TmpBookID = LAST_INSERT_ID();

        /* Dodavanje kategorija */
        SET Categories = CONCAT(BookCategories, ',');

        WHILE (LENGTH(Categories) > 0) DO
            SET CommaPos = LOCATE(',', Categories);
            SET TmpCategoryID = GetCategoryID(SUBSTRING(Categories, 1, CommaPos-1));
            SET Categories = SUBSTRING(Categories, CommaPos+2);

            INSERT INTO BookCategory (BookID, CategoryID) VALUES (TmpBookID, TmpCategoryID);
        END WHILE;

        /* Dodavanje autora */
        SET Authors = CONCAT(BookAuthors, ',');

        WHILE (LENGTH(Authors) > 0) DO
            SET CommaPos = LOCATE(',', Authors);
            SET TmpAuthorID = GetAuthorID(SUBSTRING(Authors, 1, CommaPos-1));
            SET Authors = SUBSTRING(Authors, CommaPos+2);

            INSERT INTO BookAuthor (BookID, AuthorID) VALUES (TmpBookID, TmpAuthorID);
        END WHILE;
    END IF;
END;



DROP PROCEDURE IF EXISTS BookRead;
CREATE PROCEDURE BookRead (
    IN InBookID     INT UNSIGNED
)
BEGIN
    SELECT
        B.IDBook,
        B.Title,
        B.Subtitle,
        B.ShowSubtitle,
        B.PublicationYear,
        B.ISBN,
        B.Price,
        B.DiscountPrice,
        BF.Width,
        BF.Height,
        BI.Name Binding,
        B.Pages,
        B.Description,
        B.Cover,
        B.IsInGallery
    FROM Book B
    LEFT OUTER JOIN BookFormat AS BF
        ON BF.IDBookFormat = B.BookFormatID
    LEFT OUTER JOIN Binding AS BI
        ON BI.IDBinding = B.BindingID
    WHERE IDBook = InBookID;

    SELECT C.*
    FROM BookCategory BC
    INNER JOIN Category C
        ON C.IDCategory = BC.CategoryID
    WHERE BC.BookID = InBookID;

    SELECT A.*
    FROM BookAuthor BA
    INNER JOIN Author A
        ON A.IDAuthor = BA.AuthorID
    WHERE BA.BookID = InBookID;
END;



DROP PROCEDURE IF EXISTS BooksCount;
CREATE PROCEDURE BooksCount ()
BEGIN
    SELECT COUNT(*) Count FROM Book;
END;



DROP PROCEDURE IF EXISTS BooksRead;
CREATE PROCEDURE BooksRead (
    IN Start    INT,
    IN Number   INT
)
BEGIN
    SELECT
        B.IDBook,
        B.Title,
        B.Subtitle,
        B.ShowSubtitle,
        B.PublicationYear,
        B.ISBN,
        B.Price,
        B.DiscountPrice,
        BF.Width,
        BF.Height,
        BI.Name Binding,
        B.Description,
        B.Cover,
        B.IsInGallery
    FROM Book B
    LEFT OUTER JOIN BookFormat AS BF
        ON BF.IDBookFormat = B.BookFormatID
    LEFT OUTER JOIN Binding AS BI
        ON BI.IDBinding = B.BindingID
    ORDER BY B.IDBook DESC
    LIMIT Start, Number;
    /* Maybe there is problem with LIMIT in older versions of MySQL */
END;



DROP PROCEDURE IF EXISTS BookReadByCategory;
CREATE PROCEDURE BookReadByCategory (
    IN CategoryID   INT UNSIGNED
)
BEGIN
    SELECT
        BC.CategoryID,
        B.IDBook,
        B.Title,
        B.Subtitle,
        B.ShowSubtitle,
        B.PublicationYear,
        B.ISBN,
        B.Price,
        B.DiscountPrice,
        BF.Width,
        BF.Height,
        BI.Name Binding,
        B.Description,
        B.Pages,
        B.Cover,
        B.IsInGallery
    FROM Book B
    LEFT OUTER JOIN BookFormat AS BF
        ON BF.IDBookFormat = B.BookFormatID
    LEFT OUTER JOIN Binding AS BI
        ON BI.IDBinding = B.BindingID
    INNER JOIN BookCategory AS BC
        ON BC.BookID = B.IDBook
    WHERE BC.CategoryID = CategoryID;
END;



DROP PROCEDURE IF EXISTS BookUpdate;
CREATE PROCEDURE BookUpdate (
    IN InBookID             INT UNSIGNED,
    IN BookCategories       TINYTEXT,
    IN BookTitle            TINYTEXT,
    IN BookSubtitle         TINYTEXT,
    IN BookShowSubtitle     BOOL,
    IN BookAuthors          TEXT,
    IN BookPublicationYear  SMALLINT,
    IN BookISBN             TINYTEXT,
    IN BookPrice            FLOAT,
    IN BookDiscountPrice    FLOAT,
    IN BookWidth            SMALLINT,
    IN BookHeight           SMALLINT,
    IN BookBinding          TINYTEXT,
    IN BookPages            SMALLINT,
    IN BookDescription      TEXT,
    IN BookCover            TINYTEXT,
    IN BookIsInGallery      BOOL
)
BEGIN
    DECLARE Categories      TEXT;
    DECLARE TmpCategoryID   INT;
    DECLARE Authors         TEXT;
    DECLARE CommaPos        INT;
    DECLARE TmpAuthorID     INT;

    IF EXISTS(SELECT IDBook FROM Book WHERE IDBook = InBookID) THEN
        /* Uređivanje knjige */
        UPDATE Book
        SET
            Title = BookTitle,
            Subtitle = BookSubtitle,
            ShowSubtitle = BookShowSubtitle,
            PublicationYear = BookPublicationYear,
            ISBN = BookISBN,
            Price = BookPrice,
            DiscountPrice = BookDiscountPrice,
            BookFormatID = GetFormatID(BookWidth, BookHeight),
            BindingID = GetBindingID(BookBinding),
            Pages = BookPages,
            Description = BookDescription,
            Cover = BookCover,
            IsInGallery = BookIsInGallery
        WHERE IDBook = InBookID;

        /* Brisanje starih kategorija */
        DELETE
        FROM BookCategory
        WHERE BookID = InBookID;

        /* Dodavanje kategorija */
        SET Categories = CONCAT(BookCategories, ',');

        WHILE (LENGTH(Categories) > 0) DO
            SET CommaPos = LOCATE(',', Categories);
            SET TmpCategoryID = GetCategoryID(SUBSTRING(Categories, 1, CommaPos-1));
            SET Categories = SUBSTRING(Categories, CommaPos+2);

            INSERT INTO BookCategory (BookID, CategoryID) VALUES (InBookID, TmpCategoryID);
        END WHILE;

        /* Brisanje starih autora */
        DELETE
        FROM BookAuthor
        WHERE BookID = InBookID;

        /* Dodavanje autora */
        SET Authors = CONCAT(BookAuthors, ',');

        WHILE (LENGTH(Authors) > 0) DO
            SET CommaPos = LOCATE(',', Authors);
            SET TmpAuthorID = GetAuthorID(SUBSTRING(Authors, 1, CommaPos-1));
            SET Authors = SUBSTRING(Authors, CommaPos+2);

            INSERT INTO BookAuthor (BookID, AuthorID) VALUES (InBookID, TmpAuthorID);
        END WHILE;
    END IF;
END;



DROP PROCEDURE IF EXISTS BookDelete;
CREATE PROCEDURE BookDelete (
    IN BookID   INT UNSIGNED
)
BEGIN
    DELETE
    FROM Book
    WHERE IDBook = BookID;
END;



DROP PROCEDURE IF EXISTS BookFind;
CREATE PROCEDURE BookFind (
    IN FindText     TEXT
)
BEGIN
    DECLARE FindTextLike    TEXT;
    SET FindTextLike = CONCAT('%', FindText, '%');

    SELECT
        B.IDBook,
        B.Title,
        B.Subtitle,
        B.ShowSubtitle,
        B.PublicationYear,
        B.ISBN,
        B.Price,
        B.DiscountPrice,
        BF.Width,
        BF.Height,
        BI.Name Binding,
        B.Description,
        B.Cover,
        B.IsInGallery
    FROM Book B
    INNER JOIN BookFormat AS BF
        ON BF.IDBookFormat = B.BookFormatID
    INNER JOIN Binding AS BI
        ON BI.IDBinding = B.BindingID
    WHERE IDBook IN (
        SELECT DISTINCT
            B.IDBook
        FROM Book B
        INNER JOIN BookAuthor BA
            ON BA.BookID = B.IDBook
        INNER JOIN Author A
            ON A.IDAuthor = BA.AuthorID
        WHERE
            B.Title LIKE FindTextLike OR
            B.Subtitle LIKE FindTextLike OR
            B.Description LIKE FindTextLike OR
            A.Name LIKE FindTextLike
    );
END;



DROP PROCEDURE IF EXISTS BookReadCategories;
CREATE PROCEDURE BookReadCategories (
    IN InBookID   INT UNSIGNED
)
BEGIN
    SELECT
        C.*
    FROM BookCategory BC
    INNER JOIN Category C
        ON C.IDCategory = BC.CategoryID
    WHERE BookID = InBookID;
END;



DROP PROCEDURE IF EXISTS BookReadAuthors;
CREATE PROCEDURE BookReadAuthors (
    IN InBookID   INT UNSIGNED
)
BEGIN
    SELECT
        A.*
    FROM BookAuthor BA
    INNER JOIN Author A
        ON a.IDAuthor = BA.AuthorID
    WHERE BookID = InBookID;
END;



DROP PROCEDURE IF EXISTS CategoriesReadAll;
CREATE PROCEDURE CategoriesReadAll ()
BEGIN
    SELECT * FROM Category;
END;



DROP PROCEDURE IF EXISTS AuthorsReadAll;
CREATE PROCEDURE AuthorsReadAll ()
BEGIN
    SELECT * FROM Author;
END;



DROP PROCEDURE IF EXISTS NoticeCreate;
CREATE PROCEDURE NoticeCreate (
    NoticeTitle       TINYTEXT,
    NoticeText        TEXT,
    NoticeIsPinned    BOOL
)
BEGIN
    INSERT INTO Notice
    (
        Title,
        Text,
        IsPinned
    )
    VALUES
    (
        NoticeTitle,
        NoticeText,
        NoticeIsPinned
    );
END;



DROP PROCEDURE IF EXISTS NoticeRead;
CREATE PROCEDURE NoticeRead (
    NoticeID    INT UNSIGNED
)
BEGIN
    SELECT * FROM Notice WHERE IDNotice = NoticeID;
END;



DROP PROCEDURE IF EXISTS NoticeUpdate;
CREATE PROCEDURE NoticeUpdate (
    NoticeID        INT UNSIGNED,
    NoticeTitle     TINYTEXT,
    NoticeText      TEXT,
    NoticeIsPinned  BOOL
)
BEGIN
    UPDATE Notice
    SET
        Title = NoticeTitle,
        Text = NoticeText,
        IsPinned = NoticeIsPinned
    WHERE IDNotice = NoticeID;
END;



DROP PROCEDURE IF EXISTS NoticeDelete;
CREATE PROCEDURE NoticeDelete (
    NoticeID    INT UNSIGNED
)
BEGIN
    DELETE
    FROM Notice
    WHERE IDNotice = NoticeID;
END;



DROP PROCEDURE IF EXISTS NoticesRead;
CREATE PROCEDURE NoticesRead (
    IN Start    INT,
    IN Number   INT
)
BEGIN
    SELECT *
    FROM Notice
    ORDER BY Time DESC
    LIMIT Start, Number;
    /* Maybe there is problem with LIMIT in older versions of MySQL */
END;



DROP PROCEDURE IF EXISTS NoticesReadUnpinned;
CREATE PROCEDURE NoticesReadUnpinned (
    IN Start    INT,
    IN Number   INT
)
BEGIN
    SELECT *
    FROM Notice
    WHERE IsPinned = False
    ORDER BY Time DESC
    LIMIT Start, Number;
    /* Maybe there is problem with LIMIT in older versions of MySQL */
END;



DROP PROCEDURE IF EXISTS NoticesReadPinned;
CREATE PROCEDURE NoticesReadPinned (
    IN Start    INT,
    IN Number   INT
)
BEGIN
    SELECT *
    FROM Notice
    WHERE IsPinned = True
    ORDER BY Time DESC
    LIMIT Start, Number;
    /* Maybe there is problem with LIMIT in older versions of MySQL */
END;



DROP PROCEDURE IF EXISTS NoticesCount;
CREATE PROCEDURE NoticesCount ()
BEGIN
    SELECT COUNT(*) Count FROM Notice;
END;

