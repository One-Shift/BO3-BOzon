<form method="post" name="form" id="form" enctype="multipart/form-data">

  <!--USERNAME FIELD-->
  <div>
      <div class="form-group">
          <label for="inputName">{c2r-lg-name}</label>
          <input type="text" class="form-control" id="inputName" name="inputName" value="{c2r-username}">
      </div>
  </div>

  <!--EMAIL FIELD-->
  <div>
      <div class="form-group">
          <label for="inputEmail">{c2r-lg-email}</label>
          <input type="email" class="form-control" id="inputEmail" name="inputEmail" value="{c2r-email}">
      </div>
  </div>

  <!--HIDDEN FIELD BECAUSE PASSWORD WAS AUTOCOMPLETING (the autocomplete="off" rule was not being respected on firefox)-->
  <input type="text" style="display:none">

  <!--NEW PASSWORD FIELD-->
  <div>
      <div class="form-group">
          <label for="inputNewpass">{c2r-lg-newpass}</label>
          <input type="password" class="form-control" id="inputNewpass" name="inputNewpass" autocomplete="off">
      </div>
  </div>

  <!--NEW PASSWORD CONFIRM FIELD-->
  <div>
      <div class="form-group">
          <label for="inputConfirm">{c2r-lg-confirm}</label>
          <input type="password" class="form-control" id="inputConfirm" name="inputConfirm" autocomplete="off">
      </div>
  </div>

  <!-- RANK FIELD-->
  <div>
    <div class="form-group">
        <label for="inputRank">{c2r-lg-rank}</label>
        <select class="form-control" id="inputRank" name="inputRank">
          <option {c2r-owner-selected}>{c2r-lg-owner}</option>
          <option {c2r-manager-selected}>{c2r-lg-manager}</option>
          <option {c2r-member-selected}>{c2r-lg-member}</option>
        </select>
    </div>
  </div>

  <!-- CODE FIELD-->
  <div>
    <div class="form-group">
        <label for="inputCode">{c2r-lg-code}</label>
        <textarea class="form-control" rows="10" name="inputCode" id="inputCode">{c2r-code}</textarea>
    </div>
  </div>

  <!-- SATUS FIELD-->
  <div>
    <div class="form-group">
        <div class="checkbox">
          <label><input type="checkbox" name="inputStatus" id="inputStatus" value="1" {c2r-status-checked}>{c2r-lg-status}</label>
        </div>
    </div>
  </div>

  <!-- SUBMIT BUTTON -->
  <button type="submit" class="btn btn-save pull-right" name="save" id="save"><i class="fa fa-floppy-o" aria-hidden="true"></i><div class="block15"></div>{c2r-btn-save}</button>

</form>
