$( document ).ready(function(){
	
//materialize
$(".button-collapse").sideNav();
$(".dropdown-button").dropdown();
$('select').material_select();
$('.materialboxed').materialbox();
$('.scrollspy').scrollSpy();

//materialize//


//dataTables


$('#homeuserprofiles').dataTable( {
    dom : 'Bfrtip',
    select : true
  } );


$('#homeinuserprofiles').DataTable({
    language: {
        searchPlaceholder: "Search inactive profile"
    }
});  

$('#homeactcategoryprofiles').DataTable({
    language: {
        searchPlaceholder: "Search for category"
    }
});  

$('#homeactsubcategoryprofiles').DataTable({
    language: {
        searchPlaceholder: "Search for subcategory"
    }
});  

$('#homeincategoryprofiles').DataTable({
    language: {
        searchPlaceholder: "Search inactive category"
    }
});  

$('#homeinsubcategoryprofiles').DataTable({
    language: {
        searchPlaceholder: "Search inactive subcategory"
    }
});  



//dataTables//




})