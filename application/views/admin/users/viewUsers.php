
                <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Users | <a href="<?=base_url()?>add-user">Add New User</a></h3>
                </div>
               
              </div>
            </div>
          </div>
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                 
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                      <tr>
                          <th scope="col">UserName</th>
                          <th scope="col">Email</th>
                          <th scope="col">Phone</th>
                          <th scope="col">Password</th>
                          <th scope="col">Bio</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                      <?php if($users){ ?>
                                        <?php foreach($users as $data1):  ?>
                        <tr>
                          <td><a href="<?=base_url()?>all-work/<?=$data1['users_id']?>" style="color:blue;"><?=$data1['users_username']?></a></td>
                          <td><?=$data1['users_email']?></td>
                          <td><?=$data1['users_phone']?></td>
                          <td><?=$data1['password']?></td>
                          <td><?=$data1['users_bio']?></td>
                        </tr>
                        <?php endforeach;?>
                                            <?php }?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            
            </div>
          </div>