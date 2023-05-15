<?php

include 'connection.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<!-- rateyo and bootstrap file link  -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/dark.css">
   <link rel="stylesheet" href="css/scrolbtn.css">
   <link rel="stylesheet" href="css/alert.css">
   <link rel="stylesheet" href="css/shop.css">



</head>
<body>
   
<?php include 'header.php'; ?>
<div class="row">
   <div class="col-2" >
   <h1 style="text-align:center ;width:40rem;font-weight:600;font-size:5rem;margin-left:3rem;margin-top:1rem;margin-bottom:1.5rem; color:var(--switchers-main)">Filter Foods</h1>
      <div class="price-filter" style="margin-left: 2rem;">
         <form action="" method="get">
               <h3>Filter food depending on price range</h3>
               <div class="input-group mb-3">
                  <span class="num">Min: </span>
                  <span class="input-group-text">$</span>
               
                  <input   type="number" name="start_price" required value="<?php if(isset($_GET['start_price'])){echo $_GET['start_price'];} else{echo '10';}  ?>" class="form-control" aria-label="Dollar amount (with dot and two decimal places)"/>
               </div>

               <div class="input-group mb-3">
                  <span class="num">Max: </span>
                  <span class="input-group-text">$</span>
                  
                  <input type="number" required value="<?php if(isset($_GET['end_price'])){echo $_GET['end_price'];} else{echo '1000';}  ?>" name="end_price" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
               </div>

               <div class="button">
                  <input type="submit" value="Filter" class="submit-btn"/>
               </div>

         </form>
      </div>
      


    <!-- select list for ascending and descending order -->
    <div class="select">
      <h3>Filter foods depending on ASC/DSC price order </h3>
<form action="" method="get" >
   
      <select class="form-select" name="sort_price"  aria-label="Default select example">
         <option value="">--Select Sorting Order--</option>
         <option value="ascending" <?php if(isset($_GET['sort_price']) && $_GET['sort_price']== 'ascending'){echo "selected";} ?> >Ascending Order</option>
         <option value="descending" <?php if(isset($_GET['sort_price']) && $_GET['sort_price']== 'descending'){echo "selected";} ?> >Descending Order</option>
         
      </select>      
      <div class="button">
            <input type="submit" value="Filter" class="submit-btn" />
      </div>
   
</form>
</div>   
       <!-- select list for ascending and descending order -->
       <div class="select">
         <h3>Filter foods depending on restaurant name</h3>
<form action="" method="get" >

      <select class="form-select" name="sort_restaurant" aria-label="Default select example">
         <option value="">--Select Restaurnat--</option>
         <?php
               $select_restaurants = mysqli_query($conn, "SELECT * FROM `restaurants` WHERE status='approved'"); 
               $select_restaurants_count = mysqli_num_rows($select_restaurants);
               if($select_restaurants_count > 0){
                  while ($fetch_restaurant = mysqli_fetch_assoc($select_restaurants)) {
         ?>
               <option value="<?=$fetch_restaurant['id']; ?>" <?php if(isset($_GET['sort_restaurant']) && $_GET['sort_restaurant']== $fetch_restaurant["id"]){echo "selected";} ?> > <?= $fetch_restaurant['name']; ?></option>
               

         <?php }} ?>
      </select>      
      <div class="button">
         <input type="submit" value="Filter" class="submit-btn" />
      </div>
   
</form>
</div>   
       
       <!-- select list for ascending and descending order -->
       <div class="select">
         <h3>Filter foods depending on Category name</h3>
<form action="" method="get" >
   
      <select class="form-select" name="sort_category" aria-label="Default select example">
         <option value="">--Select category--</option>
         <?php
            $select_categories = mysqli_query($conn, "SELECT * FROM `food_categories` "); 
            $select_categories_count = mysqli_num_rows($select_categories);
            if($select_categories_count > 0){
               while($fetch_category = mysqli_fetch_assoc($select_categories)){
                  
         ?>
         <option value="<?= $fetch_category['id']; ?>" <?php if(isset($_GET['sort_category']) && $_GET['sort_category']== $fetch_category["id"]){echo "selected";} ?>><?= $fetch_category['name']; ?></option>
         <?php }} ?>
      </select>      
      <div class="button">
         <input type="submit" value="Filter" class="submit-btn" />
      </div>
  
</form>
</div>   
       
</div>
<div class="col-10">

