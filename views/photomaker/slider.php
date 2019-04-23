<!DOCTYPE html>
<html lang="en">

<link rel="stylesheet" href="/components/css/slider.css">

<body>

<div class="slider">
    <div class="slider__wrapper">
        <?php
        $path = ROOT . '/components/effects/';
        $images = glob("$path{*.jpg,*.png}", GLOB_BRACE);
        foreach($images as $image) {
            $imagePath = explode('/', $image);
            $imageName = end($imagePath);
            echo "<div class=\"slider__item\">";
            echo        "<img class=\"assetImg\" src=\"/components/effects/$imageName\">";
            echo "</div>";
        }
        ?>
    </div>
    <a class="slider__control slider__control_left" href="#" role="button"></a>
    <a class="slider__control slider__control_right slider__control_show" href="#" role="button"></a>
</div>

<script src="/components/js/slider.js"></script>


</body>
</html>