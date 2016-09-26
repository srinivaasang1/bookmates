<?php
/**
 * Created by PhpStorm.
 * User: TomLiu
 * Date: 2/04/2016
 * Time: 4:40 PM
 *
 * The class is a Model handling AddEventview page interaction with database, such as insert functionality.
 */

class AddEventModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*
     * The function retrieves values from add event view page, and insert these valuse into database
     */
    public function insert_event()
    {
        $datetimeStr = $this->input->post('time');
        $datetime = date('Y-m-d H:i:s', strtotime($datetimeStr));
        $isbn = $this->input->post('isbnName');
        $title = $this->input->post('titleName');
        $location = $this->input->post('location');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $userid = $this->input->post('hiddenUserid');
        $insertSQL = "INSERT INTO EVENTS (EVENT_DATETIME,LISTENER_COUNT,BOOK_ISBN,VENUE_ADDRESS,NAME,EMAIL,BOOK_TITLE,USER_ID)
                VALUES (
                  " . $this->db->escape($datetime) . ",0," . $this->db->escape($isbn) . "," . $this->db->escape($location) . "," . $this->db->escape($name) . ",'" . $email . "'," . $this->db->escape($title) . "
                ," . $this->db->escape($userid) . ")";
        $this->db->query($insertSQL);
        return $this->db->insert_id();
    }

}







































