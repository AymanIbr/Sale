$(document).ready(function(){
    $(document).on('change','#does_has_retailunit',function(e){

        var uom_id = $("#uom_id").val();
        if(uom_id == ''){
            alert('اختر الوحدة الأب أولا');
            $("#does_has_retailunit").val("");
            return false ;
        }

        if($(this).val()==1){
            $(".related_retail_conter").show();
        }else{
            $(".related_retail_conter").hide();
        }

    });


    $(document).on('change','#uom_id',function(e){
        if($(this).val() != ''){
            var name = $("#uom_id option:selected").text();
            $(".parentuomname").text(name);

            var does_has_retailunit = $("#does_has_retailunit").val();
            if(does_has_retailunit==1){
                $(".related_retail_conter").show();
            }else{
                $(".related_retail_conter").hide();
            }
        }else{
            $(".parentuomname").text('');
            $(".related_retail_conter").hide();
        }

    });

        });
