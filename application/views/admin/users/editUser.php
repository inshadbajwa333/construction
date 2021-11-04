<div class="main-content">
<div class="page-content">
<div class="container-fluid">
   <!-- start page title -->
   <div class="row">
      <div class="col-12">
         <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Users</h4>
         </div>
      </div>
   </div>
   <!-- end page title -->
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Edit User</h4>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="mt-4">
                     <form method="post" enctype="multipart/form-data" action="<?=base_url()?>admin/Users/update" >
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-email-input">Name</label>
                                    
                                    <input type="text" class="form-control" id="formrow-password-input" name="u_name" value="<?=$user['u_name']?>" required>
                                   
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-email-input">Email</label>
                                    <input type="text" class="form-control" id="formrow-password-input"  name="u_email" value="<?=$user['u_email']?>" required> 
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-password-input">Password</label>
                                    <input type="text" class="form-control" id="formrow-password-input" name="u_password" value="<?=$user['u_password']?>" required>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-email-input">Profile Image</label>
                                    <input type="file" class="form-control" id="u_img" name="u_img">
                                    <input type="hidden" name="old_img" value="<?=$user['u_img']?>">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-password-input">Role</label>
                                    <select class="form-select" name="u_role" required>
                                                    <option value="staff" <?php if($user['u_role'] == "staff"){ echo "selected";} ?>>Staff</option>
                                                    <option value="admin" <?php if($user['u_role'] == "admin"){ echo "selected";} ?>>Admin</option>
                                                </select>
                                 </div>
                              </div>
                           </div>
                           
                           <div class="mt-4">
                              <button type="submit" class="btn btn-primary w-md">Submit</button>
                           </div>
                        </form>
                     </div>
                  </div>
                  
               </div>
              
            </div>
         </div>
      </div>
      <!-- end row-->
   </div>
   <!-- container-fluid -->
</div>