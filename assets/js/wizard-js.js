jQuery(document).ready(function($) {
    $("section[data-step]").hide();
    $("button.button-back").hide();
    $("section[data-step=1]").show();
    //next button 
       $("button.button.button-next").click(function(e) {
        e.preventDefault();
        var step = jQuery(this).closest("section").data("step");
        var isValid = true;
        $("section[data-step='" + step + "'] [aria-required]").each(function(idx, elem) {
            $(elem).removeAttr("style");
            if($(elem).val().trim() === "") {
                isValid = false;
                $(elem).css({"border":"2px solid red"});
            }
        });
        if(isValid) {
            step += 1;
            $("section").data("step", step);
            $("section[data-step]").hide();
            $("section[data-step='" + step + "']").show();
            $("button.button-back").show();     
        }
    });
    ////back
    $("button.button-back").click(function(e) {
        e.preventDefault();
        var step = $("section").data("step");
        step -= 1;
        $("section").data("step", step);
        $("section[data-step]").hide();
        $("section[data-step='" + step + "']").show();
        if(step === 1) {
            $("button.button-back").hide();
        }
    });
    
       ///step back to error
	$(".wpcf7 input.wpcf7-submit").click(function(e) {
		var form = $(this).parents('form');
		setTimeout(function(){
			 form.find(".wpcf7-form-control").each(function(idx, elem) {
				if($(elem).hasClass('wpcf7-not-valid')) {
					var step = $(elem).parents("section").data("step");
					form.find("section[data-step]").hide();
					form.find("section[data-step='" + step + "']").show();
				}
			});
		},1000);
	});
    
});