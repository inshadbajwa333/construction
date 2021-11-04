<style>
td {
    width:10%;
}
</style>

    <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0">Tours</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                           
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive mb-4">
                                    <table class="table table-centered datatable dt-responsive nowrap table-card-list" style="border-collapse: collapse; border-spacing: 0 12px; width: 100%;">
                                        <thead>
                                            <tr class="bg-transparent">
                                            <th>Feature Image</th>
                                                <th>Title</th>
                                                <th>Duration</th>
                                                <th>Adult</th>
                                                <th>Child</th>
                                                <th>Infant</th>                                   
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if($tours){ ?>
                                        <?php foreach($tours as $b):
                                            $time = strtotime($b['created_at']);
                                            $dateInLocal = date("Y-m-d", $time);   ?>
                                        
                                            <tr>    
                                            <td><img src="<?=base_url()?>assets/tours/<?=$b['t_feature_img']?>" style="width:50%;"></td>
                                            <td><?=$b['t_title']?></td> 
                                            <td><?=$b['t_duration']?></td>              
                                            <td><b>Sale:</b> <?=$b['t_price']?> | <b>Cost:</b> <?=$b['t_adult_cost_price']?></td> 
                                            <td><b>Sale:</b> <?=$b['t_child_price']?> | <b>Cost:</b> <?=$b['t_child_cost_price']?></td> 
                                            <td><b>Sale:</b> <?=$b['t_infant_price']?> | <b>Cost:</b> <?=$b['t_infant_cost_price']?></td> 
                                              
                                            <td>
                                                            <ul class="list-inline mb-0">
                                                            <li class="list-inline-item">
                                                                    <a href="javascript:void(0);" class="px-2 text-<?=($b['t_status']==1)?'success':'primary'?>" title="<?=($b['t_status']==1)?'Click To Deactivate':'Click To Activate'?>"
                                                                    onclick="changeStatus('<?=$b['t_id']?>','<?=($b['t_status']==1)?'0':'1';?>')"><i class="uil uil-<?=($b['t_status']==1)?'unlock':'lock'?> font-size-18"></i></a>
                                                                </li>
                                                                <!-- <li class="list-inline-item">
                                                                    <a href="<?=base_url()?>edit-staff/<?=$b['t_id']?>" title="Edit Detail" class="px-2 text-primary"><i class="uil uil-pen font-size-18"></i></a>
                                                                </li> -->
                                                                <li class="list-inline-item">
                                                                    <a href="javascript:void(0);" onclick="drop('<?=$b['t_id']?>')"  title="Delete Tour" class="px-2 text-danger" ><i class="uil uil-trash-alt font-size-18"></i></a>
                                                                </li>
                                                            </ul>
                                                        </td>                                            
                                                
                                            </tr>
                                            <?php endforeach;?>
                                            <?php }?>

                                       
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end table -->
                            </div>
                        </div>
                        <!-- end row -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                <script>
        function changeStatus(id,status) {
         $.ajax({
             type: "POST",
             url: "<?php echo base_url('admin/Tours/changeStatus')?>",
             dataType: "JSON",
             data: {
                 id: id,
                 status: status
             },
             success: function(data) {
                if(data == "true"){
             $("#alldata").load(" #alldata");
                  alert(data);

                 } else {
                    toastr.success('Status Updated Successfully');
                           location.reload();
                 }
             }

         });
        }

        function drop(id) {
         $.ajax({
             type: "POST",
             url: "<?php echo base_url('admin/Tours/delete')?>",
             dataType: "JSON",
             data: {
                 id: id
             },
             success: function(data) {
                if(data == "true"){
             $("#alldata").load(" #alldata");
                  alert(data);

                 } else {
                    toastr.success('Tour Deleted Successfully');
                           location.reload();
                 }
             }

         });
        }
        </script>

              