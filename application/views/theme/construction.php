<style>
    
   
/* slideshow taşıyıcı */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* varsayılan olarak görselleri gizliyoruz */
.mySlides {
  display: none;
}

/* sonraki ve önceki butonları */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  margin-top: -22px;
  padding: 16px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* sonraki butonunun pozisyonu */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* üzerine gelince hafif bir efekt verelim */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* görsel başlığı */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* görsel numaraları */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* nokta navigasyonu */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* geçiş animasyonu */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1.5s;
}

@-webkit-keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}
.fade {
    opacity: 1 !important;
    transition: opacity .15s linear;
}


.carousel-inner img {
    width: 100%;
    height: 100%
}

.carousel-item img {
    width: 80%
}



.carousel-caption {
    position: initial;
    z-index: 10;
    padding: 5rem 8rem;
    color: rgba(78, 77, 77, 0.856);
    text-align: center;
    font-size: 1.2rem;
    font-style: italic;
    font-weight: bold;
    line-height: 2rem
}

@media(max-width:767px) {
    .carousel-caption {
        position: initial;
        z-index: 10;
        padding: 3rem 2rem;
        color: rgba(78, 77, 77, 0.856);
        text-align: center;
        font-size: 0.7rem;
        font-style: italic;
        font-weight: bold;
        line-height: 1.5rem
    }
}

.carousel-caption img {
    width: 6rem;
    border-radius: 5rem;
    margin-top: 2rem
}

@media(max-width:767px) {
    .carousel-caption img {
        width: 4rem;
        border-radius: 4rem;
        margin-top: 1rem
    }
}

#image-caption {
    font-style: normal;
    font-size: 1rem;
    margin-top: 0.5rem
}

@media(max-width:767px) {
    #image-caption {
        font-style: normal;
        font-size: 0.6rem;
        margin-top: 0.5rem
    }
}

i {
    background-color: rgb(223, 56, 89);
    padding: 1.4rem
}

@media(max-width:767px) {
    i {
        padding: 0.8rem
    }
}

.carousel-control-prev {
    justify-content: flex-start
}

.carousel-control-next {
    justify-content: flex-end
}

.carousel-control-prev,
.carousel-control-next {
    transition: none;
    opacity: unset
}
    </style>
    <style>


     <?php if($works){ ?>
                                        <?php foreach($works as $data1):  ?>
                                          <?php
for($i=1;$i<=count(unserialize($data1['w_after']));$i++){?>
<?php

foreach(unserialize($data1['w_before']) as $data2):  ?>
<?php echo "#custCarousel-".$i." .carousel-indicators {
    position: static;
    margin-top: 20px
}

#custCarousel-".$i." .carousel-indicators>li {
    width: 100px
}

#custCarousel-".$i." .carousel-indicators li img {
    display: block;
    opacity: 0.5
}

#custCarousel-".$i." .carousel-indicators li.active img {
    opacity: 1
}

#custCarousel-".$i." .carousel-indicators li:hover img {
    opacity: 0.75
} 
#demo-".$i." {
  background: linear-gradient(112deg, #ffffff 50%, antiquewhite 50%);
  max-width: 900px;
  margin: auto
}"?>
<?php endforeach; 
}?>
<?php endforeach;?>
                                            <?php }?>
                                            </style>
<div class="container">
        
        <div class="block1">
            
            <div class="row " >
              <img class="ss" src="<?php echo base_url();?>assets/theme/imgs/logo.jpg" width="500" height="600"></div>
            <!-- <div class="row " ><h1 class="sss">REFORMAS OBASY</h1></div>
            <div class="row " ><p class="ss">Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.</p></div> -->
            <?php if($works){ ?>
                                        <?php foreach($works as $data1):  ?>
            <div class="row">
                <div class="col-md-6">
                    <h1 class="text-center">Before</h1>
                    <div class="col-sm box-styling">
                        
                    <?php
                      $i = 1;
                      foreach(unserialize($data1['w_before']) as $data2):  ?>
                        <img src="<?=base_url()?>assets/works/<?php print_r($data2); ?>" style="width:30%">
                      <?php endforeach; ?>

                      <br>
                       
                    </div>
                </div>
                <div class="col-md-6">
                    <h1 class="text-center">After</h1>
                    <div class="col-sm box-styling">
                    <?php
                    $i = 1;
                    foreach(unserialize($data1['w_after']) as $data2):  ?>
                      <img src="<?=base_url()?>assets/works/<?php print_r($data2); ?>" style="width:30%">
                    <?php endforeach; ?>
                    <br>
                    </div>
                   
                </div>
               <p style="padding:20px;"> <?=$data1['w_before_explain']?> </p>
            </div>
            <br>
            <div style="margin:auto;text-align:center;"><a href="<?=base_url()?>contact?type=construction" class="btn btn-primary">Contact</a>
          </div>

            <hr>
            <?php endforeach;?>
             <?php }?>
                        
                
        </div>
        
    </div>





            <div class="container">
          
                <div id="demo" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                  <?php
              for($i=1;$i<=count(unserialize($data1['w_before']));$i++){
                foreach(unserialize($data1['w_before']) as $data2):
                ?>
                      <div class="carousel-item <?php if($i==1) { echo 'active';} ?>">
                          <div class="carousel-caption">
                            <img src="<?=base_url()?>assets/works/<?php print_r($data2); ?>"  <?php if($i>1) {?> class="img-fluid" <?php } ?> >
                          </div>
                      </div>
                      <?php
                        endforeach;  
                        }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#demo" data-slide="prev"> <i class='fas fa-arrow-left'></i> </a> 
                    <a class="carousel-control-next" href="#demo" data-slide="next"> <i class='fas fa-arrow-right'></i> </a>
                    </div>
                   
                </div>



                <div class="container">
          
                <div id="demo1" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                  <?php
              for($i=1;$i<=count(unserialize($data1['w_after']));$i++){
                foreach(unserialize($data1['w_after']) as $data2):
                ?>
                      <div class="carousel-item <?php if($i==1) { echo 'active';} ?>">
                          <div class="carousel-caption">
                            <img src="<?=base_url()?>assets/works/<?php print_r($data2); ?>"  <?php if($i>1) {?> class="img-fluid" <?php } ?> >
                          </div>
                      </div>
                      <?php
                        endforeach;  
                        }
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#demo1" data-slide="prev"> <i class='fas fa-arrow-left'></i> </a> 
                    <a class="carousel-control-next" href="#demo1" data-slide="next"> <i class='fas fa-arrow-right'></i> </a>
                    </div>
                   
                </div>