<div class="main-content">
<div class="page-content">
<div class="container-fluid">
   <!-- start page title -->
   <div class="row">
      <div class="col-12">
         <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0">Tours</h4>
         </div>
      </div>
   </div>
   <!-- end page title -->
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               <h4 class="card-title">Add New Tour</h4>
               <div class="row">
                  <div class="col-lg-12">
                     <div class="mt-4">
                     <form method="post" enctype="multipart/form-data" action="<?=base_url()?>admin/Tours/createTour" >
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-email-input">Title</label>
                                    
                                    <input type="text" class="form-control" id="formrow-password-input" name="t_title" placeholder="English Title">
                                    <input type="text" class="form-control" id="formrow-password-input" name="t_ar_title" placeholder="Arabic Title">
                                   
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-email-input">Tour Type</label>
                                    <select class="form-select" name="t_type">
                                                    <option value="desert">Desert Activities</option>
                                                    <option value="sightseeing">Sightseeing Tour</option>
                                                    <option value="adventure">Adventure</option>
                                                    <option value="excursions">Excursions</option>
                                                    <option value="free">Free Activities</option>
                                                    <option value="theme">Theme Parks</option>
                                                    <option value="water">Water Activiites</option>
                                                </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-password-input">Tour Duration</label>
                                    <input type="text" class="form-control" id="formrow-password-input" placeholder="3 Hours 45 minutes" name="t_duration">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                           <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-password-input">Location</label>
                                    <select class="form-select" name="t_location">
                                                    <option value="dubai">Dubai</option>
                                                    <option value="abudhabi">Abu Dhabi</option>
                                                    <option value="sharjah">Sharjah</option>
                                                    <option value="ajman">Ajman</option>
                                                    <option value="fujairah">Al Fujairah</option>
                                                    <option value="rak">Ras Al Khaimah</option>
                                                </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-email-input">Feature Image</label>
                                    <input type="file" class="form-control" id="t_feature_img" name="t_feature_img" >
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-password-input">Gallery</label>
                                    <input type="file" class="form-control" id="t_images" name='t_images[]' multiple="">
                                 </div>
                              </div>
                              
                           </div>
                           
                           <div class="row">
                           <div class="col-md-2">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-password-input">Adult Price</label>                                   
                                 </div>
                              </div>
                              <div class="col-md-5">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-password-input">Sale Price</label>
                                    <input type="text" class="form-control" id="formrow-password-input" name="t_price">
                                 </div>
                              </div>
                              <div class="col-md-5">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-password-input">Cost Price</label>
                                    <input type="text" class="form-control" id="formrow-password-input" name="t_adult_cost_price">
                                 </div>
                              </div>                              
                           </div>
                           <div class="row">
                           <div class="col-md-2">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-password-input">Child Price</label>
                                 </div>
                              </div>
                              <div class="col-md-5">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-password-input">Sale Price</label>
                                    <input type="text" class="form-control" id="formrow-password-input" name="t_child_price">
                                 </div>
                              </div>
                              <div class="col-md-5">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-password-input">Cost Price</label>
                                    <input type="text" class="form-control" id="formrow-password-input" name="t_child_cost_price">
                                 </div>
                              </div>                              
                           </div>
                           
                           <div class="row">
                           <div class="col-md-2">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-password-input">Infant Price </label>
                                 </div>
                              </div>
                              <div class="col-md-5">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-password-input">Sale Price</label>
                                    <input type="text" class="form-control" id="formrow-password-input" name="t_infant_price">
                                 </div>
                              </div>
                              <div class="col-md-5">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-password-input">Cost Price</label>
                                    <input type="text" class="form-control" id="formrow-password-input" name="t_infant_cost_price">
                                 </div>
                              </div>                              
                           </div>

                           <div class="row">
                           <div class="col-md-12">
                                 <div class="mb-2">
                                    <label class="form-label" for="formrow-password-input">Description </label>
                                    <textarea class="form-control" id="summernote" name="t_desc"></textarea>
                                    
                                 </div>
                              </div>      
                              
                              <div class="col-md-12">
                                 <div class="mb-2">
                                    <label class="form-label" for="formrow-password-input">Arabic Description </label>
                                    <textarea class="form-control" id="summernote1" name="t_ar_desc"></textarea>
                                    
                                 </div>
                              </div>  
                           </div>

                           <div class="row">
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-email-input">Meta Title</label>
                                    
                                    <input type="text" class="form-control" id="t_meta_title" name="t_meta_title" placeholder="Enter meta title here">
                                  
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-email-input">Meta Slug</label>
                                    <input type="text" class="form-control" id="t_meta_slug" name="t_meta_slug" placeholder="Enter slug here">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-password-input">Meta Keywords</label>
                                    <input type="text" class="form-control" id="formrow-password-input" placeholder="Enter meta keywords here" name="t_meta_keyword">
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="mb-3">
                                    <label class="form-label" for="formrow-email-input">Meta Description</label>
                                    
                                    <textarea class="form-control" id="editor" name="t_meta_desc" placeholder="Enter meta Description here"></textarea>
                                  
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

<script>
   $("#t_meta_title").keyup(function(){
        var Text = $(this).val();
        Text = Text.toLowerCase();
        Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
        $("#t_meta_slug").val(Text);        
});
   </script>