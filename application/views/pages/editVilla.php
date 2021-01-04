<?php
  $propID = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_BASENAME);
?>

<div class="container">

<?php if ($this->session->flashdata('changesSaved')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('changesSaved') ?> </div>
<?php } ?>

  <div class="row">
    <div class="col-3"></div>
    <div class="col-6 text-center">
      <h3>Edit Villa</h3>
      <hr>
      <?php foreach ($villaProps as $prop): ?>
      <?php echo form_open('editVilla/saveChanges/' . $propID); ?>
        <span class="label">Name</span>
        <input class="form-control mt-1" type="text" placeholder="Name" name="name" value="<?=$prop['Prop_Name']?>">
        <span class="text-danger"><?= form_error('name');?></span>
        <span class="label">Location</span>
        <input class="form-control mt-1" type="text" placeholder="Location" name="location" value="<?=$prop['Location']?>">
        <span class="text-danger"><?= form_error('location');?></span>

        <div class="row">
          <div class="col-4 mt-2">
          <span class="label">Maximum Capacity</span>
          <input class="form-control mt-1" type="number" placeholder="Max Persons" name="maxPax" value="<?=$prop['Max_Pax']?>">
          <span class="text-danger"><?= form_error('maxPax');?></span>
          </div>

          <div class="col-4 mt-2">
          <span class="label">Adults</span>
          <input class="form-control mt-1" type="number" placeholder="Adults" name="adults" value="<?=$prop['Adults']?>">
          <span class="text-danger"><?= form_error('adults');?></span>
          </div>

          <div class="col-4 mt-2">
          <span class="label">Children</span>
          <input class="form-control mt-1" type="number" placeholder="0" name="children" value="<?=$prop['Children']?>">
          <span class="text-danger"><?= form_error('children');?></span>
          </div>
        </div>

        <div class="row">
          <div class="col-4 mt-2">
          <span class="label">Bathrooms</span>
          <input class="form-control mt-1" type="number" placeholder="Bathrooms" name="bathrooms" value="<?=$prop['Bathrooms']?>">
          <span class="text-danger"><?= form_error('bathrooms');?></span>
          </div>

          <div class="col-4 mt-2">
          <span class="label">Bedrooms</span>
          <input class="form-control mt-1" type="number" placeholder="Bedrooms" name="bedrooms" value="<?=$prop['Bedrooms']?>">
          <span class="text-danger"><?= form_error('bedrooms');?></span>
          </div>

          <div class="col-4 mt-2">
          <span class="label">Pool Type</span>
          <input class="form-control mt-1" type="number" placeholder="Pool Type" name="poolType" value="<?=$prop['Pool_Type_ID']?>">
          <span class="text-danger"><?= form_error('poolType');?></span>
          </div>
        </div>


        <span class="label">Island</span>
        <select name="island" id="island" class="form-control mt-1">
          <option value="<?=$prop['Island_ID']?>"><?=$prop['Island_Name']?></option>

            <?php foreach($islands as $island): ?>
          <option value="<?=$island['Island_ID']?>"><?=$island['Island_Name']?></option>
           <?php endforeach; ?>
        </select>
        <span class="text-danger"><?= form_error('island');?></span>

      
        <div class="m-2"><span class="label">Amenities</span></div>
        <?php foreach ($allAmenities as $amenityAll):?>
          <input type="checkbox" name="amenities[]" value="<?=$amenityAll['Amenity_ID']?>"<?php
            foreach ($amenities as $am){
              if ($am['Amenity_ID'] == $amenityAll['Amenity_ID']){
                echo 'checked';
              }
            }
            ?>> <?=$amenityAll['Amenity_Name']?>
        <?php endforeach; ?>
        <br>
        <span class="text-danger"><?= form_error('amenities[]');?></span>
        <br>
        
        <div class="m-2"><span class="label">Prices</span></div>
        <?php foreach($prices as $price):?>
        
        <div class='form-row'>
          <div class="col mt-2">
            <label for="availableFrom">From: </label>
            <input class="form-control" id="startDate" type="date" name="from[]" value="<?=$price['From_Date']?>">
          </div>

          <div class="col mt-2">
            <label for="availableTo">To: </label>
            <input class="form-control" type="date" name="to[]" value="<?=$price['To_Date']?>">
          </div>

          <div class="col mt-2">
            <label for="availableTo">Price </label>
            <input class="form-control mt-1" type="number" placeholder="Price" name="price[]" value="<?=$price['Price']?>">
          </div>
        </div>

        <?php endforeach; ?>
        <a id="addNewField" class="btn btn-light" style="font-size:1.5em; color:gray; font-weight:100">+</a>
        <input class="btn btn-block btn-dark mt-3" type="submit" value="Save">
      
      </form>
        <?php endforeach; ?>


     </div>
    <div class="col-3"></div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

<script>
$('#addNewField').click(function(){
  $(`
  <div class="form-row">
    <div class="col mt-2">
      <label for="availableFrom">From: </label>
      <input class="form-control" id="startDate" type="date" name="from[]" value="">
    </div>

    <div class="col mt-2">
      <label for="availableTo">To: </label>
      <input class="form-control" type="date" name="to[]" value="">
    </div>

    <div class="col mt-2">
      <label for="availableTo">Price </label>
      <input class="form-control mt-1" type="number" placeholder="Price" name="price[]" value="">
    </div>
  </div>
  `).insertBefore(this);
});
</script>