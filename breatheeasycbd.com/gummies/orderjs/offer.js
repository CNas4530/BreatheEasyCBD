var exitPop = true;

function updateReviewTotal(){
    var total = 0;
    $("table").find(".amount").each(function () {
        if ($(this).parent().parent().find(":checkbox").prop("checked")){
            total += parseFloat($(this).html());
        }
    });
    $("#total").html(total.toFixed(2));
};


$(document).ready(function() {

    $('.discount-confirmation').delay(2000).slideDown();

    $(".product-option").click(function(){
        $(".checked").removeClass("checked");
        $(this).addClass("checked");

        var ID = $(this).children(".ID").html();
        var billAmount = $(this).children(".price").children(".amount").html();
        var shipAmount = $(this).children(".shipAmount").html();
        var unitCount = $(this).children(".unitCount").html();
        var bottleMSRP = $("#bottleMSRP").html();
        var perBottle = $("#perBottle").html();
        var currencySymbol = $("#currencySymbol").html();
        var currencyCode = $("#currencyCode").html();

        if( billAmount.charAt( 0 ) === "$" ){
            billAmount = billAmount.slice( 1 );
        }
        if( billAmount.charAt( 0 ) === "€" ){
            billAmount = billAmount.slice( 1 );
        }
        if( billAmount.charAt( 0 ) === "R" ){
            billAmount = billAmount.slice( 1 );
        }
        if( billAmount.charAt( 0 ) === "£" ){
            billAmount = billAmount.slice( 1 );
        }

        if( shipAmount.charAt( 0 ) === "$" ){
            shipAmount = shipAmount.slice( 1 );
        }
        if( shipAmount.charAt( 0 ) === "€" ){
            shipAmount = shipAmount.slice( 1 );
        }
        if( shipAmount.charAt( 0 ) === "R" ){
            shipAmount = shipAmount.slice( 1 );
        }
        if( shipAmount.charAt( 0 ) === "£" ){
            shipAmount = shipAmount.slice( 1 );
        }

        if(shipAmount == 0){
            $(".shipping-type").html("<strong>FREE</strong> Priority Shipping");
        }
        else {
            $(".shipping-type").html("Shipping");
        }

        if (perBottle == 1){
            var newTotal = (parseFloat(billAmount) * parseFloat(unitCount)) + parseFloat(shipAmount);
        }
        else {
            var newTotal = parseFloat(billAmount)+parseFloat(shipAmount);
        }

        var newMSRP = parseFloat(bottleMSRP)*parseFloat(unitCount);
        var youSave = parseFloat(newMSRP)-parseFloat(newTotal);

        $(".shipping-price").html(currencySymbol+shipAmount);
        $(".checkout-total").html(currencySymbol+newTotal.toFixed(2)+" "+currencyCode);
        $(".retail-price").html(currencySymbol+newMSRP.toFixed(2));
        $(".you-save").html(currencySymbol+youSave.toFixed(2));
        $("#ID").val(ID);
        
    });

    $("#partialform").submit(function() {
        exitPop = false;
    });

    $("#partialform").validate({

        submitHandler: function(form){
            $('.sf-back-overlay').show();
            $('.sf-qualify-wrap').show();
            setTimeout(function () {
                form.submit();
            }, 2000);
        },

        invalidHandler: function(event, validator) {
            exitPop = true;
            var errors = validator.numberOfInvalids();
            if (errors) {
                var message = errors == 1
                    ? "You have 1 field with an error. It has been highlighted"
                    : "You have " + errors + " errors.  They have been highlighted";
                $("#requiredError").html(message);
            } else {
                $("#requiredError").html("");
            }
        },
        errorPlacement: function(error, element) { },
        rules: {
            firstname: "required",
            lastname: "required",
            address: "required",
            city: "required",
            country: "required",
            state: "required",
            zipcode: "required",
            phone: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            email: {
                required: true,
                email: true
            }
        }
    });

    $("#fullpartialform").validate({

        submitHandler: function(form){
            $('.sf-back-overlay').show();
            $('.sf-qualify-wrap').show();
            setTimeout(function () {
                form.submit();
            }, 2000);
        },

        invalidHandler: function(event, validator) {
            exitPop = true;
            var errors = validator.numberOfInvalids();
            if (errors) {
                var message = errors == 1
                    ? "You have 1 field with an error. It has been highlighted"
                    : "You have " + errors + " errors.  They have been highlighted";
                $("#requiredError").html(message);
            } else {
                $("#requiredError").html("");
            }
        },
        errorPlacement: function(error, element) { },
        rules: {
            firstname: "required",
            lastname: "required",
            address: "required",
            city: "required",
            country: "required",
            state: "required",
            zipcode: "required",
            phone: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            email: {
                required: true,
                email: true
            }
        }
    });


    $("#shortcheckoutform").submit(function() {
        exitPop = false;
    });

    $("#shortcheckoutform").validate({
        invalidHandler: function(event, validator) {
            exitPop = true;
            var errors = validator.numberOfInvalids();
            if (errors) {
                var message = errors == 1
                    ? "You have 1 field with an error. It has been highlighted"
                    : "You have " + errors + " errors.  They have been highlighted";
                $("#requiredError").html(message);
            } else {
                $("#requiredError").html("");
            }
        },
        errorPlacement: function(error, element) { },
        rules: {
            
            cardmonth: "required",
            cardyear: "required",
            cardnumber: {
                required: true,
                creditcard: true
            },
            cardcode: {
                required: true,
                digits: true,
                minlength: 3,
                maxlength: 4
            }
        }
    });

    $("#partialemailform").submit(function() {
        exitPop = false;
    });

    $("#partialemailform").validate({
        invalidHandler: function(event, validator) {
            exitPop = false;
            var errors = validator.numberOfInvalids();
            if (errors) {
                var message = errors == 1
                    ? "You have 1 field with an error. It has been highlighted"
                    : "You have " + errors + " errors.  They have been highlighted";
                $("#requiredError2").html(message);
            } else {
                $("#requiredError2").html("");
            }
        },
        errorPlacement: function(error, element) { },
        rules: {
            email: {
                required: true,
                email: true
            }
        }
    });

    $("#fullcheckoutform").submit(function() {
        exitPop = false;
    });

    $("#fullcheckoutform").validate({
        invalidHandler: function(event, validator) {
            exitPop = true;
            var errors = validator.numberOfInvalids();
            if (errors) {
                var message = errors == 1
                    ? "You have 1 field with an error. It has been highlighted"
                    : "You have " + errors + " errors.  They have been highlighted";
                $("#requiredError").html(message);
            } else {
                $("#requiredError").html("");
            }
        },
        errorPlacement: function(error, element) { },
        rules: {
            firstname: "required",
            lastname: "required",
            address: "required",
            city: "required",
            country: "required",
            state: "required",
            zipcode: "required",
            phone: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            email: {
                required: true,
                email: true
            },
            cardcompany: "required",
            cardmonth: "required",
            cardyear: "required",
            cardnumber: {
                required: true,
                creditcard: true
            },
            cardcode: {
                required: true,
                digits: true,
                minlength: 3,
                maxlength: 4
            }
        }
    });

    $("#fullcheckoutformupsell").validate({
        invalidHandler: function(event, validator) {
            exitPop = true;
            var errors = validator.numberOfInvalids();
            if (errors) {
                var message = errors == 1
                    ? "You have 1 field with an error. It has been highlighted"
                    : "You have " + errors + " errors.  They have been highlighted";
                $("#requiredError").html(message);
            } else {
                $("#requiredError").html("");
            }
        },
        errorPlacement: function(error, element) { },
        rules: {
            firstname: "required",
            lastname: "required",
            address: "required",
            city: "required",
            country: "required",
            state: "required",
            zipcode: "required",
            phone: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            email: {
                required: true,
                email: true
            },
            cardcompany: "required",
            cardmonth: "required",
            cardyear: "required",
            cardcode: {
                required: true,
                digits: true,
                minlength: 3,
                maxlength: 4
            }
        }
    });
    $("#fullcheckoutformupsell #cardnumber").on('focus',function(e){
        this.value = '';
        $("#cardnumber").rules('add', {
            required: true,
            creditcard: true
        });
    });

    $(".cvvbox").fancybox({
        "transitionIn": "elastic",
        "transitionOut": "elastic",
        "closeClick": true
    });

    $(".insureshipbox").fancybox({
        "transitionIn": "elastic",
        "transitionOut": "elastic",
        "closeClick": true
    });
});
