<?php
/**
 * Created by PhpStorm.
 * User: TomLiu
 * Date: 31/03/2016
 * Time: 3:38 PM
 *
 * HomeModel handles interaction between EventListView page and database
 */

    class HomeModel extends CI_Model
    {
        /*
         * Retrieve data from database based on location query
         */
        public function getDataWithLocation($limit, $offset,$keywords){
            date_default_timezone_set('Australia/Melbourne');
            if($keywords=='NIL') {
                $lowercasekeyword="";
            }else{
                $lowercasekeyword=strtolower($keywords);
            }
//            $datetimeStr=$this->input->post('timeContraint');
//
//            $datetime = date('Y-m-d H:i:s',strtotime($datetimeStr));
//             date_default_timezone_set('Australia/Melbourne');

            $this->db->select ( '*' );
            $this->db->from ( 'events' );
            $this->db->where ( 'event_datetime >= DATE(NOW())');
            $this->db->like('events.venue_address',$lowercasekeyword);
            $this->db->limit($limit,$offset);
            $this->db->order_by('events.event_datetime','asc');


            $query = $this->db->get ();

//
            if($query->num_rows()>0){
                return $query->result();
            }else{
                return false;
            }
        }

                /*
                * Retrieve data from database with default criteria
                */
        public function getData($limit, $offset){
             date_default_timezone_set('Australia/Melbourne');


            $datetimeStr=$this->input->post('timeContraint');

            $datetime = date('Y-m-d H:i:s',strtotime($datetimeStr));
            $this->db->select ( '*' );
            $this->db->from ( 'events' );
            $this->db->where ( 'event_datetime >= DATE(NOW())');


            $this->db->limit($limit,$offset);
            $this->db->order_by('events.event_datetime','asc');
            $query = $this->db->get ();

//            $sql = "select * from events e
//                 where e.venue_address like '%$lowercasekeyword%' limit ".$limit
//                            ." offset ".$offset." order by e.event_datetime desc";
//            $query = $this->db->query($sql);
//            $eventsResult=[];
//            if($query->num_rows()>0){
//                foreach($query->result() as $row){
//                    array_push($eventsResult,$row);
//                }
//            }else{
//                $eventsResult[]="Result Not Found";
//            }
//            return $eventsResult;
            if($query->num_rows()>0){
                return $query->result();
            }else{
                return false;
            }
        }

        /*
         * Retrieve number of rows for location search
         */
        public function countRowsForLocationSearch($keywords){
             date_default_timezone_set('Australia/Melbourne');

            if($keywords=='NIL') {
                $lowercasekeyword="";
            }else{
                $lowercasekeyword=trim(strtolower($keywords));
            }
            $this->db->select ( '*' );
            $this->db->from ( 'events' );
            $this->db->where ( 'event_datetime >= DATE(NOW())');
            $this->db->like('events.venue_address',$lowercasekeyword);

            $query = $this->db->get();
//            $sql = "select * from events e
//                             where e.venue_address like '%$keywords%'";
//            $query = $this->db->query($sql);
            return $query->num_rows();
        }

        /*
         * Retrieve total number of rows.
         */

        public function countAll(){
             date_default_timezone_set('Australia/Melbourne');


            $this->db->where ( 'event_datetime >= DATE(NOW())');
            return $this->db->count_all_results('events');
        }

        /*
         * Retrieve event data according to calendar day query
         */
        public function countByCalendarDay($dateStr){
            date_default_timezone_set('Australia/Melbourne');
            $datetime = date('Y-m-d H:i:s',strtotime($dateStr));
            $this->db->where('event_datetime >=',$datetime );
            $num_rows = $this->db->count_all_results('events');
            return $num_rows;
//
//           $datetime = date('Y-m-d H:i:s',strtotime($dateStr));
//
//            $this->db->select ( '*' );
//            $this->db->from ( 'events' );
//            $this->db->where ( 'event_datetime >=', $datetime);
//            $query = $this->db->get();
//            return $query->num_rows();
//
        }

        /*
         * Retrieve number of rows according to location and time criteria.
         */
        public function countRowsForLocationAndDaySearch($searchKeyword,$dateStr){
             date_default_timezone_set('Australia/Melbourne');

            if($searchKeyword=='NIL') {
                $lowercasekeyword="";
            }else{
                $lowercasekeyword=trim(strtolower($searchKeyword));
            }
            $datetime = date('Y-m-d',strtotime($dateStr));

            $this->db
                ->select ( '*' )
                ->from ( 'events' )
                ->where ( 'event_datetime >=', $datetime)
                ->like('events.venue_address',$lowercasekeyword);
            $query = $this->db->get();
            return $query->num_rows();
        }

         /*
          * Retrieve event data according to time criteria.
          */
        public function searchByCalendarDay($limit, $offset,$dateStr){
 			 date_default_timezone_set('Australia/Melbourne');
            $datetime = date('Y-m-d H:i:s',strtotime($dateStr));
            $this->db->select ( '*' );
            $this->db->from ( 'events' );
            $this->db->where ( 'event_datetime >=', $datetime);
            $this->db->limit($limit,$offset);
            $this->db->order_by('events.event_datetime','asc');

            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result();
            }else{
                return false;
            }
        }

        /*
        * Retrieve event data according to location and time criteria .
        */
        public function getDataWithLocationAndDay($limit, $offset,$searchKeyword,$dateStr){
             date_default_timezone_set('Australia/Melbourne');

            if($searchKeyword=='NIL') {
                $lowercasekeyword="";
            }else{
                $lowercasekeyword=trim(strtolower($searchKeyword));
            }
            $datetime = date('Y-m-d',strtotime($dateStr));
            $this->db
                ->select ( '*' )
                ->from ( 'events' )
                ->like('events.venue_address',$lowercasekeyword)
                ->where ('event_datetime >=', $datetime)
                ->limit($limit,$offset)
                ->order_by('events.event_datetime','asc');

            $query = $this->db->get();
            if($query->num_rows()>0){
                return $query->result();
            }else{
                return false;
            }
        }


        /*
        * Addding Search keyword, location to session
        */
        public function keyword_session_handler($keywords)
        {
            
            $this->load->library("session");
            if($keywords)
            {
                $this->session->set_userdata('searchKeyword', $keywords);
                return $keywords;
            }
            elseif($this->session->userdata('searchKeyword'))
            {
                $keywords = $this->session->userdata('searchKeyword');

                return $keywords;
            } else {
                return "";
            }
        }

        /*
         * Addding Search keyword time to session
         */
        public function timeconstraint_session_handler($timeconstraint)
        {
                      
            $this->load->library("session");
            if($timeconstraint)
            {
                $this->session->set_userdata('timecon', $timeconstraint);
                return $timeconstraint;
            }
            elseif($this->session->userdata('timecon'))
            {
                $timeconstraint = $this->session->userdata('timecon');

                return $timeconstraint;
            } else {
                return "";
            }
        }

    }

?>