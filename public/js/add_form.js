function change_add_advert_form(x)
{
   if(document.getElementById("advert_type_select_1").checked)
   {
        document.getElementById("input_advert_title").value = "Opiekun";
   }
   else
   {
        document.getElementById("input_advert_title").value = "Zaopiekuję się";
   }
}

function change_child_age()
{
  if($('#input_number_of_childs').val() == '1')
  {
    text = document.getElementById('input_min_child_age').value;
    $('#input_max_child_number').val(text);
  }
}