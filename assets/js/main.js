 $(document).ready(function(){


    $('.carousel').carousel({
        interval: 5000 //changes the speed
    });



$(".other_categories").hide();
   


$('#filer_input').filer({
    showThumbs:true,
    addMore:true
   });

 $('#category').change(function(){
    
    var tran_other = $('#category option:selected').val();
    if (tran_other != '') {
      $('.other_categories').slideDown();
      $('#subcategory').prop('required',true);
    }else{
      $('.other_categories').slideUp();
      $('#subcategory').prop('required',false);
    };
  });


$('#category').change(function() {
var category_id = $('#category option:selected').val();


var jqxhr=$.get("home/create_subcategories_select/"+category_id, function(data) {
   $('#sub_category').html(data);
})
});





// document.getElementById("picture_2").disabled = true;
// document.getElementById("picture_3").disabled = true;
// document.getElementById("picture_4").disabled = true;

// var img1 = document.getElementById("picture_1");
// img1.onchange = function () {
//    if (this.value != "" || this.value.length > 0) {
//       document.getElementById("picture_2").disabled = false;
//    }
// }

// var img2 = document.getElementById("picture_2");
// img2.onchange = function () {
//    if (this.value != "" || this.value.length > 0) {
//       document.getElementById("picture_3").disabled = false;
//    }
// }

// var img3 = document.getElementById("picture_3");
// img3.onchange = function () {
//    if (this.value != "" || this.value.length > 0) {
//       document.getElementById("picture_4").disabled = false;
//    }
// }

  
 });
        