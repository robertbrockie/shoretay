<?php

class Link_model extends CI_Model
{
	/**
		Constructor
	**/
	
	function __construct()
	{
		parent::__construct();
	}
	
	/**
		AddLink
		-------
		Take a url and shortens it. The URL can then be
		references by the hex value of its id.
	**/
	function AddLink($long_url)
	{
		$data['redirect_link'] = $long_url;
		$this->db->insert('links', $data);		
		return dechex(mysql_insert_id());
	}
	
	/**
		GetLink
		-------
		Take a shortened url (hex value) and look up the id
		in the database.
	**/
	function GetLink($short_url)
	{
		$id = hexdec($short_url);
		$this->db->where('id', $id);
		
		$query = $this->db->get('links');

		if($query->num_rows > 0)
		{
			return $query->row(0);
		}
		
		return null;
	}
	
	/**
		IsLink
		------
		Check if the url is valid.
	**/
	function IsLink($short_url)
	{
		$this->db->where('id', hexdec($short_url));
		$this->db->from('links');

		if ($this->db->count_all_results() > 0)
			return true;
		else
			return false;
	}
}
