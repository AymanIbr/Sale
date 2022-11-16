$(document).ready(function(){
$(document).on('click','#update_image',function(e){
    e.preventDefault();
    // الشرط لكي يضيف الزر فقط مرة واحدة
    if(!$('#photo').length){
        $('#update_image').hide();
        $('#cancle_update_image').show();
        $('#oldimage').html('<br><input type="file"  name="photo" id="photo" >');
    }
    return false ;
});

$(document).on('click','#cancle_update_image',function(e){
    e.preventDefault();
        $('#update_image').show();
        $('#cancle_update_image').hide();
        $('#oldimage').html('');

    return false ;
});

// زر الحذف في الdetalis
$(document).on('click','are_you_Sure',function(e){
    var res = confirm ("هل أنت متأكد ؟");

    if(!res){
        return false ;
    }
});




});
