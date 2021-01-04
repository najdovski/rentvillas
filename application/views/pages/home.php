<div class="container">
<?php if ($this->session->flashdata('villaAdded')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('villaAdded') ?> </div>
<?php } ?>

<?php if ($this->session->flashdata('villaRemoved')) { ?>
        <div class="alert alert-danger"> <?= $this->session->flashdata('villaRemoved') ?> </div>
<?php } ?>

  <?php echo form_open('Search/search')?>
    <input type="text" placeholder="Search here by name or location" class="form-control" name="whereSearch">
  </form>
<div class="text-center m-3"><h2>Latest villas</h2></div>
  <div class="row">
  <?php foreach ($latestVillas as $lv):?>
    <div class="col-3 mb-3">
      <div class="card shadow">
        <a href="SingleVilla/show/<?=$lv['Prop_ID']?>"> <img src="https://picsum.photos/300/300?random=<?=$lv['Prop_ID']?>" class="card-img-top shadow"> </a>
        <div class="card-body">
          <h5 class="card-title"><?=$lv['Prop_Name']?></h5>
          <p class="card-text">
            <?=$lv['Location']?>, <?=$lv['Region_Name']?>, <?=$lv['Country_Name']?> <hr>
            <i class="fa fa-lg fa-users"></i> <?=$lv['Max_Pax']?>
            <i class="fas fa fa-lg fa-s15 ml-3"></i> <?= $lv['Bathrooms']?>
            <i class="fas fa fa-lg fa-hotel ml-3"></i> <?= $lv['Bedrooms']?>
          </p>
          <a href="SingleVilla/show/<?=$lv['Prop_ID']?>" class="btn btn-sm btn-primary">More info</a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
  </div>
</div>