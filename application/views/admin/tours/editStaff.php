<div class="main-content">
<div class="page-content">
<div class="container-fluid">
   <!-- start page title -->
   <div class="row">
      <div class="col-12">
         <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Staff</h4>
            
         </div>
      </div>
   </div>
   <!-- end page title -->
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Add Staff</h4>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="mt-4">
                     <form method="post" enctype="multipart/form-data" action="<?=base_url()?>admin/Staff/update" >
                           <div class="row">
                                <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-email-input">Role</label>
                                  
                                                <select class="form-select" name="role_id">
                                                <?php
                            if($roles){
                            foreach($roles as $data => $value){
                            if(is_array($value)):
                            foreach($value as $data1){
                            ?>
                              <option value="<?=$data1['_id']?>"  <?php if($data1['_id'] == $editstaff['data']['roles'][0]){ echo "selected";} ?>><?=$data1['name']?></option>
                              <?php
                                 }
                                 endif;
                                 }
                                 }?>
                            </select>
                                   
                                 </div>
                              </div>
                             
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-email-input">Id Type</label>
                                    <select class="form-select" name="id_type">
                                                    <option value="pp" <?php if($editstaff['data']['id_type'] == "pp"){ echo "selected";} ?>>Passport</option>
                                                    <option value="eid" <?php if($editstaff['data']['id_type'] == "eid"){ echo "selected";} ?>>Emirates Id</option>
                                                    <option value="dl" <?php if($editstaff['data']['id_type'] == "dl"){ echo "selected";} ?>>Driving License</option>
                                                </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-password-input">Id No</label>
                                    <input   type="hidden"  name="_id" value="<?=$editstaff['data']['_id']?>">
                                    <input type="text" class="form-control" id="formrow-password-input" name="id_no" value="<?=$editstaff['data']['id_no']?>">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                           <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-password-input">Full Name</label>
                                    <input type="text" class="form-control" id="formrow-password-input" name="name" value="<?=$editstaff['data']['name']?>">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-email-input">Email</label>
                                    <input type="email" class="form-control" id="formrow-email-input" name="email" value="<?=$editstaff['data']['email']?>">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-password-input">Phone Number</label>
                                    <input type="text" class="form-control" id="formrow-password-input" name="phone" value="<?=$editstaff['data']['phone']?>">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                           
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-password-input">Picture</label>
                                    <input class="form-control" type="file" name="editImage">
                                    <input class="form-control" type="hidden" name="image" value="<?php echo $editstaff['data']['id_pic'];  ?>">
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