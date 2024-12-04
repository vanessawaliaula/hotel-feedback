<?php 
/**
 * Feedback Page Controller
 * @category  Controller
 */
class FeedbackController extends BaseController{
	function __construct(){
		parent::__construct();
		$this->tablename = "feedback";
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("hotel_branch","department","feedback");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'hotel_branch' => 'required',
				'department' => 'required',
				'feedback' => 'required',
			);
			$this->sanitize_array = array(
				'hotel_branch' => 'sanitize_string',
				'department' => 'sanitize_string',
				'feedback' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg("Feedback submitted successfully", "success");
					return	$this->redirect("analyse.php?id=$rec_id");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = "Submit New Feedback";
		$this->render_view("feedback/add.php");
	}
}
