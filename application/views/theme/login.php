<div id="content">
	<div class="container pt-5 pb-4">
      <div class="row">
        <div class="col-md-9 col-lg-7 col-xl-5 mx-auto">
          <div class="bg-white shadow-md rounded p-3 pt-sm-4 pb-sm-5 px-sm-5">
            
            <p class="text-4 font-weight-300 text-muted text-center mb-4">We are glad to see you again!</p>
            <?php if ($this->session->flashdata('category_error')) { ?>
                              <div class="alert alert-danger"> <?= $this->session->flashdata('category_error') ?> </div>
                          <?php } ?>
                          <form method="post" action="<?=base_url()?>Login/userLogin" >
              <div class="form-group">
                  <label for="emailAddress">Mobile or Email</label>
                  <input type="email" class="form-control" id="emailAddress" required="" placeholder="Mobile or Email" name="email">
                </div>
              <div class="form-group">
                <label for="loginPassword">Password</label>
				<input type="password" class="form-control" id="loginPassword" required="" placeholder="Password" name="password">
              </div>
              <button class="btn btn-primary btn-block my-4" type="submit">Login</button>
            </form>
		  </div>
		</div>
	  </div>
	</div>
    
  </div>