function change_add_advert_form(x)
{
   if(document.getElementById("advert_type_select_1").checked)
   {
        document.getElementById("input_advert_title").value = "Szukam opiekunki";
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
    let text = document.getElementById('input_min_child_age').value;
    $('#input_max_child_number').val(text);
  }
}


function selectVoivodeship()
{
  let id = $('#input_country').find(":selected").val();
  
  $.ajax({
    url: 'getvoivodeships/'+id,
    type: 'get',
    dataType: 'json',
    success: function(response){
      $('#input_voivodeship').html('');
      if(response['data'].length == 0){
        $('#input_voivodeship').append($('<option/>',{
          value: '-1',
          text: 'Brak danych'
        }));
      }
      else
      {

        $.each(response['data'], function(id, item){
          let id_voivodeship = item.id;
          let name = item.voivodeship_name;

          $('#input_voivodeship').append($('<option/>', {
            value: id_voivodeship,
            text: name
          }))
        });
      }
    }
  });
}

function selectCity()
{
  let id = $('#input_voivodeship').find(":selected").val();

  $.ajax({
    url: 'getcities/'+id,
    type: 'get',
    dataType: 'json',
    success: function(response){
      $('#input_city').html('');
      if(response['data'].length == 0){
        $('#input_city').append($('<option/>',{
          value: '-1',
          text: 'Brak danych'
        }));
      }
      else
      {

        $.each(response['data'], function(id, item){
          let id_city = item.id;
          let name = item.city_name;

          $('#input_city').append($('<option/>', {
            value: id_city,
            text: name
          }))
        });
      }
    }
  });
}

function selectDistrict()
{
  let id = $('#input_city').find(":selected").val();

  $.ajax({
    url: 'getdistricts/'+id,
    type: 'get',
    dataType: 'json',
    success: function(response){
      $('#input_district').html('');
      if(response['data'].length == 0){
        $('#input_district').append($('<option/>',{
          value: '-1',
          text: 'Brak danych'
        }));
      }
      else
      {

        $.each(response['data'], function(id, item){
          let id_district = item.id;
          let name = item.district_name;

          $('#input_district').append($('<option/>', {
            value: id_district,
            text: name
          }))
        });
      }
    }
  });
}