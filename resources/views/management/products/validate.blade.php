<script>
    var rules = {
        product_category_id: {
          required: true,
          noSpace: true // Use the custom rule
        },
        product_name: {
          required: true,
          noSpace: true // Use the custom rule
        },
        sell_price: {
          required: true,
          number: true // Use the custom rule
        },
      };
    var messages = {
        project_id: {
          required: "Project name field is required."
        },
        block_name: {
          required: "Block name field is required."
        },
        
      };



$('#product_category_id').on('change',function(){
    $('#product_sub_category_id').empty();
    var product_category_id = $(this).val();
    if(product_category_id){
      $.ajax({
       url:'{{ url("admin/get-sub-category")}}',
       headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
       type:'POST',
       data:{'product_category_id':product_category_id},
       complete:function(){
           // $('#state_id')
       },
       success:function(res){
          $option = "<option value=''>select an option</option>";
         
            $.each(res,function(i,val){
              $option += "<option value='"+val.id+"'>"+val.name+"</option>";
            });
         
            $('#product_sub_category_id').html($option);
            $('#product_sub_category_id').val($('#old_product_sub_category_id').val()).trigger('change');
       }
    });
    }

});
$('#product_category_id').trigger('change');
function save(){
    $("#overlay").fadeIn(300);　
    validor(rules,messages,'#product_id');
}



$(document).ready(function() {
     $('#addNew').on('click',function(){
      $tr = $('#tbody').find('tr:last');
      var $clone = $tr.clone();
      $clone.find('img').attr('src','');
     $tr.after($clone);
    SequenceNo();
    removeDiv();
    singleDiv();

});
});

function SequenceNo(){
$.each($('.count'),function(i,elem){
$(this).text(i+1);
});
}

function singleDiv(){
    if($('.removeBtn').length==1)
        $('.removeBtn').attr('style','display:none');
    else
        $('.removeBtn').removeAttr('style');
}
singleDiv();

function removeDiv(){
$('.removeBtn').on('click',function(){
   $(this).closest('tr').remove();
   singleDiv();
   SequenceNo();
});
}
removeDiv();

</script>