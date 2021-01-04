<style>
.centered {
  position: absolute;
  top: 30%;
  left: 50%;
  transform: translate(-50%, -50%);
  color:white;
  font-size:4em;
  text-shadow: 2px 2px 4px black;
}
</style>

<div class="container">
  <div class="row">
    <div class="col-12">
      

      <?php foreach($showVilla as $villa):?>

      <?php if (isset($_SESSION['admin'])):?>
        <div class="text-center mb-3">
          <div class="row">
            <div class="col">
              <a href="/codeigniter/EditVilla/index/<?=$villa['Prop_ID']?>" class="btn btn-block btn-dark">Edit This Villa</a>
            </div>
            <div class="col">
              <a href="/codeigniter/EditVilla/removeVilla/<?=$villa['Prop_ID']?>" class="btn btn-block btn-danger" id="removeVilla">Remove This Villa</a>
            </div>
          </div>
        </div>
      <?php endif; ?>

        <img src="https://loremflickr.com/1200/250/beach,hotel,summer/all" class="img-fluid shadow rounded" alt="Responsive image">
        <div class="centered"><?= $villa['Prop_Name']; ?></div>
     
      <div class="col-12 mt-5">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis faucibus rhoncus leo quis scelerisque. Donec sit amet risus eu ante tincidunt viverra. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque gravida, ex at hendrerit lacinia, lectus augue elementum felis, ut ultrices ex arcu nec erat. Ut vehicula imperdiet sodales. Ut quis aliquet diam, sit amet sodales urna. Nunc at urna neque. Proin ut nisi vitae nisi scelerisque fermentum. Etiam eget arcu nec ipsum sagittis vestibulum. Pellentesque eget felis ligula. Nam ornare felis in metus elementum, ac euismod felis imperdiet. Maecenas quis est a orci porttitor pulvinar. Duis in justo nec arcu tincidunt elementum sit amet in sem.
      </div>
      <hr>
    </div>
  </div>

  <div class="row">
    <div class="col-4 text-center">
    <h5>Info:</h5> <hr>
      <i class="fa fa-map-marker"></i> Location: <?= $villa['Location']?>, <?= $villa['Region_Name']?>, <?= $villa['Country_Name']?><br>
      <i class="fa fa-users"></i> Maximum Capacity: <?= $villa['Max_Pax']?> persons<br>
      <i class="fa fa-male"></i> Adults: <?= $villa['Adults']?><br>
      <i class="fa fa-child"></i> Children: <?= $villa['Children']?><br>
      <i class="fas fa fa-s15"></i> Bathrooms: <?= $villa['Bathrooms']?><br>
      <i class="fa fa-hotel"></i> Bedrooms: <?= $villa['Bedrooms']?><br>
      <i class="fa fa-lg fa-life-bouy"></i> Pool type: <?= $villa['Pool_Type_String']?><br>
    </div>
    
    <div class="col-4 text-center">
      <h5>Amenities:</h5> <hr>
      <?php foreach($showAmenities as $key => $amenity){
        echo $amenity['Amenity_Name'] . '<br>';
      }
      ?>
    </div>

    <div class="col-4 text-center">
      <?php if (isset($_SESSION['personID'])){
       $year = 2019;
       $month = date('m');
      ?>
      <h5>Prices:</h5> <hr>
      <?php foreach($showPrice as $price){
        echo date('d M Y', strtotime($price['From_Date'])) . ' - ';
        echo date('d M Y', strtotime($price['To_Date'])) . ' - ';
        echo '<span class="bg-dark text-white p-1 rounded">' . $price['Price']. ' €</span><br><br>';
      }?>
      <a href="/portfolio_projects/rentvillas/Calendar/book/<?=$villa['Prop_ID']?>/<?=$_SESSION['personID']?>/<?=$year?>/<?=$month?>" class="btn btn-dark btn-block rounded shadow mt-5">Book me now!</a>
      <?php } else { ?>
        <a href="/portfolio_projects/rentvillas/login/index" class="btn btn-info btn-lg rounded shadow mt-5">Login to book</a>
      <?php } ?>
      <?php endforeach; ?>
    </div>
</div>
<hr>

<div class="row text-center">
<div class="col-12">
        <div class="shadow">
            <iframe width="100%" height="300px" id="gmap_canvas" src="https://maps.google.com/maps?q=<?=$villa['Location']?>&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
        </div>
      </div>
  </div>


<?php
?>

<script>
$('#removeVilla').click(function(){
  return confirm("Are you sure?");
});
</script>