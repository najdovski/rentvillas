<style>
.calendar{
  font-size: 1.5em;
}

table.calendar{
  margin: auto;
  border-collapse: collapse;
}

.calendar .days td{
  width: 80px;
  height: 80px;
  padding: 4px;
  border: 1px solid black;
  vertical-align: top;
  background-color:#343a40;
  color:white;
  text-align:center;
}

.calendar .days td:hover{
  background-color:lightgreen;
  cursor:pointer;
}


.calendar .highlight{
  font-weight:bold;
  color:white;
}

.calendar .today{
  color:lightsalmon;
  text-align:center;
  padding:10px;
}

.calendar .today:hover{
  color:white;
}

.selectedDate{
  background-color:lightgreen;
  color:white !important;
}

.monthName{
  text-align:center;
  font-size:1em;
}

.booked{
  background-color:gray;
  color:white;
  cursor: not-allowed;
}


.booked:after{
  content: "Unavailable!";
  font-size:0.7em;
}


.available:after{
  content: "Available";
  font-size:0.8em;
}

.theWholeRectangle{
  padding:10px;
}

</style>
<?= $calendar ?>
<div class="container">
  <div class="row">
    <div class="col-3"></div>
    <div class="col-6">
    <button class="btn btn-block btn-dark mt-3 shadow" id="bookNow">Book Now!</button>
    </div>
    <div class="col-3"></div>
  </div>
</div>



<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<?php
$url = $_SERVER['REQUEST_URI'];

$year = explode("/",parse_url($url)['path'])[4];
$month = explode("/",parse_url($url)['path'])[5];
$propID = explode("/",parse_url($url)['path'])[6];
$personID = explode("/",parse_url($url)['path'])[7];
?>
<script>
var $clicked = [];

$(".cal_content:contains('0')").text('').parent('div').addClass('available');
$(".cal_content:contains('1')").text('').parent('div').addClass('booked').removeClass('days');


 $('.day_num').click(function(){

      if(jQuery.inArray($(this).text(), $clicked) != -1) {
        if ($(this).parent('div').hasClass('booked')){
          alert ('This date is not available!');
        } else {
            $clicked.pop($(this).text());
            $(this).parent('div').removeClass('selectedDate');
            console.log($clicked);
        }
      } else {
        if ($(this).parent('div').hasClass('booked')){
          alert ('This date is not available!');
        } else {
            $clicked.push($(this).text());
            $(this).parent('div').addClass('selectedDate');
            console.log($clicked);
        }
      }
  
 });

  $('#bookNow').click(function(){
  
    $.ajax({
    type: "POST",
    url: "Calendar/book/<?=$year?>/<?=$month?>/<?=$propID?>/<?=$personID?>",
    data : {"dayFrom" : $clicked[0], "dayTo" : $clicked[1], "saveTheBooking" : true},
    success: function(data){
        alert('Booked from' + $clicked[0] + 'to' + $clicked[1]);
        window.location.reload();
    },
    error: function(){
      alert('error');
    }
    })
  });




</script>