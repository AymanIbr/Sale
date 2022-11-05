$(document).ready(function(){
    $(document).on('input','#search_by_text',function(e){
        var search_by_text  = $(this).val();
        //هان بحتاج ال url
        var search_token = $("#search_token ").val();
        var ajax_search_url = $("#ajax_search_url").val();
        jQuery.ajax({
        url:ajax_search_url,
        type:'post',
        datatype : 'html',
        cache : false ,
        data : {search_by_text :search_by_text ,"_token":search_token},
    success:function(data){

        $("#ajax_responce_searchDiv").html(data);

    },
    error:function(){


    }


        });


            });

        });
