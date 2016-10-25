function calcFileSize(file){
    var size = Math.round(file.size * 100 / 1024) / 100;
    var unit = "KB";
    if(size > 1024) {
        size = Math.round(size*100/1024)/100;
        unit = "MB";
    }
    return size + " " + unit;
}

function createDish(){
    var hidden = $("#DishForm_dishThumb").val();
    var file = $("#DishForm_dishTempThumb").val();
    if(hidden == '' && file == ''){
        $(".error-label").css("display", "inline-block");
    }else{
        $(".error-label").css("display", "none");
        $("#dish-form").submit();
    }
}

function createCategory(){
    var hidden = $("#MenuForm_menuThumb").val();
    var file = $("#MenuForm_menuTempThumb").val();
    if(hidden == '' && file == ''){
        $(".error-label").css("display", "inline-block");
    }else{
        $(".error-label").css("display", "none");
        $("#menu-form").submit();
    }
}

$(document).ready(function(){
    $("[data-toggle='tooltip']").tooltip();
    $('.fileinput-button > input[type="file"]').on("change", function(){
        $(this).parent().next().html($(this).val() + " - " + calcFileSize(this.files[0]));
    });
});