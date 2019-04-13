<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="/components/css/slider.css">

<body>

<div class="slider">
    <div class="slider__wrapper">
        <?php
        $i = 0;
        while ($i < 10) {

            echo "
            <div class=\"slider__item\">
                    <img class=\"assetImg\" src=\"/components/images/180.jpg\">
            </div>
            ";
            $i++;
        }
        ?>

    </div>
    <a class="slider__control slider__control_left" href="#" role="button"></a>
    <a class="slider__control slider__control_right slider__control_show" href="#" role="button"></a>
</div>

<script src="/components/js/slider.js"></script>


</body>
</html>