<div class="main-content">
<div class="page-content">
   <div class="container-fluid">
      <!-- start page title -->
      <div class="row">
         <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
               <h4 class="mb-0">User Detail</h4>
            </div>
         </div>
      </div>
      <!-- end page title -->
      <div class="row">
      <div class="row mb-4">
                            <div class="col-xl-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <div class="dropdown float-end">
                                                <a class="text-body dropdown-toggle font-size-18" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="uil uil-ellipsis-v"></i>
                                                </a>
                                              
                                                <div class="dropdown-menu dropdown-menu-end" style="margin: 0px;">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">Action</a>
                                                    <a class="dropdown-item" href="#">Remove</a>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div>
                                                <img src="https://s2rapp.com/demo/wp-content/uploads/2020/06/User_icon-1.png" alt="" class="avatar-lg rounded-circle img-thumbnail">
                                            </div>
                                            <h5 class="mt-3 mb-1"><?=$view['data']['name']?></h5>
                                            <p class="text-muted">Customer</p>

                                            <div class="mt-4">
                                                <a href="mailto:<?=$view['data']['email']?>"><button type="button" class="btn btn-light btn-sm"><i class="uil uil-envelope-alt me-2"></i> Message</button></a>
                                            </div>
                                        </div>

                                        <hr class="my-4">

                                        <div class="text-muted">
                                            <h5 class="font-size-16">About</h5>
                                            <p>Hi I'm <?=$view['data']['name']?></p>
                                            <div class="table-responsive mt-4">
                                                <div>
                                                    <p class="mb-1">Name :</p>
                                                    <h5 class="font-size-16"><?=$view['data']['name']?></h5>
                                                </div>
                                                <div class="mt-4">
                                                    <p class="mb-1">Mobile :</p>
                                                    <h5 class="font-size-16"><?=$view['data']['phone']?></h5>
                                                </div>
                                                <div class="mt-4">
                                                    <p class="mb-1">E-mail :</p>
                                                    <h5 class="font-size-16"><?=$view['data']['email']?></h5>
                                                </div>
                                                <div class="mt-4">
                                                    <p class="mb-1">Location :</p>
                                                    <h5 class="font-size-16"><?=$view['data']['delivery_address']['address']?></h5>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-8">
                                <div class="card mb-0">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                        
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#tasks" role="tab" aria-selected="true">
                                                <i class="uil uil-clipboard-notes font-size-20"></i>
                                                <span class="d-none d-sm-block">Orders</span> 
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab" aria-selected="false">
                                                <i class="uil uil-envelope-alt font-size-20"></i>
                                                <span class="d-none d-sm-block">Reviews</span>   
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#about" role="tab" aria-selected="false">
                                                <i class="uil uil-user-circle font-size-20"></i>
                                                <span class="d-none d-sm-block">Wallet</span> 
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Tab content -->
                                    <div class="tab-content p-4">
                                        <div class="tab-pane active" id="tasks" role="tabpanel">
                                            <div>
                                                <h5 class="font-size-16 mb-3">Orders</h5>

                                                <div class="table-responsive">
                                                    <table class="table table-nowrap table-centered">
                                                        <tbody>
                                                        <?php if($view['data']['orders']){
                                 foreach($view['data']['orders'] as $data2){
                                   
                                 ?>
                                                            <tr>
                                                                <td>
                                                                    <a href="#" class="fw-bold text-dark"><?=$data2['order_id']?></a>
                                                                </td>
                                                                
                                                                <td><?=$data2['createdAt']?></td>
                                                                <td style="width: 160px;"><span class="badge bg-soft-<?php 
                                                        if($data2['order_status']=="orderCompleted"){
                                                            echo "success";
                                                        }elseif($data2['order_status']=="rejectedOrder"){
                                                            echo "danger";
                                                        }elseif($data2['order_status']=="OrderPreparing"){
                                                            echo "warning";
                                                        }elseif($data2['order_status']=="newOrder"){
                                                            echo "success";
                                                        }else{
                                                            echo "danger";
                                                        }?> font-size-12"> <?php 
                                                        if($data2['order_status']=="orderCompleted"){
                                                            echo "Order Completed";
                                                        }elseif($data2['order_status']=="rejectedOrder"){
                                                            echo "Order Rejected";
                                                        }elseif($data2['order_status']=="OrderPreparing"){
                                                            echo "Order Preparing";
                                                        }elseif($data2['order_status']=="newOrder"){
                                                            echo "New Order";
                                                        }else{
                                                            echo "Order Cancelled";
                                                        }
                                                        ?></span></td>
                                                                
                                                            </tr>
                                                            <?php 
                                 }
                                }
                                                            ?>
                                                           
                                                        </tbody>
                                                    </table>
                                                </div>

                                                

                                                <h5 class="font-size-16 my-3">Complete</h5>

                                                <div class="table-responsive">
                                                    <table class="table table-nowrap table-centered">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width: 60px;">
                                                                    <div class="form-check font-size-16 text-center">
                                                                        <input type="checkbox" class="form-check-input" id="tasks-completeCheck3">
                                                                        <label class="form-check-label" for="tasks-completeCheck3"></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="fw-bold text-dark">UI Elements</a>
                                                                </td>
                                                                
                                                                <td>27 May, 2020</td>
                                                                <td style="width: 160px;"><span class="badge bg-soft-success font-size-12">Complete</span></td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-check font-size-16 text-center">
                                                                        <input type="checkbox" class="form-check-input" id="tasks-completeCheck2">
                                                                        <label class="form-check-label" for="tasks-completeCheck2"></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="fw-bold text-dark">Authentication Pages</a>
                                                                </td>
                                                                
                                                                <td>27 May, 2020</td>
                                                                <td><span class="badge bg-soft-success font-size-12">Complete</span></td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div class="form-check font-size-16 text-center">
                                                                        <input type="checkbox" class="form-check-input" id="tasks-completeCheck1">
                                                                        <label class="form-check-label" for="tasks-completeCheck1"></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="fw-bold text-dark">Admin Layout</a>
                                                                </td>
                                                                
                                                                <td>26 May, 2020</td>
                                                                <td><span class="badge bg-soft-success font-size-12">Complete</span></td>
                                                                
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="messages" role="tabpanel">
                                            <div>
                                                <div data-simplebar="init" style="max-height: 430px;"><div class="simplebar-wrapper" style="margin: 0px;"><div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div><div class="simplebar-mask"><div class="simplebar-offset" style="right: 0px; bottom: 0px;"><div class="simplebar-content-wrapper" style="height: auto; overflow: hidden;"><div class="simplebar-content" style="padding: 0px;">
                                                <?php if($reviews){
                                 foreach($reviews['data'] as $data1){
                                   
                                 ?>
                                 <h4><b>Order id:</b> #<?=$data1['order_id']?></h4>
                                 <?php if($data1['restaurant_review']){ ?>
                                 
                                                <div class="d-flex align-items-start border-bottom py-4">                                                    
                                                        <div class="flex-1">
                                                            <h5 class="font-size-15 mt-0 mb-1">Restaurant: <?=$data1['restaurant_review']['rest_id']['name']; ?><small class="text-muted float-end">1 hr ago</small></h5>
                                                            <p class="text-muted"><?=$data1['restaurant_review']['comment']; ?></p>
                                                            <div class="badge bg-success mb-2 badge bg-success font-size-14 me-1"><i class="uil uil-star"></i> <?=$data1['restaurant_review']['rating']; ?></div>
            
                                                        </div>
                                                    </div>
                                                    <?php }?>

                                                    <?php if($data1['delivery_review']){ ?>
                                 
                                 <div class="d-flex align-items-start border-bottom py-4">                                                    
                                         <div class="flex-1">
                                             <h5 class="font-size-15 mt-0 mb-1">Delviery Boy: <?=$data1['delivery_review']['delivery_boy_id']['name']; ?><small class="text-muted float-end">1 hr ago</small></h5>
                                             <p class="text-muted"><?=$data1['delivery_review']['comment']; ?></p>
                                             <div class="badge bg-success mb-2 badge bg-success font-size-14 me-1"><i class="uil uil-star"></i> <?=$data1['delivery_review']['rating']; ?></div>

                                         </div>
                                     </div>
                                     <?php }?>

                                                    <?php 
                                 
                                 }
                                }
                                                    ?>

    
                                                </div></div></div></div><div class="simplebar-placeholder" style="width: 0px; height: 0px;"></div></div><div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none;"></div></div><div class="simplebar-track simplebar-vertical" style="visibility: hidden;"><div class="simplebar-scrollbar" style="transform: translate3d(0px, 0px, 0px); display: none; height: 376px;"></div></div></div>
        
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

