<?php
//$session = $this->request->session();
//print_r($session->read());
?>

<div class="banner index large-9 medium-8 columns content">
    <h3 style="text-align: center"><?= __('Banner') ?></h3>


    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php
            $num = 0;
            foreach ($banner as $teste):
                ?>            
                <li data-target="#myCarousel" data-slide-to="<?= $num; ?>" <?php if($num==0){echo"class='active'";};?>></li>
                <?php
                $num++;
            endforeach;
            ?>
        </ol>

        <div class="carousel-inner" role="listbox">
            <?php
            $primeiroBan = 1;
            foreach ($banner as $banner):
                ?>
                <?php if ($primeiroBan == 1) { ?>
                    <div class="item active">
                        <?php
                        $primeiroBan = 0;
                    } else {
                        ?>
                        <div class="item">
                            <?php
                        }
                        echo $this->Html->image($banner->img, array('class'=>'imge'));
                        ?>        
                    </div>     
                    <?php endforeach; ?>
            </div>
        </div>

    </div>