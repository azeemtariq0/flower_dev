<script>
    var rules = {
        product_categories_id: {
          required: true,
          noSpace: true // Use the custom rule
        },
        name: {
          required: true,
          noSpace: true // Use the custom rule
        },
      };
    var messages = {
        product_categories_id: {
          required: "Product Category field is required."
        },
        name: {
          required: "Name field is required."
        },
        
      };

function save(){
    $("#overlay").fadeIn(300);　
    validor(rules,messages,'#product_sub_categories_form');
}

</script>