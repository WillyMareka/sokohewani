$( document ).ready(function(){
	
//materialize
$(".button-collapse").sideNav();
$(".dropdown-button").dropdown();

//materialize//


//dataTables      
$('#homeuserprofiles').DataTable({
    language: {
        searchPlaceholder: "Search active profile"
    }
    
});  



$('#homeinuserprofiles').DataTable({
    language: {
        searchPlaceholder: "Search inactive profile"
    }
});  

//dataTables//




})