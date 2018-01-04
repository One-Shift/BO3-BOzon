<form method="post" name="form" id="form" enctype="multipart/form-data">

  <!--USERNAME FIELD-->
  <div>
      <div class="form-group">
          <label for="inputName">{c2r-lg-name}</label>
          <input type="text" class="form-control" id="inputName" name="inputName" placeholder="" required>
      </div>
  </div>

  <!--EMAIL FIELD-->
  <div>
      <div class="form-group">
          <label for="inputEmail">{c2r-lg-email}</label>
          <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="" required>
      </div>
  </div>

  <!--PASSWORD FIELD-->
  <div>
      <div class="form-group">
          <label for="inputPass">{c2r-lg-pass}</label>
          <input type="password" class="form-control" id="inputPass" name="inputPass" placeholder="" required>
      </div>
  </div>

  <!--PASSWORD CONFIRM FIELD-->
  <div>
      <div class="form-group">
          <label for="inputConfirm">{c2r-lg-confirm}</label>
          <input type="password" class="form-control" id="inputConfirm" name="inputConfirm" placeholder="" required>
      </div>
  </div>

  <!-- RANK FIELD-->
  <div>
    <div class="form-group">
        <label for="inputRank">{c2r-lg-rank}</label>
        <select class="form-control" id="inputRank" name="inputRank">
          <option value="{c2r-lg-owner-value}">{c2r-lg-owner}</option>
          <option value="{c2r-lg-manager-value}">{c2r-lg-manager}</option>
          <option value="{c2r-lg-member-value}" selected>{c2r-lg-member}</option>
        </select>
    </div>
  </div>

  <!-- CODE FIELD-->
  <div>
    <div class="form-group">
        <label for="inputCode">{c2r-lg-code}</label>
        <textarea class="form-control" rows="10" name="inputCode" id="inputCode"></textarea>
    </div>
  </div>

  <!-- SATUS FIELD-->
  <div>
    <div class="form-group">
        <div class="checkbox">
            <input name="inputStatus" value="0" type="hidden">
            <label><input name="inputStatus" id="inputStatus" type="checkbox" value="1">{c2r-lg-status}</label>
        </div>
    </div>
  </div>

  <!-- SUBMIT BUTTON -->
  <button type="submit" class="btn btn-save pull-right" name="save" id="save"><i class="fa fa-floppy-o" aria-hidden="true"></i><div class="block15"></div>{c2r-btn-save}</button>

</form>
