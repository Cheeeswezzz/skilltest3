<?php
    include 'db.php';

    if(isset($_POST['add'])){
        $isbn = $_POST['isbn'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $copyright = $_POST['copyright'];
        $edition = $_POST['edition'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $price * $qty;
        $conn->query("INSERT INTO books(isbn, title, author, copyright, edition, price, qty,totalval) VALUES ('$isbn', '$title', '$author', '$copyright', '$edition', '$price', '$qty','$total')");
        header("header:location:book.php");
    }

    if(isset($_GET['delete'])){
        $isbn = $_GET['delete'];
        $conn->query("DELETE FROM books WHERE isbn=$isbn");
    }

    if(isset($_POST['edit'])){
        $isbn = $_POST['isbn'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $copyright = $_POST['copyright'];
        $edition = $_POST['edition'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total = $price * $qty;
        $conn->query("UPDATE books SET title='$title', author='$author', copyright='$copyright', edition='$edition', price='$price', qty='$qty', totalval='$total' WHERE isbn=$isbn");
    }

    $edit_mode = false;
    $edit_books = null;
    if(isset($_GET['edit'])){
        $edit_mode = true;
        $edit_isbn = $_GET['edit'];
        $results = $conn->query("SELECT * FROM books WHERE isbn=$edit_isbn");
        $edit_books = $results->fetch_assoc();
    }

    $search  = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']): '';
    if(!empty($search)){
        $books = $conn->query("SELECT * FROM books WHERE
            isbn LIKE '%$search%' OR
            title LIKE '%$search%' OR
            author LIKE '%$search%' OR
            copyright LIKE '%$search%' OR
            edition LIKE '%$search%' ");
    } else {
        $books = $conn->query("SELECT * FROM books");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        body{
            background-color:pink;
        }
    </style>

<?php if($edit_mode && $edit_books): ?>
<form method="post">   
    <h2>EDIT BOOKS</h2>
    ISBN : <input type="text" name="isbn" value="<?=$edit_books['isbn']?>" required><br>
    TITLE : <input type="text" name="title" value="<?=$edit_books['title']?>" required><br>
    AUTHOR: <input type="text" name="author" value="<?=$edit_books['author']?>" required><br>
    COPYRIGHT:  <input type="text" name="copyright" value="<?=$edit_books['copyright']?>" required><br>
    EDITION : <input type="text" name="edition" value="<?=$edit_books['edition']?>" required><br>
    PRICE : <input type="number" step="0.01" min="0" name="price" value="<?=$edit_books['price']?>" required><br>
    QTY : <input type="number" name="qty" value="<?=$edit_books['qty']?>" required><br>
    <button type="submit" name="edit">UPDATE BOOK</button>
    <a href="book.php">Back</a>
</form>     
<?php else: ?>
<a href="index.php">BACK TO INDEX</a>

<form method="post">
<h2>BOOKS</h2>
    ISBN : <br><input type="text" placeholder="0000-0000" name="isbn" required><br>
    TITLE : <br><input type="text" name="title" required><br>
    AUTHOR: <br><input type="text" name="author" required><br>
    COPYRIGHT: <br> <input type="text" name="copyright" required><br>
    EDITION : <br><input type="text" name="edition" required><br>
    PRICE : <br><input type="number" step="0.01" min="0" name="price" required><br>
    QTY : <br><input type="number" name="qty" required><br>
    <button type="submit" name="add">ADD BOOK</button>    
</form>

<?php endif;?>
<form method="get">
    <input type="text" name="search" placeholder="Search books..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
    <button type="submit">Search</button>
    <a href="book.php">Clear</a>
</form>
<table border="1">
    <tr>
        <th>ISBN</th>
        <th>TITLE</th>
        <th>AUTHOR</th>
        <th>COPYRIGHT</th>
        <th>EDITION</th>
        <th>PRICE</th>
        <th>QTY</th>
        <th>TOTAL</th>
        <th>ACTIONS</th>
    </tr>
    <?php while($row=$books->fetch_assoc()):?>
        <tr>
            <td><?=$row['isbn']?></td>
            <td><?=$row['title']?></td>
            <td><?=$row['author']?></td>
            <td><?=$row['copyright']?></td>
            <td><?=$row['edition']?></td>
            <td><?=$row['price']?></td>
            <td><?=$row['qty']?></td>
            <td><?=$row['totalval']?></td>
            <td>
                <a href="?delete=<?=$row['isbn']?>">DELETE</a>
                <a href="?edit=<?=$row['isbn']?>">EDIT</a>
            </td>
        </tr>
    <?php endwhile;?>  
</table>
</body>
</html>