<?php
/**
 * Created by PhpStorm.
 * User: TomLiu
 * Date: 7/04/2016
 * Time: 12:31 AM
 *
 * This UpdateEventDetailModel handles database interaction of detailView page
 */

class UpdateEventDetailModel extends CI_Model{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * Get event detail through event_id
     */
    public function selectEventByID($event_id){
        $this->db->select ("*");
        $this->db->from('events');
        $this->db->where('event_id', $event_id);
        $query = $this->db->get();
        $eventsResult=$query->result();
        if($query->num_rows()>0){
            return $eventsResult[0];
        }else{
            return false;
        }
    }

    /*
     * update total number of participants in events table.
     */
    public function updateNumOfParticipantsByID($event_id){
        $this->db->set('listener_count', 'listener_count+1',false);
        $this->db->where('event_id', $event_id);
        $this->db->update('events');
//        $this->insertIntoJoinStatus($event_id,$user_id);
    }
    /*
    * insert into join status
    */
    public function insertIntoJoinStatus($event_id,$user_id){
        $data = array(
            'user_id' => $user_id ,
            'event_id' => $event_id ,
            'join_status' => 1
        );

        if( $this->db->insert('Join_Status', $data)){
            return true;
        }else{
            return false;
        }
    }

    /*
     * Get the join status, i.e. information whether the user is joined.
     */
    public function getJoinStatusByUseridAndEventid($event_id, $user_id){
        $this->db->select ('join_status');
        $this->db->from('Join_Status');
        $this->db->where('event_id', $event_id);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();

        if($query->num_rows()>0){
            $row=$query->row();
            if($row->join_status==0){
                return true;
            }
            return false;
        }else{
            return true;
        }
    }
}