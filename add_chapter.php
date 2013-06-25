<?php include('header.php'); ?>

<h3>Add Chapter</h3>

<?php

if(isset($_POST['submitText'])) {
$text = nl2br($_POST['text']);
$book_id = $_POST['book_id'];
$chapter = (int) $_POST['chapter'];

if ($chapter === null) {
$chapter = 1;
}

// echo str_replace("\n", "<p>", $text);

$textA = explode(' ', $text);

$punctuation = array('.', '?', '!', '"');

$partCount = 1;

while(count($textA) > 0) {
    $part = array_slice($textA, 0, 500);
    $word = end($part);
    $textA = array_slice($textA, 499);
    if(count($part)!==500) { 
        echo "500 hit";
        print implode(' ', $part);
    } else {
        while(!in_array(substr($word, -1), $punctuation)) {
            $word = array_shift($textA);
            array_push($part, $word);
        }
    }
    echo implode(' ', $part);
    echo '<br><br>';
    
    // put into mysql
    
    $q = sprintf("INSERT INTO info (book_id, chapter, part, text)
    VALUES (%s, %s, %s, '%s')", $book_id, $chapter, $partCount, mysql_real_escape_string(implode(' ',$part)));
    
    echo $q;
    
    mysql_query($q) or DIE('Part not inserted. '.mysql_error().'<br>');
    
    $partCount += 1;
}

// check and see if all chapters in book are accounted for

}

?>


<form action='' method='POST'>
<select name='book_id'>
<?php
$q = "SELECT * FROM books";
$books_result = mysql_query($q);
while($row = mysql_fetch_array($books_result)) {
echo '<option value=' . $row['id'] . '>' . $row['author'] . "'s " . $row['title'] . '</option>';
}
?>
</select>
<input type='text' name='chapter'><br>
<textarea name='text' rows=15 cols=60></textarea>
<input type='submit' value='Submit' name='submitText'>