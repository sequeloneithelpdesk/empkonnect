<form action="#" id="form_sample_1" class="form-horizontal">
    <div class="form-body">
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            You have some form errors. Please check below.
        </div>
        <div class="alert alert-success display-hide">
            <button class="close" data-close="alert"></button>
            Bank Details Created And Added successfully!
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="col-md-4">
              <label class="control-label">Bank Code <span class="required">
              * </span>
              </label></br>
              <input type="text" name="bankCode" class="form-control" required="required" />
          </div>
             <div class="col-md-4">                          
              <label class="control-label">Bank Name <span class="required">
              * </span>
              </label></br>
                <input name="bankName" type="text" class="form-control" required="required" />
             </div>
             <div class="col-md-4">                          
              <label class="control-label">Bank Branch<span class="required">
              * </span>
              </label></br>
                <input name="bankBranch" type="text" class="form-control" required="required" />
             </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-12">
          <div class="col-md-4">
              <label class="control-label">IFSC Code<span class="required">
              * </span>
              </label></br>
              <input type="text" name="bankIFSC" class="form-control" required="required" />
          </div>
          <div class="col-md-4">                          
            <label class="control-label">MICR Code<span class="not-required">
            </span>
            </label></br>
            <input name="bankMICR" type="text" class="form-control"/>
          </div>
          <div class="col-md-4">                          
            <label class="control-label">Bank Type<span class="required">
              * </span>
            </label></br>
            <select name="bankType" id="bankType" class="form-control" required="required">
                <option value="sal">Salary</option>
                <option value="reim">Reimbursement</option>
            </select>
          </div>
          
        </div>
        <div class="col-md-12">
            <div class="col-md-8">                          
             <label class="control-label">Bank Address<span class="not-required">
             </span>
             </label></br>
             <textarea name="bankAddress" id="bankAddress" type="text" class="form-control" cols="10" rows="1"></textarea>
             </div>
             <div class="col-md-4">
              <label class="control-label">Bank Phone<span class="not-required"></span>
              </label></br>
              <input name="bankPhone" type="text" class="form-control"/>
             </div>
          </div>
      </div>
      <div class="form-group">
        <div class="col-md-12">
            <div class="col-md-4">
              <label class="control-label">City<span class="not-required">
               </span>
              </label></br>
              <input type="text" name="bankCity" class="form-control"/>
            </div>
             
             <div class="col-md-4">                          
              <label class="control-label">State<span class="not-required">
              </span>
              </label></br>
                <input name="bankState" type="text" class="form-control"/>
             </div>
             <div class="col-md-4">                          
              <label class="control-label">Pincode<span class="required">
               </span>
              </label></br>
                <input name="bankPin" type="text" class="form-control" placeholder=""/>
             </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-12">
          <h4><strong>Company Bank Detail</strong></h4>
        </div>
        <div class="col-md-12">
          <div class="col-md-4">
              <label class="control-label">IFSC Code<span class="required">
              * </span>
              </label></br>
              <input type="text" name="compIFSC" class="form-control" required="required"/>
          </div>
          <div class="col-md-4">
              <label class="control-label">MICR Code<span class="required">
              * </span>
              </label></br>
              <input type="text" name="compMICR" class="form-control" required="required"/>
          </div>
          <div class="col-md-4">
              <label class="control-label">Account Number<span class="required">
              * </span>
              </label></br>
              <input type="text" name="compBankAcNo" class="form-control" required="required"/>
          </div>
        </div>
      </div>
  </div>
  <div class="form-actions">
    <div class="row">
      <div class="col-md-offset-9 col-md-3">
        <button type="submit" class="btn blue">Submit</button>
        <button type="button" data-dismiss="modal" class="btn default">Cancel</button>
      </div>
    </div>
  </div>
</form>