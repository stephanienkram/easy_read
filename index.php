<?php include('header.php'); ?>

<?php

if(isset($_GET['continue'])) {
echo 'pass';
// grab current active part, part++
// check and see if part exists

$q = "SELECT * FROM logs ORDER BY id DESC LIMIT 1";
$row = mysql_query($q) or DIE('continue logs not fetched. '.mysql_error());
$log = mysql_fetch_array($row);

$id = $log['book_id'];
$chapter = $log['chapter'];
$nextPart = $log['part'] + 1;

function getInfo($book_id, $chapter, $part) {
    $q = "SELECT * FROM info WHERE id='$book_id' and chapter='$chapter' and part='$part'";
    echo $q;
    $row = mysql_query($q) or DIE('info not fetched. '.mysql_error());
    echo $row;
    $info = mysql_fetch_array($row);
    echo var_dump($info);
    return $info;
}

echo "test";

$info = getInfo($id, $chapter, $nextPart);
echo $info;

if($info===false) {
// increment chapter
    $chapter += 1;
    $part = 0;
    $info = getInfo($id, $chapter, $part);
    echo $info;
    if($info===false) {
        //out of available parts/chapters
        $_SESSION['flash'] = 'No more available parts for that book!';
        // header('Location: new_book.php');
    }
}



}

$q = "SELECT * FROM books";
$row = mysql_query($q) or DIE('books not fetched. '.mysql_error());
$log = mysql_fetch_array($row);
if ($log === false){
    header( 'Location: add_book.php' ) ;
}

$q = "SELECT * FROM logs ORDER BY id DESC LIMIT 1";

$row = mysql_query($q) or DIE('logs not fetched. '.mysql_error());
$log = mysql_fetch_array(mysql_query($q));

if ($log === false){
$q = "INSERT INTO logs (book_id, chapter, part) VALUES (1, 1, 1)";

mysql_query($q) or DIE('log not inserted. '.mysql_error());

$q = "SELECT * FROM logs ORDER BY id DESC LIMIT 1";
$row = mysql_query($q) or DIE('logs not fetched. '.mysql_error());
$log = mysql_fetch_array($row);

}

$id = $log['book_id'];
$chapter = $log['chapter'];
$part = $log['part'];

$q = "SELECT * FROM info WHERE id='$id' AND chapter='$chapter' AND part='$part'";
$row = mysql_query($q) or DIE('book part not fetched. '.mysql_error());
$book = mysql_fetch_array($row);

if ($book===false) {
    header( 'Location: add_chapter.php' ) ;
}

echo $book['text'];
?>

<button onclick="window.location.href='index.php?continue=true'">Read!</button>



</body>
</html>