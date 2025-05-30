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
    $conn->query("INSERT INTO books(isbn, title, author, copyright, edition, price, qty, total) VALUES('$isbn', '$title', '$author', '$copyright', '$edition', '$price', '$qty', '$total')");
}

$books = $conn->query("SELECT * FROM books")
?>
<h2>BOOKS</h2>
<form method="post">
    ISBN :<input type="text" name="isbn" required><br>
    TITLE : <input type="text" name="title" required><br>
    AUTHOR <input type="text" name="author" required><br>
    COPYRIGHT : <input type="text" name="copyright" required><br>
    EDITION : <input type="text" name="edition" required><br>
    PRICE : <input type="number" step="0.01" min="0" name="price" required><br>
    QTY : <input type="number" name="qty" required><br>
    <button type="submit" name="add">ADD BOOKS</button>
</form>
<table border="1">
    <tr>
        <th>ISB</th>
        <th>TITLE</th>
        <th>AUTHOR</th>
        <th>COPYRIGHT</th>
        <th>EDITION</th>
        <th>PRICE</th>
        <th>QTY</th>
        <th>TOTAL</th>
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
            <td><?=$row['total']?></td>
        </tr>
    <?php endwhile; ?>    
</table>