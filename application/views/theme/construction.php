<style>
    
    .slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 400px;
        margin: 0;
        opacity: 0;
        transition: 1s ease-in-out;
        overflow: hidden;
    }

    .slide img {
        width: 100%;
    }

    button {
        position: absolute;
        top: 50%;
        border: none;
        background: rgba(32, 26, 26, 0.527);
        color: rgb(243, 243, 243);
        padding: 10px 16px;
        margin-top: -25px;
        font-size: 30px;
        z-index: 1000;
        font-weight: 900;
        transition: 0.5s ease-in-out;
    }

    .prev {
        left: 0;
    }

    .next {
        right: 0;
    }


    button:hover {
        background: rgba(32, 26, 26, 0.527);
    }

    .dots_container {
        display: flex;
        margin: 5px auto;
        width: fit-content;
    }

    .dots {
        height: 12px;
        width: 12px;
        border-radius: 50%;
        background: #bdbdbd;
        margin: 4px;
    }

    .dots:hover {
        background: #696969 !important;
    }

    @media screen and (max-width:600px) {
      .slide{
        height:fit-content;
      }
      .container{
height:200px;}
    button {
        top: 50%;
    }
    }

    </style>

    <script>
         var slide = document.getElementsByClassName("slide");
        var indicator = document.getElementById("indicator");
        var dots = document.getElementsByClassName("dots");
        var autoplay = document.getElementsByClassName("container")[0].getAttribute("data-autoplay");
        var l = slide.length;
        var interval = 5000;
        var set;

        window.onload = function () {
            initialize();
            slide[0].style.opacity = "1";
            for (var j = 0; j < l; j++) {
                indicator.innerHTML += "<div class='dots' onclick=change(" + j + ")></div>";
            }

            dots[0].style.background = "#696969";

        }

        function initialize() {
            if (autoplay === "true")
                set = setInterval(function () { next(); }, interval);
        }



        function change(index) {
            clearInterval(set);
            count = index;
            for (var j = 0; j < l; j++) {
                slide[j].style.opacity = "0";
                dots[j].style.background = "#bdbdbd";
            }
            slide[count].style.opacity = "1";
            dots[count].style.background = "#696969";


        }

        var count = 0;
        function next() {
            clearInterval(set);
            slide[count].style.opacity = "0";
            count++;
            for (var j = 0; j < l; j++) {
                dots[j].style.background = "#bdbdbd";
            }


            if (count == l) {
                count = 0;
                slide[count].style.opacity = "1";
                dots[count].style.background = "#696969";

            } else {
                slide[count].style.opacity = "1";
                dots[count].style.background = "#696969";
            }
            initialize()
        }


        function prev() {
            clearInterval(set);
            slide[count].style.opacity = "0";
            for (var j = 0; j < l; j++) {
                dots[j].style.background = "#bdbdbd";
            }
            count--;

            if (count == -1) {
                count = l - 1;
                slide[count].style.opacity = "1";
                dots[count].style.background = "#696969";

            } else {
                slide[count].style.opacity = "1";
                dots[count].style.background = "#696969";
            }
            initialize()
        }
        </script>
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
                      
                          
    <div class="container" data-autoplay="true">
    <?php foreach(unserialize($data1['w_before']) as $data2):  ?>
        <div class="slide">
             <img src="<?=base_url()?>assets/works/<?php print_r($data2); ?>" alt="nature" />
            </div>
            <?php endforeach; ?>

        <button class="prev" onclick="prev()"><i class="fa fa-angle-left"></i></button>
        <button class="next" onclick="next()"><i class="fa fa-angle-right"></i></button>


    </div>
    <div class="dots_container" id="indicator"></div>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit nemo ducimus, ipsa
                        excepturi quis corporis quos nulla, consequatur error illum ab id repellendus perferendis et sed
                        fugit deserunt quisquam obcaecati! Lorem ipsum dolor sit amet consectetur adipisicing elit. Est
                        placeat quaerat aliquid modi suscipit voluptatum a maiores dolor voluptatibus fugit doloribus, rem
                        odio molestias itaque eius libero error sint mollitia earum. Neque pariatur natus, autem nostrum
                        dolor, distinctio, commodi sapiente eligendi ipsum ut cumque corporis vero minima quis aliquam
                        labore molestias sed doloremque fugit praesentium veritatis nihil! Eum tenetur ipsam porro
                        consequuntur iste veritatis ex dolorum minus recusandae, qui nemo maxime beatae reiciendis! Aliquid
                        doloremque dicta sequi cum aut esse excepturi. Maxime ullam impedit officia nobis ipsum perferendis
                        maiores quod, porro similique numquam delectus est ratione accusantium nisi labore temporibus.
                    </div>
                </div>
                <div class="col-md-6">
                    <h1 class="text-center">After</h1>
                    <div class="col-sm box-styling">
                    <?php foreach(unserialize($data1['w_after']) as $data2):  ?>
                          <img src="<?=base_url()?>assets/works/<?php print_r($data2); ?>" style="margin-left: 10px;margin-right: 10px;display: block;width:30%;">
                          <?php endforeach; ?>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit nemo ducimus, ipsa
                        excepturi quis corporis quos nulla, consequatur error illum ab id repellendus perferendis et sed
                        fugit deserunt quisquam obcaecati! Lorem ipsum dolor sit amet consectetur adipisicing elit. Est
                        placeat quaerat aliquid modi suscipit voluptatum a maiores dolor voluptatibus fugit doloribus, rem
                        odio molestias itaque eius libero error sint mollitia earum. Neque pariatur natus, autem nostrum
                        dolor, distinctio, commodi sapiente eligendi ipsum ut cumque corporis vero minima quis aliquam
                        labore molestias sed doloremque fugit praesentium veritatis nihil! Eum tenetur ipsam porro
                        consequuntur iste veritatis ex dolorum minus recusandae, qui nemo maxime beatae reiciendis! Aliquid
                        doloremque dicta sequi cum aut esse excepturi. Maxime ullam impedit officia nobis ipsum perferendis
                        maiores quod, porro similique numquam delectus est ratione accusantium nisi labore temporibus.
                    </div>
                </div>
            </div>

            <hr>
            <?php endforeach;?>
                                            <?php }?>
                        
                
        </div>
        
    </div>