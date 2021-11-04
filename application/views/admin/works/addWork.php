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
                          <label class="form-label" for="validationCustom03">Before Work</label>
                          <input  class="form-control" id="validationCustom03" type="file" placeholder="Phone" required="" name="before[]" multiple>
                          <input  class="form-control" id="validationCustom03" type="hidden" placeholder="Phone" required="" name="uId" value="<?=$id?>">
                          <input  class="form-control" id="validationCustom03" type="hidden" placeholder="Phone" value="cont" name="w_cat">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label" for="validationCustom03">After Work</label>
                          <input class="form-control" id="validationCustom03" type="file" placeholder="Image" required="" name="after[]" multiple>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label" for="validationCustom03">Before Eplaination </label>
                          <textarea class="form-control" id="validationCustom03" type="text"  required="" name="beforeExp"></textarea>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label" for="validationCustom03">After Eplaination</label>
                          <textarea class="form-control" id="validationCustom03" type="text"  required="" name="afterExp"></textarea>
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