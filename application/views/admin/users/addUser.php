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
                  <form method="post" enctype="multipart/form-data" action="<?=base_url()?>admin/Users/createUser" >
                      <div class="row g-3">
                      <div class="col-md-4 mb-3">
                          <label class="form-label" for="validationCustomUsername">Username</label>
                          <div class="input-group"><span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input class="form-control" type="text" placeholder="Username" aria-describedby="inputGroupPrepend" required="" name="username"> 
                            <div class="invalid-feedback">Please choose a username.</div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label" for="validationCustom01">Email</label>
                          <input class="form-control" id="validationCustom01" type="text"  required="" name="email">
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label" for="validationCustom02">Password</label>
                          <input class="form-control" id="validationCustom02" type="text"  required="" name="password">
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        
                      </div>
                      <div class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label" for="validationCustom03">Phone Number</label>
                          <input type="text" class="form-control" id="validationCustom03" type="text" placeholder="Phone" required="" name="phone">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label" for="validationCustom03">Image</label>
                          <input class="form-control" id="validationCustom03" type="file" placeholder="Image" required="" name="u_image">
                        </div>
                        <div class="col-md-6">
                          <label class="form-label" for="validationCustom03">Admin Bio</label>
                          <textarea class="form-control" id="validationCustom03" type="text" placeholder="Admin Bio" required="" name="bio"></textarea>
                        </div>
                      </div>
                      <div class="row g-3">
                        
                       
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