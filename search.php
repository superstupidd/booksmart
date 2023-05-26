<?php
  session_start();
  $count = 0;
  // connecto database
  
  $title = "Home";
  require_once "header.php";
  require_once "./functions/database_functions.php";
  $conn = db_connect();
  
if(isset($_GET['search'])) {
   
    $search= $_GET['query']; 
    $sql="SELECT * from books where (`book_isbn` LIKE '%".$search."%') OR (`book_title` LIKE '%".$search."%') OR (`book_author` LIKE '%".$search."%') OR (`publisherid` LIKE '%".$search."%')  " ; 
 
     // assuming you have already created a database connection
     $result = mysqli_query($conn, $sql);

     // check if there are any rows returned from the query
     if (mysqli_num_rows($result) > 0) {?>
     <h4 class="text-center">Searched books<h4>   
        <div class="card rounded-0">
         <div class="card-body">
             <div class="container-fluid">
                 <table class="table table-striped table-bordered" >
                 <colgroup>
                     <col width="10%">
                     <col width="15%">
                     <col width="15%">
                     <col width="10%">
                     <col width="15%">
                     <col width="10%">
                     <col width="15%">
                 </colgroup>
                     <thead>
                     <tr>
                         <th>ISBN</th>
                         <th>Title</th>
                         <th>Author</th>
                         <th>Description</th>
                         <th>Price</th>
                         <th>Publisher</th>
                         <th>Details</th>
                     </tr>
                     </thead>
                     <tbody>
                     <?php while($row = mysqli_fetch_assoc($result)){ ?>
                     <tr>
                         <td class="px-2 py-1 align-middle"><a href="book.php?bookisbn=<?php echo $row['book_isbn']; ?>" target="_blank"><?php echo $row['book_isbn']; ?></a></td>
                         <td class="px-2 py-1 align-middle"><?php echo $row['book_title']; ?></td>
                         <td class="px-2 py-1 align-middle"><?php echo $row['book_author']; ?></td>
                         <td class="px-2 py-1 align-middle"><p class="text-truncate" style="width:15em"><?php echo $row['book_descr']; ?></p></td>
                         <td class="px-2 py-1 align-middle"><?php echo $row['book_price']; ?></td>
                         <td class="px-2 py-1 align-middle"><?php echo getPubName($conn, $row['publisherid']); ?></td>
                         <td class="px-2 py-1 align-middle text-center">
                             <div class="btn-group btn-group-sm">
                                 <a href="book.php?bookisbn=<?php echo $row['book_isbn']; ?>" class="btn btn-sm rounded-1 btn-primary"  title="Edit">Details</a>
                             </div>
                         </td>
                     </tr>
                     <?php } ?>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
    

   <?php  
       
     } else {
         echo "No results found.";
     }
 

?>
  <?php
      if(isset($conn)) {mysqli_close($conn);}
      require_once "footer.php";
    }
    ?>

