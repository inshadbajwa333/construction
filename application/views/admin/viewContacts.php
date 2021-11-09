
                <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Contacts </h3>
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
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Message</th>
                          <th scope="col">Type</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                      <?php if($contacts){ ?>
                                        <?php foreach($contacts as $data1):  ?>
                        <tr>
                          <td><?=$data1['name']?></td>
                          <td><?=$data1['email']?></td>
                          <td><?=$data1['message']?></td>
                          <td><?=$data1['type']?></td>
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