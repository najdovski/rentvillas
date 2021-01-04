<div class="container">
  <div class="row mt-5">
    <div class="col-3 text-center">
      <h3>Admin Options</h3>
    <button class="btn btn-dark btn-block" id="addNewVillaButton">Add New Villa</button>
    <button class="btn btn-dark btn-block mt-2" id="editUsersButton">Edit Users</button>
    <button class="btn btn-dark btn-block mt-2" id="newLocationButton">Add New Location</button>
    <button class="btn btn-dark btn-block mt-2" id="newAmenityButton">Add New Amenity</button>
    </div>
    <div class="col-6 text-center" id="addNewVilla">
      <h3>Add New Villa</h3>
      <?php echo form_open('adminPanel/newVilla'); ?>
        <input class="form-control mt-1" type="text" placeholder="Name" name="name" value="<?= set_value('name');?>">
        <span class="text-danger"><?= form_error('name');?></span>
        <input class="form-control mt-1" type="text" placeholder="Location" name="location" value="<?= set_value('location');?>">
        <span class="text-danger"><?= form_error('location');?></span>

        <div class="row">
          <div class="col-4">
          <input class="form-control mt-1" type="number" placeholder="Max Persons" name="maxPax" value="<?= set_value('maxPax');?>">
          <span class="text-danger"><?= form_error('maxPax');?></span>
          </div>

          <div class="col-4">
          <input class="form-control mt-1" type="number" placeholder="Adults" name="adults" value="<?= set_value('adults');?>">
          <span class="text-danger"><?= form_error('adults');?></span>
          </div>

          <div class="col-4">
          <input class="form-control mt-1" type="number" placeholder="Children" name="children" value="<?= set_value('children');?>">
          <span class="text-danger"><?= form_error('children');?></span>
          </div>
        </div>

        <div class="row">
          <div class="col-4">
          <input class="form-control mt-1" type="number" placeholder="Bathrooms" name="bathrooms" value="<?= set_value('bathrooms');?>">
          <span class="text-danger"><?= form_error('bathrooms');?></span>
          </div>

          <div class="col-4">
          <input class="form-control mt-1" type="number" placeholder="Bedrooms" name="bedrooms" value="<?= set_value('bedrooms');?>">
          <span class="text-danger"><?= form_error('bedrooms');?></span>
          </div>

          <div class="col-4">
          <input class="form-control mt-1" type="number" placeholder="Pool Type" name="poolType" value="<?= set_value('poolType');?>">
          <span class="text-danger"><?= form_error('poolType');?></span>
          </div>
        </div>
        
        <select name="island" id="island" class="form-control mt-1">
          <option disabled selected>Select Island</option>
            <?php foreach($islands as $island): ?>
          <option value="<?= $island['Island_ID'] ?>"><?= $island['Island_Name'] ?></option>
           <?php endforeach; ?>
        </select>
        <span class="text-danger"><?= form_error('island');?></span>

        <label for="amenities[]">Amenities: </label> <br>
        <?php foreach($amenities as $amenity): ?>
        <input type="checkbox" name="amenities[]" value="<?=$amenity['Amenity_ID']?>"> <?=$amenity['Amenity_Name']?>
        <?php endforeach; ?>
        <br>
        <span class="text-danger"><?= form_error('amenities[]');?></span>
        <br>
        <label for="availableFrom">From: </label>
        <input class="form-control" id="startDate" type="date" name="availableFrom" value="<?= set_value('availableFrom');?>">
        <span class="text-danger"><?= form_error('availableFrom');?></span>

        <label for="availableTo">To: </label>
        <input class="form-control" type="date" name="availableTo" value="<?= set_value('availableTo');?>">
        <span class="text-danger"><?= form_error('availableTo');?></span>


        <input class="form-control mt-1" type="number" placeholder="Price" name="price" value="<?= set_value('price');?>">
        <span class="text-danger"><?= form_error('price');?></span>
        <input class="btn btn-block btn-dark mt-3" type="submit" value="Save">
      
      </form>
      </div>

      <div class="col-7 text-center" id="editUsers">
        <h4>Registered users</h4>
          <div class="form-group mt-2">
            
            <table class="table">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Admin</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($allUsers as $row): ?>
                <tr>
                  <th scope="row"><?=$row['Person_ID']?></th>
                  <td><?=$row['Name']?></td>
                  <td><?=$row['Email']?></td>
                  <td class="admin"><?=$row['Admin']?></td>
                  <td><a href="adminPanel/editUser/<?=$row['Person_ID']?>"> <i class="fa fa-lg fa-edit text-info"></i> </a></td>
                  <td><a href="adminPanel/removeUser/<?=$row['Person_ID']?>"><i class="fa fa-lg fa-remove text-danger"></i></a></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
      </div>



      <div class="col-7 text-center" id="newLocation">
        <h4 class="mb-2">New Country</h4>
        <form id="countryForm">
          <input type="text" placeholder="Country Name" class="form-control" name="countryName">
          <input type="submit" class="btn btn-block btn-dark form-control mt-1" value="save">
        </form>
        <hr>


        <h4 class="mb-2">New Region</h4>
        <form id="regionForm">
          <div class="form-row">
            <div class="col">
              <input type="text" class="form-control" placeholder="Region Name" name="regionName">
            </div>
            <div class="col">
              <select id="regionSelectCountry" class="form-control" name="countryID">
                <option disabled selected id="loadingCountries">Loading...</option>
              </select>
            </div>
          </div>
          <input class="btn btn-block btn-dark mt-3" type="submit" value="Save">
        </form>
        <hr>



        <h4 class="mt-2">New Island</h4>
        <form id="islandForm">
          <div class="form-row">
            <div class="col">
              <input type="text" class="form-control" placeholder="Island Name" name="islandName">
            </div>
            <div class="col">
              <select id="islandSelectRegion" class="form-control" name="regionID">
                <option disabled selected id="loadingRegions">Loading...</option>
              </select>
            </div>
          </div>
          <input class="btn btn-block btn-dark mt-3" type="submit" value="Save">
        </form>
      </div>


      <div class="col-7 text-center" id="newAmenity">
        <h4 class="mt-2">Add amenities</h4>
          <form id="amenitiesForm">
            <input type="text" placeholder="Add New Amenity" class="form-control" name="amenityName">
            <input class="btn btn-block btn-dark mt-3" type="submit" value="Save">
          </form>
          
            <div class="mt-3"> <h5>Current Amenities:</h5> </div>
          <ul class="list-group list-group-flush mt-1 list-inline" id="amenityList"></ul>


      </div>

    </div>
    <div class="col-3"></div>
  </div>
