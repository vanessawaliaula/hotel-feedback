<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * feedback_hotel_branch_option_list Model Action
     * @return array
     */
	function feedback_hotel_branch_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT branch AS value,branch AS label FROM branches ORDER BY branch ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * feedback_department_option_list Model Action
     * @return array
     */
	function feedback_department_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT department AS value,department AS label FROM departments ORDER BY department ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * feedback_feedbackdepartment_option_list Model Action
     * @return array
     */
	function feedback_feedbackdepartment_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT department AS value,department AS label FROM feedback ORDER BY department";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * feedback_feedbackrating_option_list Model Action
     * @return array
     */
	function feedback_feedbackrating_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT rating AS value,rating AS label FROM feedback";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * getcount_feedback Model Action
     * @return Value
     */
	function getcount_feedback(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM feedback";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_branches Model Action
     * @return Value
     */
	function getcount_branches(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM branches";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_departments Model Action
     * @return Value
     */
	function getcount_departments(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM departments";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

}
