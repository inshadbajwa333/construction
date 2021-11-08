<div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Users</h3>
                </div>
               
              </div>
            </div>
          </div>
<div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                 
                  <div class="card-body">
                  <form method="post" enctype="multipart/form-data" action="<?=base_url()?>admin/Works/createWork" >
                  <div class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label" for="validationCustom03" >Work Type</label>
                          <select class="form-control" name="w_cat" required>
                        <option value="const">Construction Works</option>  
                        <option value="painting">Painting </option>  
                        <option value="refurb">Full Refurbishings</option>  
                        <option value="other">Other Works</option>  
                        </select>
                        </div>
                        
                      </div>
                      <br>
                      <div class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label" for="validationCustom03">Before Work</label>
                          <input  class="form-control" id="validationCustom03" type="file" placeholder="Phone" required="" name="before[]" multiple required>
                          <input  class="form-control" id="validationCustom03" type="hidden" placeholder="Phone" required="" name="uId" value="<?=$id?>">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label" for="validationCustom03">After Work</label>
                          <input class="form-control" id="validationCustom03" type="file" placeholder="Image" required="" name="after[]" multiple required>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label" for="validationCustom03">Before Eplaination </label>
                          <textarea class="form-control" id="validationCustom03" type="text"  required="" name="beforeExp" required></textarea>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label" for="validationCustom03">After Eplaination</label>
                          <textarea class="form-control" id="validationCustom03" type="text"  required="" name="afterExp" required></textarea>
                        </div>
                      </div>
                      
                      <br>
                      <br>
                      <button class="btn btn-primary" type="submit">Submit form</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>