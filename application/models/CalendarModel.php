<?php
  class CalendarModel extends CI_Model{

    public $prefs;

    public function __construct(){
      parent::__construct();
      $this->load->database();
    }

    public function init($propID, $personID){

      $this->load->database();

            //calendar preferences
      $this->prefs = array(
        'show_next_prev'  => TRUE,
        'next_prev_url'   => '/portfolio_projects/rentvillas/Calendar/book/'.$propID.'/'.$personID,
        'start_day' => 'monday',
        'table_open'           => '<table class="calendar">',
        'cal_cell_start'       => '<td class="day">',
        'cal_cell_start_today' => '<td class="today">'
      );

      $this->prefs['template'] = '
      {table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar">{/table_open}

      {heading_row_start}<tr class="text-center">{/heading_row_start}

      {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
      {heading_title_cell}<th colspan="{colspan}" class="monthName">{heading}</th>{/heading_title_cell}
      {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

      {heading_row_end}</tr>{/heading_row_end}

      {week_row_start}<tr class="text-center">{/week_row_start}
      {week_day_cell}<td>{week_day}</td>{/week_day_cell}
      {week_row_end}</tr>{/week_row_end}

      {cal_row_start}<tr class="days">{/cal_row_start}
      {cal_cell_start}<td>{/cal_cell_start}
      {cal_cell_start_today}<td>{/cal_cell_start_today}
      {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}



      
      {cal_cell_content}
      <div class="theWholeRectangle">
      <div class="day_num highlight"> {day} </div>
      <div class="cal_content">
      {content}
      </div>
      </div>
      {/cal_cell_content}
      



      {cal_cell_content_today}
      <div class="today">
      <div class="day_num"> {day} </div>
      <div class="cal_content">{content}</div>
      </div>
      {/cal_cell_content_today}

      {cal_cell_no_content}<div class="day_num"> {day} </div>{/cal_cell_no_content}
      {cal_cell_no_content_today}<div class="day_num today"> {day} </div>{/cal_cell_no_content_today}

      {cal_cell_blank}&nbsp;{/cal_cell_blank}

      {cal_cell_other}{day}{/cal_cel_other}

      {cal_cell_end}</td>{/cal_cell_end}
      {cal_cell_end_today}</td>{/cal_cell_end_today}
      {cal_cell_end_other}</td>{/cal_cell_end_other}
      {cal_row_end}</tr>{/cal_row_end}

      {table_close}</table>{/table_close}
';
    }

    public function getCalendarData($propID, $personID, $year, $month){

      $query = $this->db->query("
      SELECT * FROM Availability
      WHERE Prop_ID = $propID
      ");

      $query = $query->result_array();
    


    // for ($month = 1; $month <=12; $month++){
    //   $daysPassed = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        
        
    //   $startTimeStamp = strtotime("$year/01/01");
    //   $endTimeStamp = strtotime("$year/$month/$daysPassed");
    //   $timeDiff = abs($endTimeStamp - $startTimeStamp);
        

    //   $subStringSecondParametar = ($timeDiff/86400) + 1;
    //   $subStringFirstParametar = $subStringSecondParametar + 1 . ' - ';

    //   echo ceil($subStringFirstParametar) . ' - ';
    //   echo ceil($subStringSecondParametar) . '<br>';
    //   }

      // $numberOfDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

      if($month == 1 && $year == 2019){
        $calendarData = substr($query[0]['Availability_String'], 1, 32);
      } else if($month == 2 && $year == 2019){
        $calendarData = substr($query[0]['Availability_String'], 33, 60);
      } else if($month == 3 && $year == 2019){
        $calendarData = substr($query[0]['Availability_String'], 61, 91);
      } else if($month == 4 && $year == 2019){
        $calendarData = substr($query[0]['Availability_String'], 92, 121);
      } else if($month == 5 && $year == 2019){
        $calendarData = substr($query[0]['Availability_String'], 122, 152);
      } else if($month == 6 && $year == 2019){
        $calendarData = substr($query[0]['Availability_String'], 153, 182);
      } else if($month == 7 && $year == 2019){
        $calendarData = substr($query[0]['Availability_String'], 183, 213);
      } else if($month == 8 && $year == 2019){
        $calendarData = substr($query[0]['Availability_String'], 214, 244);
      } else if($month == 9 && $year == 2019){
        $calendarData = substr($query[0]['Availability_String'], 245, 274);
      } else if($month == 10 && $year == 2019){
        $calendarData = substr($query[0]['Availability_String'], 275, 305);
      } else if($month == 11 && $year == 2019){
        $calendarData = substr($query[0]['Availability_String'], 306, 335);
      } else if($month == 12 && $year == 2019){
        $calendarData = substr($query[0]['Availability_String'], 336, 366);
      }



      if($month == 1 && $year == 2020){
        $calendarData = substr($query[0]['Availability_String'], 1, 32);
      } else if($month == 2 && $year == 2020){
        $calendarData = substr($query[0]['Availability_String'], 33, 61);
      } else if($month == 3 && $year == 2020){
        $calendarData = substr($query[0]['Availability_String'], 62, 92);
      } else if($month == 4 && $year == 2020){
        $calendarData = substr($query[0]['Availability_String'], 93, 122);
      } else if($month == 5 && $year == 2020){
        $calendarData = substr($query[0]['Availability_String'], 123, 153);
      } else if($month == 6 && $year == 2020){
        $calendarData = substr($query[0]['Availability_String'], 154, 183);
      } else if($month == 7 && $year == 2020){
        $calendarData = substr($query[0]['Availability_String'], 184, 214);
      } else if($month == 8 && $year == 2020){
        $calendarData = substr($query[0]['Availability_String'], 215, 245);
      } else if($month == 9 && $year == 2020){
        $calendarData = substr($query[0]['Availability_String'], 246, 275);
      } else if($month == 10 && $year == 2020){
        $calendarData = substr($query[0]['Availability_String'], 276, 306);
      } else if($month == 11 && $year == 2020){
        $calendarData = substr($query[0]['Availability_String'], 307, 336);
      } else if($month == 12 && $year == 2020){
        $calendarData = substr($query[0]['Availability_String'], 337, 369);
      }
   
      return $calendarData;
    }

    // public function addCalendarData($year, $month, $day, $propID){
    //   $query = $this->db->query("
    //   SELECT * FROM Availability
    //   WHERE Prop_ID = $propID AND year = $year
    //   ");

    //   $query = $query->result_array();
      
    //   $this->db->where('Prop_ID', $propID);
    //   // $this->db->update('mytable', $data);
    // }

    public function generate($propID, $personID, $year, $month){
      $calendarData = $this->getCalendarData($propID, $personID, $year, $month);
      $this->load->library('calendar', $this->prefs);
      return $this->calendar->generate($year, $month, $calendarData);
    }


    public function saveBooking($dayFrom, $dayTo, $year, $month, $propID, $personID, $price){

      //make the calendar unavailable for any day before today
      $this->updateAvailability();
      
      $dateFrom = $year . '-' . $month . '-' . $dayFrom;
      $dateTo = $year . '-' . $month . '-' . $dayTo;
      $this->db->query("
      INSERT INTO Bookings (Person_ID, Prop_ID, From_Date, To_Date, Price)
      VALUES ($personID, $propID, '$dateFrom', '$dateTo', $price)
        ");

       //running a query to get the current AvailabilityString
       $availabilityString = $this->db->query("
       SELECT Availability_String
       FROM Availability
       WHERE Prop_ID = $propID AND Year = $year
       ");
       $availabilityString = $availabilityString->result_array();


       $getTheDates = $this->db->query("
       SELECT * FROM Bookings
       WHERE Prop_ID = $propID AND Person_ID = $personID");

       $getTheDates = $getTheDates->result_array();
       foreach ($getTheDates as $get){
         $dateFromQuery = $get['From_Date'];
         $dateToQuery = $get['To_Date'];
       }

      //get the string position for the first parametar (FROM)
      $explodeDateFromQuery = explode("-", $dateFromQuery);
      $explodedYear = $explodeDateFromQuery[0];
      $explodedMonth = $explodeDateFromQuery[1];
      $explodedDay = $explodeDateFromQuery[2];

      $date1 = date_create("$explodedYear-01-01");
      $date2 = date_create("$explodedYear-$explodedMonth-$explodedDay");
      $diff=date_diff($date1, $date2);
      $availabilityStringFrom = ($diff->days)+3;


      //get the string position for the second parametar (TO)
      $explodeDateToQuery = explode("-", $dateToQuery);
      $explodedYear = $explodeDateToQuery[0];
      $explodedMonth = $explodeDateToQuery[1];
      $explodedDay = $explodeDateToQuery[2];

      $date3 = date_create("$explodedYear-01-01");
      $date4 = date_create("$explodedYear-$explodedMonth-$explodedDay");
      $diff=date_diff($date3, $date4);
      $availabilityStringTo = ($diff->days)+3;



      //changing the current AvailabilityString
      foreach ($availabilityString as $currentAvailabilityString):
      for ($i=$availabilityStringFrom; $i<=$availabilityStringTo; $i++){
        $currentAvailabilityString['Availability_String'][$i] = '1';
      }
       endforeach;
       $newAvailabilityString = $currentAvailabilityString['Availability_String'];

      //updating the new AvailabilityString into the table
      $this->db->query("
      UPDATE Availability
      SET
      Availability_String = '$newAvailabilityString'
      WHERE
      Prop_ID = $propID AND Year = $year
      ");
    }

    public function updateAvailability(){
      $year = 2019;
      $today = date('z');

      $howManyVillas = $this->db->query("
        SELECT MAX(Prop_ID) FROM Properties
      ")->result_array();

      // print_r($howManyVillas);

      for($i=0; $i<=$howManyVillas[0]['MAX(Prop_ID)']; $i++){
        $availabilityString = $this->db->query("
        SELECT Availability_String
        FROM Availability
        WHERE Prop_ID = $i AND Year = $year");
        $availabilityString = $availabilityString->result_array();
      }



        foreach($availabilityString as $singleString){
          for ($i=0; $i<=$today+3; $i++){
          $singleString['Availability_String'][$i] = 1;
          }
          // echo $singleString['Availability_String'];
          $updateNewString = $singleString['Availability_String'];
        }


        for ($i=0; $i<=$howManyVillas[0]['MAX(Prop_ID)']; $i++){
          $this->db->query("
          UPDATE Availability
          SET Availability_String = '$updateNewString'
          WHERE Prop_ID = $i AND Year = $year");
        }
    }


    public function cancelBooking($propID, $personID){
      $year = date('Y');
    
      $dates = $this->db->query("
      SELECT From_Date, To_Date
      FROM Bookings
      WHERE Prop_ID = $propID AND Person_ID = $personID");
      $dates = $dates->result_array();


      ////////////////////////////////////
      $fromDate = $dates[0]['From_Date'];

      $fromDateInterval1 = date_create('2019-01-01'); 
      $fromDateInterval2 = date_create($fromDate);

      $fromIntervalCalculate = date_diff($fromDateInterval1, $fromDateInterval2); 
      $fromDateInterval = $fromIntervalCalculate->days;
      /////////////////////////////////////


      ////////////////////////////////////
      $toDate = $dates[0]['To_Date'];

      $toDateInterval1 = date_create('2019-01-01'); 
      $toDateInterval2 = date_create($toDate);

      $toIntervalCalculate = date_diff($toDateInterval1, $toDateInterval2); 
      $toDateInterval = $toIntervalCalculate->days;
      /////////////////////////////////////


      /////////////////////////////////////
      $currentAvailabilityString = $this->db->query("
      SELECT Availability_String From Availability
      WHERE Prop_ID = $propID AND Year = $year");
      $currentAvailabilityString = $currentAvailabilityString->result_array();
      print_r($currentAvailabilityString);
      /////////////////////////////////////



      /////////////////////////////////////
      foreach ($currentAvailabilityString as $row){
        for ($i=$fromDateInterval; $i<=$toDateInterval+3; $i++){
          $row['Availability_String'][$i] = 0;
        }   
      }
      $newString = $row['Availability_String'];
      $this->db->query("
      UPDATE Availability
      SET Availability_String = '$newString'
      WHERE Prop_ID = $propID AND year = $year");     
      /////////////////////////////////////
      


      //select availability string
      //select the dates from bookings
      //calculate which days should be 0's
      //make the new availability string
      //change the availability string with the new one

      $this->db->query("
      DELETE FROM Bookings
      WHERE Prop_ID = $propID AND Person_ID = $personID");
    }


      public function getThePrice($propID, $year, $month, $dayFrom, $dayTo){
        /*
        *SELECT the price for each day for given $propID and $year
          *Convert the dates to 00101001010 String and find the positions
          *Get the price for each position
          *Multiply

        *UPDATE the Bookings table with the price and everything else
        */
        

        $fromDate = $year . '-' . $month . '-' .$dayFrom;
        $toDate = $year . '-' . $month . '-' . $dayTo;

        $numberOfDays = (strtotime($toDate) - strtotime($fromDate))/60/60/24;

        //zemi go najbliskiot datum do dateFrom
        //zemi go najbliskiot datum do dateTo, ako e pomalo od narednio ostnava istata cena
        //ako e pogolem od naredniot, dateDiff izmegju narednio datum i dateTo

        $priceQuery = $this->db->query("
        SELECT From_Date, Price FROM Prices
        WHERE Prop_ID = $propID AND From_Date <= '$fromDate'
        ORDER BY From_Date DESC
        LIMIT 1
        ");
        $priceQuery = $priceQuery->result_array();
        

        return $priceQuery[0]['Price'] * $numberOfDays;
    }
  
  
  
  }
?>