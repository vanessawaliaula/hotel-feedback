<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbartopleft = array(
		array(
			'path' => 'home', 
			'label' => 'Home', 
			'icon' => '<i class="fa fa-home "></i>'
		),
		
		array(
			'path' => 'branches', 
			'label' => 'Branches', 
			'icon' => '<i class="fa fa-bank "></i>'
		),
		
		array(
			'path' => 'departments', 
			'label' => 'Departments', 
			'icon' => '<i class="fa fa-cutlery "></i>'
		),
		
		array(
			'path' => 'feedback', 
			'label' => 'Feedback', 
			'icon' => '<i class="fa fa-comments "></i>'
		),
		
		array(
			'path' => 'users', 
			'label' => 'Users', 
			'icon' => '<i class="fa fa-users "></i>'
		)
	);
		
	
	
			public static $rating = array(
		array(
			"value" => "Positive", 
			"label" => "Positive", 
		),
		array(
			"value" => "Negative", 
			"label" => "Negative", 
		),
		array(
			"value" => "Neutral", 
			"label" => "Neutral", 
		),);
		
}