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


     $(document).on('click','#ajax_pagination_in_search a',function(e){
        e.preventDefault();
      var search_by_text = $("#search_by_text").val();
      var url = $(this).attr("href");
      var search_token = $("#search_token").val();
      jQuery.ajax({
        url:url,
        type:'post',
        datatype : 'html',
        cache : false ,
        data : {search_by_text:search_by_text,"_token":search_token},
      success:function(data){

          $("#ajax_responce_searchDiv").html(data);



      },
      error:function(){

      }
       });

    });

        });