</div>


<script>
$(document).ready(function(){
  $('.admin:contains(1)').text('Yes');
  $('.admin:contains(0)').text('No');
  $('.admin:empty').text('No');

  

  // $('#addNewVilla').hide();
  $('#editUsers').hide();
  $('#newLocation').hide();
  $('#newAmenity').hide();

  $('#addNewVillaButton').click(function(){
    $('#addNewVilla').slideToggle();
    $('#editUsers').hide();
    $('#newLocation').hide();
    $('#newAmenity').hide();
  });

  $('#editUsersButton').click(function(){
    $('#editUsers').slideToggle();
    $('#addNewVilla').hide();
    $('#newLocation').hide();
    $('#newAmenity').hide();
  });

  $('#newLocationButton').click(function(){
    $('#newLocation').slideToggle();
    $('#editUsers').hide();
    $('#addNewVilla').hide();
    $('#newAmenity').hide();
  });

  $('#newAmenityButton').click(function(){
    $('#newAmenity').slideToggle();
    $('#editUsers').hide();
    $('#addNewVilla').hide();
    $('#newLocation').hide();
  });


//formCountry AJAX post
$('#countryForm').submit(function(e){
    e.preventDefault();
    var countryName = $("input[name='countryName']").val();
    $.ajax({
        url: 'newCountry',
        type: 'POST',
        data: {countryName : countryName},
        error: function() {
          alert('Something is wrong');
        },
        success: function(data) {
            $("#countryForm").append("<p class='bg-success text-white mt-1'>" + countryName + " added to the country list</p>");
            // alert("Country added successfully");  

            //removes the current options (old countries) and loads the function getCountries() to load the new countries
            var selectList = $("#regionSelectCountry");
            selectList.find("option:gt(0)").remove();
            getCountries();
        }
    });
});


//AJAX get countries for formRegion
getCountries();
  function getCountries(){
    $.ajax({
      url: 'getCountries',
      type: 'GET',
      success: function(data){
          // console.log(data);

          $.each(JSON.parse(data), function(key, country){
              var option = new Option(country, country);
              $("#regionSelectCountry").append('<option id="' + country.Country_ID + '" value="' + country.Country_ID + '">' + country.Country_Name + '</option>');
          });

          //loading text change
          $('#loadingCountries').text('Select a Country');

      }
  });
}


//formRegion AJAX post
$('#regionForm').submit(function(e){
    e.preventDefault();
    var regionName = $("input[name='regionName']").val();
    var countryID =  $("select[name='countryID']").val();
    
    $.ajax({
        url: 'newRegion',
        type: 'POST',
        data: {
          regionName : regionName,
          countryID : countryID
        },
        error: function() {
          alert('Something is wrong');
        },
        success: function(data) {
            $("#regionForm").append("<p class='bg-success text-white mt-1'>" + regionName + " added to the region list</p>"); 

            //removes the current options (old regions) and loads the function getRegions() to load the new regions
            var selectList = $("#islandSelectRegion");
            selectList.find("option:gt(0)").remove();
            getRegions();
        }
    });
});




//AJAX get regions for islandsForm
getRegions();
function getRegions(){
  $.ajax({
    url: 'getRegions',
    type: 'GET',
    success: function(data){
        // console.log(data);

        $.each(JSON.parse(data), function(key, region){
            var option = new Option(region, region);
            $("#islandSelectRegion").append('<option id="' + region.Region_ID + '" value="' + region.Region_ID + '">' + region.Region_Name + '</option>');
        });

        //loading text change
        $('#loadingRegions').text('Select a Region');

    }
});
}



//islandForm AJAX post
$('#islandForm').submit(function(e){
    e.preventDefault();
    var islandName = $("input[name='islandName']").val();
    var regionID =  $("select[name='regionID']").val();
    
    $.ajax({
        url: 'newIsland',
        type: 'POST',
        data: {
          islandName : islandName,
          regionID : regionID
        },
        error: function() {
          alert('Something is wrong');
        },
        success: function(data) {
            $("#islandForm").append("<p class='bg-success text-white mt-1'>" + islandName + " added to the island list</p>"); 

            //removes the current options (old regions) and loads the function getRegions() to load the new regions
            var selectList = $("#islandSelectRegion");
            selectList.find("option:gt(0)").remove();
            getRegions();
        }
    });
});

//formCountry AJAX post
$('#amenitiesForm').submit(function(e){
    e.preventDefault();
    var newAmenity = $("input[name='amenityName']").val();
    $.ajax({
        url: 'newAmenity',
        type: 'POST',
        data: {newAmenity : newAmenity},
        error: function() {
          alert('Something is wrong');
        },
        success: function(data) {
            $("#amenitiesForm").append("<p class='bg-success text-white mt-1'>" + newAmenity + " added to the amenity list</p>");
            $('#amenityList').empty();
            getAmenities();
        }
    });
});


//AJAX get countries for formRegion
getAmenities();
  function getAmenities(){
    $.ajax({
      url: 'getAmenities',
      type: 'GET',
      success: function(data){
          // console.log(data);

          $.each(JSON.parse(data), function(key, amenity){
              var option = new Option(amenity, amenity);
              $("#amenityList").append('<li class="list-inline">'+amenity.Amenity_Name+'</li>');
          });

          //loading text change
          $('#loadingCountries').text('Select a Country');

      }
  });
}


});
</script>
