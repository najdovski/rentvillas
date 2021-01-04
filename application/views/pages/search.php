<style>
  .optionCountry{
    background-color:#343a40;
    color:white;
  }
</style>

<div class="container">
  <div class="row">
    <div class="col-12">

      <h3 class="text-center">Search Villas</h3>
      <?php echo form_open('search'); ?>
          <div class="form-group col-12">
            <div class="row">
            <select class="col-3 form-control mr-4" name="whereSearch">
            <option disabled selected>Where to?</option>
            <?php 
              foreach ($countryNames as $cn){
                echo '<option value="' . $cn['Country_Name'] . '" class="optionCountry">' . $cn['Country_Name'] . '<hr> </option>';
                foreach($locations as $loc){
                  if ($cn['Country_ID'] == $loc['Country_ID']){
                echo '<option value="' . $loc['Region_Name'] . '">' . $loc['Region_Name'] . '</option>';
                    foreach ($islandNames as $in){
                      if ($in['Region_ID'] == $cn['Region_ID']){
                        echo '<option value="' . $in['Island_Name'] . '">' . $in['Island_Name'] . '</option>';
                      }
                    }
                  }
                }
              }
            ?>
            </select>
            <select class="col-3 form-control mr-4" name="personsSearch">
              <option disabled selected>How many persons?</option>
              <?php foreach($maxPersons as $max):?>
              <option value="<?=$max['Max_Pax']?>"><?=$max['Max_Pax']?></option>
              <?php endforeach; ?>
            </select>
            <input class="col-2 form-control mr-4" type="number" placeholder="Max price in €" name="priceSearch">
            <input type="submit" class="col-3 ml-auto form-control btn btn-dark">
            </div>
          </div>
      </form>
      
  <?php foreach ($searchResults as $s):?>

    <div class="card mb-4 shadow">
      <div class="row no-gutters">
        <div class="col-md-4">
          <a href="SingleVilla/show/<?= $s['Prop_ID']?>"> <img src="https://picsum.photos/400/350?random=<?= $s['Prop_ID']?>" class="card-img shadow-sm" style="max-height:100%;"> </a>
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title text-white bg-dark border border-dark d-inline p-1"><?= $s['Prop_Name']?></h5>
            <p class="card-text mt-4"><i class="fa fa-lg fa-map-marker"> <?= $s['Location'] . ', ' . $s['Island_Name'] . ', ' . $s['Country_Name']?>
            </i></p>
            <p class="card-text mt-4"><i class="fa fa-lg fa-users"> <?= $s['Max_Pax']?></i></p>
            <p class="card-text mt-4"><i class="fas fa-lg fa fa-s15"> <?= $s['Bathrooms']?></i></p>
            <p class="card-text mt-4"><i class="fa fa-lg fa-hotel"> <?= $s['Bedrooms']?></i></p>
            <p class="card-text mt-4"><i class="fa fa-lg fa-life-bouy"> <?= $s['Pool_Type_String']?></i></p>
            <p class="card-text"><small class="text-muted">From 
            <?php
            // print_r($printPrices);
            foreach ($printPrices as $pp){
            if ($s['Prop_ID'] == $pp['Prop_ID']){
              // echo $pp[''] . ' ';
              print_r($pp['MIN(Price)']);
              }
            }
            ?>  
            €</small></p>
          </div>
        </div>
      </div>
    </div>

  <?php endforeach; ?>

    </div>
  </div>
</div>