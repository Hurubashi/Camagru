
function createSlider() {
    var
        sliderElem = document.querySelector('.slider'), // Slider main elem
        sliderWrapper = sliderElem.querySelector('.slider__wrapper'), // wrapper for .slider-item
        sliderItems = sliderElem.querySelectorAll('.slider__item'), // items in slider
        sliderControls = sliderElem.querySelectorAll('.slider__control'), // control elements(left, right buttons)
        sliderControlLeft = sliderElem.querySelector('.slider__control_left'), // left button
        sliderControlRight = sliderElem.querySelector('.slider__control_right'), // right button
        wrapperWidth = parseFloat(getComputedStyle(sliderWrapper).width), // Wrapper width
        itemWidth = parseFloat(getComputedStyle(sliderItems[0]).width), // One element width
        positionLeftItem = 0, // Active left element position
        transform = 0, // .slider_wrapper value
        step = itemWidth / wrapperWidth * 100, // Transformation step size
        items = [];
    // Filling item array
    sliderItems.forEach(function (index) {
        items.push({ position: index, transform: 0 });
    });

    var position = {
        getMin: 0,
        getMax: items.length - 1,
    };

    function transformItem(direction) {
        if (direction === 'right') {
            if ((positionLeftItem + wrapperWidth / itemWidth - 1) >= position.getMax) {
                return;
            }
            if (!sliderControlLeft.classList.contains('slider__control_show')) {
                sliderControlLeft.classList.add('slider__control_show');
            }
            if (sliderControlRight.classList.contains('slider__control_show') && (positionLeftItem + wrapperWidth / itemWidth) >= position.getMax) {
                sliderControlRight.classList.remove('slider__control_show');
            }
            positionLeftItem++;
            transform -= step;
        }
        if (direction === 'left') {
            if (positionLeftItem <= position.getMin) {
                return;
            }
            if (!sliderControlRight.classList.contains('slider__control_show')) {
                sliderControlRight.classList.add('slider__control_show');
            }
            if (sliderControlLeft.classList.contains('slider__control_show') && positionLeftItem - 1 <= position.getMin) {
                sliderControlLeft.classList.remove('slider__control_show');
            }
            positionLeftItem--;
            transform += step;
        }
        sliderWrapper.style.transform = 'translateX(' + transform + '%)';
    };

    function controlClick(e) {
        var direction = this.classList.contains('slider__control_right') ? 'right' : 'left';
        e.preventDefault();
        transformItem(direction);
    };

    // Adding 'click' eventListener to back and forth buttons and tun controlClick
    sliderControls.forEach(function (item) {
        item.addEventListener('click', controlClick);
    });
}

createSlider();


