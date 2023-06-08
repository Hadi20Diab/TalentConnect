// function filterJobs(){
//     var jobList=document.getElementById("jobList");

//     var jobType = document.getElementById('jobType').value;
//     var industry = document.getElementById('industry').value;
//     var category = document.getElementById('category').value;
//     var country = document.getElementById('country').value;

//     var loding = document.getElementById('loding');
//     loding.textContent ="Loading...";
// }



$(document).ready(function () {
    $('select').selectize({
        sortField: 'text'
      });
   });