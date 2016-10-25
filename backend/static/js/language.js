/**
 * Created by Fruity Solution Co.Ltd.
 * User: Jackfruit
 * Date: 6/21/13 - 10:31 AM
 *
 * Please keep copyright headers of source code files when use it.
 * Thank you!
 */
var Language = function(){
    var languageSelect = function ($lang){
        $.ajax({
            type: 'POST',
            data: {'_lang': $lang},
            success: function(data){window.location.reload();}
        });
    }

    return {
        setLanguage: function($lang){
            languageSelect($lang);
        }
    }
}();