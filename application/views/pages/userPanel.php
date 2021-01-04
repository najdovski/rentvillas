<div class="container">
  <div class="row">
    <div class="col-12 text-center">
      
    <?php if($this->session->flashdata('alreadyLoggedIn')):?>
    <div class="bg-dark text-white rounded shadow mb-4"> <?= $this->session->flashdata('alreadyLoggedIn'); ?> </div>
    <?php endif; ?>
      <h4 class="mt-2"><span class="bg-dark text-white rounded p-1 shadow"> Upcoming Trips </span></h4>
    </div>
  </div>
  
  <?php if (!empty($upcomingTrips)):?>

  <div class="row">
    <div class="card-group mt-3">
    <?php foreach ($upcomingTrips as $row): ?>
      <div class="card mx-2 shadow">
        <img src="https://picsum.photos/300/200?random=<?=$row['Prop_ID']?>" class="card-img-top rounded">
        <div class="card-body">
          <h5 class="card-title"><?=$row['Prop_Name']?></h5>
          <p class="card-text">
            <?php echo date('d M Y', strtotime($row['From_Date'])) . ' - '; ?>
            <?php echo date('d M Y', strtotime($row['To_Date'])) . '<br>';?>
            <span class="bg-dark text-white px-1"><?php echo $row['Price']?> €</span>
          <hr>
          <span class="h4 text-danger">
            <?php
            $today = new DateTime(date('Y/m/d'));
            $dateFrom = new DateTime($row['From_Date']);
            $interval = $today->diff($dateFrom);
            echo $interval->days;
            ?>
            days to go
          </span>
          </p>
          <p class="card-text"><small class="text-muted"><a href="Calendar/cancelBooking/<?=$row['Prop_ID']?>/<?=$_SESSION['personID']?>" id="cancelButton" class="btn btn-danger btn-sm rounded">Cancel Booking</a></small></p>
        </div>
      </div>
      <?php endforeach; ?>
   </div>
  </div>

  <?php else:?>
      <div class="row">
        <div class="col-3"></div>
        <div class="col-6 mt-4 text-center"><h3>You have no upcoming trips!</h3></div>
        <div class="col-3"></div>
      </div>
    <?php endif; ?>



</div>



<script>
$('#cancelButton').click(function(){
  return confirm('Are you sure?');
});
</script>