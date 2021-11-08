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
    </style>

 
<div class="containe">
        
        <div class="block1">
            
            <div class="row " ><img class="ss" src="<?php echo base_url();?>assets/theme/imgs/logo.jpg" width="500" height="600"></div>
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

  

<!-- <div class="slideshow-container" > -->
<?php
$i = 1;
foreach(unserialize($data1['w_before']) as $data2):  ?>
<!-- <div class="mySlides fade" style="margin:auto;text-align:center;">
  <div class="numbertext">1 / 3</div>
  <img src="<?=base_url()?>assets/works/<?php print_r($data2); ?>" style="width:40%">
</div> -->


<?php endforeach; ?>

<!-- <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div> -->
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

                    <!-- <div class="slideshow-container" > -->
<?php
$i = 1;
foreach(unserialize($data1['w_after']) as $data2):  ?>
<!-- <div class="mySlides fade" style="margin:auto;text-align:center;">
  <div class="numbertext">1 / 3</div>
  <img src="<?=base_url()?>assets/works/<?php print_r($data2); ?>" style="width:40%">
</div> -->


<?php endforeach; ?>

<!-- <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a> -->

<!-- </div> -->
<br>
                    </div>
                   
                </div>
               <p style="padding:20px;"> <?=$data1['w_before_explain']?> </p>
            </div>
            <br>
            <div style="margin:auto;text-align:center;"><a href="<?=base_url()?>contact" class="btn btn-primary">Contact</a>
</div>

            <hr>
            <?php endforeach;?>
                                            <?php }?>
                        
                
        </div>
        
    </div>


    <script>
       var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1} 
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none"; 
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block"; 
  dots[slideIndex-1].className += " active";
}
        </script>