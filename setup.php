<?php
  require_once "login.php";

  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error)
      die($conn->connect_error);

  $query = "CREATE TABLE classics (
  author VARCHAR(128),
  title VARCHAR(128),
  category VARCHAR(16),
  year INT,
  isbn CHAR(13),
  INDEX(author(20)),
  INDEX(category(4)),
  PRIMARY KEY (isbn)) ENGINE=INNODB;";

  $result = $conn->query($query);
  if (!$result)
      die($conn->error);


  // Starts insertion
  $query = "INSERT INTO classics (author, title, category, year, isbn)
   VALUES ('Mark Twain','The Adventures of Tom Sawyer','Fiction','1876','9781598184891')";

  $result = $conn->query($query);
  if (!$result)
     die($conn->error);

  $query = "INSERT INTO classics (author, title, category, year, isbn)
   VALUES ('Jane Austen','Pride and Prejudice','Fiction','1811','9780582506206')";

  $result = $conn->query($query);
  if (!$result)
     die($conn->error);

  $query = "INSERT INTO classics (author, title, category, year, isbn)
   VALUES ('Charles Darwin','The Origin of Species','Non-Fiction','1856','9780517123201')";

  $result = $conn->query($query);
  if (!$result)
     die($conn->error);

  $query = "INSERT INTO classics (author, title, category, year, isbn)
   VALUES ('Charles Dickens','The Old Curiosity Shop','Fiction','1841','9780099533474')";

  $result = $conn->query($query);
  if (!$result)
     die($conn->error);

  $query = "INSERT INTO classics (author, title, category, year, isbn)
   VALUES ('William Shakespeare','Romeo and Juliet','Play','1594','9780192814968')";

  $result = $conn->query($query);
  if (!$result)
     die($conn->error);

  $query = "INSERT INTO classics (author, title, category, year, isbn)
   VALUES ('Charles Dickens','Little Dorrit','Fiction','1857','9780141439969')";

   $result = $conn->query($query);
   if (!$result)
       die($conn->error);

  else
      echo "Table build successful.";

?>