<section class="products">

   <h1 class="heading" style="color:var(--switchers-main);">Our Foods</h1>

   <div class="box-container">

   <?php
     //if we filter the products depending on price
     if(isset($_GET['start_price']) && isset($_GET['end_price'])){
         $start_price = $_GET['start_price'];
         $end_price = $_GET['end_price'];
         $query = "SELECT * FROM `foods` WHERE price BETWEEN $start_price AND $end_price";
     
}

     elseif(isset($_GET['sort_price'])){
         $sort_option = "";
         if($_GET['sort_price']== "ascending"){
            $sort_option = "ASC";
         }
         elseif($_GET['sort_price']== "descending"){
            $sort_option = "DESC";
         }
         $query = "SELECT * FROM `foods` ORDER BY price $sort_option";

         
    }
    
     elseif(isset($_GET['sort_restaurant'])){
         $sort_option = $_GET['sort_restaurant'];
         if($sort_option == "")
         {
            $query = "SELECT *FROM `foods`";
         }
         else{
            $query = "SELECT * FROM  `foods` WHERE restaurant_id= $sort_option ";
         }
         
    }
     elseif(isset($_GET['sort_category'])){
      $sort_option = $_GET['sort_category'];
      if($sort_option == "")
      {
         $query = "SELECT *FROM `foods`";
      }
      else{
         $query = "SELECT * FROM  `foods` WHERE category_id='$sort_option'";
      }
      
 }

     else{
        $query = "SELECT * FROM `foods`";
     }
     $select_foods = mysqli_query($conn, $query); 
     $select_foods_counts = mysqli_num_rows($select_foods);
     if($select_foods_counts > 0){
      while($fetch_food = mysqli_fetch_assoc($select_foods)){
         $fid=$fetch_food['id'];
          // get the restaurant name of this food
          $rid = $fetch_food['restaurant_id'];
          $select_resto = mysqli_query($conn, "SELECT * FROM `restaurants` WHERE id = '$rid'");
          $fetch_resto = mysqli_fetch_assoc($select_resto);
          $resto = $fetch_resto['name']; 
          
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="fid" value="<?= $fetch_food['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_food['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_food['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_food['image_01']; ?>">

      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?fid=<?= $fetch_food['id']; ?>" class="fas fa-eye"></a>
      
      <img src="uploaded_img/<?= $fetch_food['image_01']; ?>" alt="">
      <div class="name" style="min-height:6rem ;"><?= $fetch_food['name']; ?> {<span style="color:var(--switchers-main) ;"><?= $resto ?></span>}</div>
      <div class="flex-btn">
      <?php
                  $average =0;
                  $ratings=0;
                  $select_rating = mysqli_query($conn, "SELECT * FROM `food_rating` WHERE food_id='$fid'"); 
                  $select_rating_count = mysqli_num_rows($select_rating);
                  if ($select_rating_count > 0) {
                  while ($fetch_rating = mysqli_fetch_assoc($select_rating)) {
                     $ratings += $fetch_rating['rate'];
                  }
                  $average = $ratings/$select_rating_count;
                  }     
               ?>
               <div class="rateyo" id= "rating"
                     data-rateyo-rating="<?= $average ?>"
                     data-rateyo-num-stars="5"
                     data-rateyo-score="3">
                     </div>
            
               <span class='result' style="font-size: 23px;color:var(--black);"><?= $average ?></span>
               <input type="hidden"  name="rating">
       </div>
      <div class="flex">
         <div class="price"><span>$</span><?= $fetch_food['price']; ?><span>/-</span></div>
         <input type="number" style="color: var(--switchers-main);" name="qty" class="qty" min="1" max="<?= $fetch_food['quantity']; ?>" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit"  value="add to cart" class="btn" name="add_to_cart">
   </form>
   
   <?php
      }
   }else{
      echo '<p class="empty" >No Foods Found!</p>';
      ?>
      <style>
         #load-more{
            display: none;
         }
      </style>
      <?php
   }
   ?>

   </div>
   <div class="flex" >
       <div id="load-more" > load more </div>
   </div>
   
</section>
</div>
</div>

<button id="scrolbtn" class="fa-solid fa-arrow-up-from-arc">Up</button>












<?php include 'footer.php'; ?>

<script src="js/script.js"></script>
<script src="js/dark.js"></script>
<script src="js/scrolbtn.js"></script>
<script src="js/range.js"></script>

<script src="js/popper.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>

<script src="//code.tidio.co/78w4vhfihy2v4yiz8pfedy0ndoz9s5ob.js" async></script>     <!--link for tidio chatbot-->
 <!--<script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="df98105e-933d-4380-be43-93bcad670f28";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>   -->  <!--link for crisp chatbot-->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script>  //code for rating
 $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :'+ rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
        });
    });


   
//code for load more button
let loadMoreBtn = document.querySelector('#load-more');
let currentItem = 6;


loadMoreBtn.onclick = () =>{
   let boxes = [...document.querySelectorAll('.products .box-container .box')];
   let length = boxes.length;
   for (var i = currentItem; i < currentItem + 6; i++){
      boxes[i].style.display = 'inline-block';
   }
   currentItem += 6;
   
   if(currentItem >= length){
      loadMoreBtn.style.display = "none";
   }

   
   
}



 
</script>

</body>
</html>