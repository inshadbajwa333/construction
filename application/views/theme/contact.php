
<div class="containe">
        
        <div class="block1">
            
            <div class="row " >
               
            <!-- <div class="row " ><h1 class="sss">REFORMAS OBASY</h1></div>
            <div class="row " ><p class="ss">Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</p></div> -->
           
            <div class="container">
    <h2 class="text-center">Contac Form</h2>
	<div class="row justify-content-center">
		<div class="col-12 col-md-8 col-lg-6 pb-5">


                    <!--Form with header-->

                    <form action="<?=base_url()?>Main/contactsubmit" method="post">
                        <div class="card border-primary rounded-0">
                            <div class="card-header p-0">
                                <div class="bg-info text-white text-center py-2">
                                  
                                </div>
                            </div>
                            <div class="card-body p-3">
<?php
if(!empty($_GET['type'])){
$type = $_GET['type'];
}else{
    $type = "direct";
}
?>
                                <!--Body-->
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                        </div>
                                        <input type="hidden" class="form-control" id="nombre" name="type" placeholder="Name" value="<?php echo $type; ?>" required>
                                        <input type="text" class="form-control" id="nombre" name="name" placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                        </div>
                                        <input type="email" class="form-control" id="nombre" name="email" placeholder="Email" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                                        </div>
                                        <textarea class="form-control" placeholder="Message" name="message" required></textarea>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <input type="submit" value="Contact" class="btn btn-info btn-block rounded-0 py-2">
                                </div>
                            </div>

                        </div>
                    </form>
                    <!--Form with header-->


                </div>
	</div>
</div>
                
        </div>
        
    </div>

