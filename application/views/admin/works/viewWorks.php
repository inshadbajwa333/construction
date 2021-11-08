
                <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Works | <a href="<?=base_url()?>add-work/<?php echo $this->uri->segment(2); ?>">Add New</a></h3>
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
                          <th scope="col">Work Before</th>
                          <th scope="col">Work After</th>
                          <th scope="col">Before Explain</th>
                          <th scope="col">After Explain</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                      <?php if($works){ ?>
                                        <?php foreach($works as $data1):  ?>
                        <tr>
                          <td>
                          <?php foreach(unserialize($data1['w_before']) as $data2):  ?>
                          <img src="<?=base_url()?>assets/works/<?php print_r($data2); ?>" style="width:10%;">
                          <?php endforeach; ?>
                        </td>
                          <td>  <?php foreach(unserialize($data1['w_after']) as $data2):  ?>
                          <img src="<?=base_url()?>assets/works/<?php print_r($data2); ?>" style="width:10%;">
                          <?php endforeach; ?></td>
                          <td><?=$data1['w_before_explain']?></td>
                          <!-- <td><?=$data1['w_after_explain']?></td> -->
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