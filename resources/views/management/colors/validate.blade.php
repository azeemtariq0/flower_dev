<script>
    var rules = {
        color_name: {
          required: true,
          noSpace: true // Use the custom rule
        },
        color_code: {
          required: true,
          noSpace: true // Use the custom rule
        },
      };
    var messages = {
        color_name: {
          required: "Color name field is required."
        },
        color_code: {
          required: "Color Code field is required."
        },
        
      };

function save(){
    $("#overlay").fadeIn(300);　
    validor(rules,messages,'#colors_form');
}

</script>