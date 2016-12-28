
var ComponentsjQueryUISliders = function () {

    return {
        //main function to initiate the module
        init: function () {
            // basic
            $(".slider-basic").slider(); // basic sliders

             // vertical range sliders
            $("#slider-range").slider({
                isRTL: Metronic.isRTL(),
                range: true,
                values: [17, 67],
                slide: function (event, ui) {
                    $("#slider-range-amount").text("$" + ui.values[0] + " - $" + ui.values[1]);
                }
            });
            
            // snap inc
            $("#slider-snap-inc").slider({
                isRTL: Metronic.isRTL(),
                value: 100,
                min: 0,
                max: 1000,
                step: 100,
                slide: function (event, ui) {
                    $("#slider-snap-inc-amount").text("$" + ui.value);
                }
            });

            $("#slider-snap-inc-amount").text("$" + $("#slider-snap-inc").slider("value"));

            // range slider
            $("#slider-range").slider({
                isRTL: Metronic.isRTL(),
                range: true,
                min: 0,
                max: 500,
                values: [75, 300],
                slide: function (event, ui) {
                    $("#slider-range-amount").text("$" + ui.values[0] + " - $" + ui.values[1]);
                }
            });

            $("#slider-range-amount").text("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));

            //range max

            $("#slider-range-max").slider({
                isRTL: Metronic.isRTL(),
                range: "max",
                min: 1,
                max: 30,
                value: 1,
                slide: function (event, ui) {
                    $("#slider-range-max-amount").text(ui.value);
                }
            });

            $("#slider-range-max-amount").text($("#slider-range-max").slider("value"));

            $("#slider-range-max2").slider({
                isRTL: Metronic.isRTL(),
                range: "max",
                min: 1,
                max: 5,
                value: 1,
                slide: function (event, ui) {
                    $("#slider-range-max-amount2").text(ui.value);
                    $('lenhid').text("hh");
                }
            });

            $("#slider-range-max-amount2").text($("#slider-range-max2").slider("value"));

            $("#slider-range-max3").slider({
                isRTL: Metronic.isRTL(),
                range: "max",
                min: 1,
                max: 5,
                value: 1,
                slide: function (event, ui) {
                    $("#slider-range-max-amount3").text(ui.value);
                }
            });

            $("#slider-range-max-amount3").text($("#slider-range-max3").slider("value"));

            $("#slider-range-max4").slider({
                isRTL: Metronic.isRTL(),
                range: "max",
                min: 1,
                max: 5,
                value: 1,
                slide: function (event, ui) {
                    $("#slider-range-max-amount4").text(ui.value);
                }
            });

            $("#slider-range-max-amount4").text($("#slider-range-max4").slider("value"));

            $("#slider-range-max5").slider({
                isRTL: Metronic.isRTL(),
                range: "max",
                min: 1,
                max: 230,
                value: 1,
                slide: function (event, ui) {
                    $("#slider-range-max-amount5").text(ui.value);
                }
            });

            $("#slider-range-max-amount5").text($("#slider-range-max5").slider("value"));

            $("#slider-range-max6").slider({
                isRTL: Metronic.isRTL(),
                range: "max",
                min: 1,
                max: 5,
                value: 1,
                slide: function (event, ui) {
                    $("#slider-range-max-amount6").text(ui.value);
                }
            });

            $("#slider-range-max-amount6").text($("#slider-range-max6").slider("value"));

            // range min
            $("#slider-range-min").slider({
                isRTL: Metronic.isRTL(),
                range: "min",
                value: 37,
                min: 1,
                max: 700,
                slide: function (event, ui) {
                    $("#slider-range-min-amount").text("$" + ui.value);
                }
            });

            $("#slider-range-min-amount").text("$" + $("#slider-range-min").slider("value"));

            // vertical slider
            $("#slider-vertical").slider({
                isRTL: Metronic.isRTL(),
                orientation: "vertical",
                range: "min",
                min: 0,
                max: 100,
                value: 60,
                slide: function (event, ui) {
                    $("#slider-vertical-amount").text(ui.value);
                }
            });
            $("#slider-vertical-amount").text($("#slider-vertical").slider("value"));

            // vertical range sliders
            $("#slider-range-vertical").slider({
                isRTL: Metronic.isRTL(),
                orientation: "vertical",
                range: true,
                values: [17, 67],
                slide: function (event, ui) {
                    $("#slider-range-vertical-amount").text("$" + ui.values[0] + " - $" + ui.values[1]);
                }
            });

            $("#slider-range-vertical-amount").text("$" + $("#slider-range-vertical").slider("values", 0) + " - $" + $("#slider-range-vertical").slider("values", 1));

        }

    };

}();