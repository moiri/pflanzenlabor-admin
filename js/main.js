$(document).ready(function() {
    let image_path;
    let image_name;
    $('.invert-link-img').hover(function() {
        image_path = "";
        var $img = $(this).find('img:visible:first');
        var paths = $img.attr("src").split("/");
        var reverse = false;
        image_name = paths[paths.length-1];
        var new_names = image_name.split("_");
        var new_name = "hov_" + image_name;
        if(new_names[0] == "hov") {
            new_name = "";
            for( var i=1; i<new_names.length-1; i++) {
                new_name += new_names[i] + "_";
            }
            new_name += new_names[new_names.length-1];
        }
        console.log(new_name)

        for( var i=0; i<paths.length-1; i++) {
            image_path += paths[i] + "/";
        }
        $img.attr("src", image_path + new_name);
        $(this).addClass('border-dark');
    }, function() {
        $(this).find('img:visible:first').attr("src", image_path + image_name);
        $(this).removeClass('border-dark');
    });
});
