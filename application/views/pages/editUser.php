<div class="row">
<div class="col-3"></div>
<div class="col-6 text-center" id="editUsers">
  <?php foreach ($users as $user):?>
    <?php echo form_open('adminPanel/saveUserChanges'); ?>
    <div class="form-group">
    <input type="hidden" value="<?=$user['Person_ID']?>" name="personID">
    <label for="username">Username</label><input id="username" type="text" value="<?=$user['Name']?>" class="form-control rounded mb-2" name="username">
    <span class="text-danger"><?= form_error('username');?></span>
    <label for="email">Email</label><input id="email" type="text" value="<?=$user['Email']?>" class="form-control rounded mb-2" name="email">
    <span class="text-danger"><?= form_error('email');?></span>
    <label for="password">Password</label><input id="password" type="password" placeholder="New password" value="" class="form-control rounded mb-2" name="password">
    <span class="text-danger"><?= form_error('password');?></span>
    <label for="admin">Admin Role</label><select id="admin" class="form-control" name="admin">
      <option selected="true" disabled value="0"></option>
      <option value="0">No</option>
      <option value="1">Yes</option>
    </select>
    <span class="text-danger"><?= form_error('admin');?></span>
  </div>
  <input type="submit" value="Save Changes" class="btn btn-block btn-dark">
  <?php endforeach; ?>
  </form>
</div>

<div class="col-3"></div>
</div>