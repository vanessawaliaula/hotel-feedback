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

}
