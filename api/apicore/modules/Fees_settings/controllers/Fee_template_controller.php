<?php

/**
 * Description of Fee_template_controller
 *
 * @author aju.docme
 * 
 */
class Fee_template_controller extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Fee_template_model', 'MFeeTemplate');
    }

    public function get_fee_template($params)
    {
        $apikey = $params['API_KEY'];
        $query_string = "";
        if (isset($params['status'])) {
            $query_string = "c.isactive = " . $params['status'];
        }

        if (isset($params['mode']) && !empty($params['mode'])) {
            $mode = $params['mode'];
        } else {
            $mode = 'search';
        }


        if (strcasecmp($mode, "search") == 0) {
            if (isset($params['inst_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.inst_id = '" . $params['inst_id'] . "' ";
                } else {
                    $query_string = "c.inst_id = '" . $params['inst_id'] . "' ";
                }
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution data is required.', 'data' => FALSE);
            }
            if (isset($params['template_name'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.template_name LIKE '%" . str_replace(" ", "%", $params['template_name']) . "%' ";
                } else {
                    $query_string = "c.template_name LIKE '%" . str_replace(" ", "%", $params['template_name']) . "%' ";
                }
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution data is required.', 'data' => FALSE);
            }
            if (isset($params['acd_year_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.acd_year_id = '" . $params['acd_year_id'] . "' ";
                } else {
                    $query_string = "c.acd_year_id = '" . $params['acd_year_id'] . "' ";
                }
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required.', 'data' => FALSE);
            }
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "c.id = '" . $params['id'] . "' ";
                }
            }
        } else if (strcasecmp($mode, "strict" == 0)) {

            if (isset($params['inst_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.inst_id = '" . $params['inst_id'] . "' ";
                } else {
                    $query_string = "c.inst_id = '" . $params['inst_id'] . "' ";
                }
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Institution data is required.', 'data' => FALSE);
            }
            if (isset($params['acd_year_id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.acd_year_id = '" . $params['acd_year_id'] . "' ";
                } else {
                    $query_string = "c.acd_year_id = '" . $params['acd_year_id'] . "' ";
                }
            } else {
                return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year data is required.', 'data' => FALSE);
            }
            if (isset($params['id'])) {
                if (strlen($query_string) > 0) {
                    $query_string = $query_string . " AND " . "c.id = '" . $params['id'] . "' ";
                } else {
                    $query_string = "c.id = '" . $params['id'] . "' ";
                }
            }
        }
        $template_list = $this->MFeeTemplate->get_template_details($apikey, $query_string);
        if (!empty($template_list) && is_array($template_list)) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data Loaded', 'data' => $template_list);
        } else {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'No data available', 'data' => FALSE);
        }
    }

    public function save_fee_template($params = NULL)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        }

        if (!(isset($params['template_name']) && !empty($params['template_name']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template name is required', 'data' => FALSE);
        }

        if (!(isset($params['template_desc']) && !empty($params['template_desc']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template description is required', 'data' => FALSE);
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year id is required', 'data' => FALSE);
        }
        if (!(isset($params['class_detail_id']) && !empty($params['class_detail_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class detail id is required', 'data' => FALSE);
        }
        $data_to_template = array(
            'inst_id' => $params['inst_id'],
            'template_name' => $params['template_name'],
            'template_desc' => $params['template_desc'],
            'isapproved' => 1,
            'islinked' => 0,
            'is_student_linked' => 0,
            'acd_year_id' => $params['acd_year_id'],
            'approve_comments' => 'No approval required'
        );

        $class_data_raw = json_decode($params['class_detail_id'], TRUE);

        $class_data = array();
        foreach ($class_data_raw as $value) {
            $class_data[] = array(
                'class_detail_id' => $value
            );
        }

        $dbparams[1] = json_encode($data_to_template);
        $dbparams[2] = json_encode($class_data);
        $dbparams[3] = $params['template_name'];
        $dbparams[4] = $params['inst_id'];


        $template_status = $this->MFeeTemplate->add_new_fee_template($dbparams);
        if (!empty($template_status) && is_array($template_status) && $template_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data inserted successfully', 'data' => array('id' => $template_status['id']));
        } else {
            if (isset($template_status['ErrorMessage']) && !empty($template_status['ErrorMessage']) && is_array($template_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $template_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function save_edit_fee_template($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        }

        if (!(isset($params['template_id']) && !empty($params['template_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template ID is required', 'data' => FALSE);
        }

        if (!(isset($params['template_name']) && !empty($params['template_name']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template name is required', 'data' => FALSE);
        }

        if (!(isset($params['template_desc']) && !empty($params['template_desc']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template description is required', 'data' => FALSE);
        }
        if (!(isset($params['acd_year_id']) && !empty($params['acd_year_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Academic year id is required', 'data' => FALSE);
        }
        if (!(isset($params['class_detail_id']) && !empty($params['class_detail_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Class detail id is required', 'data' => FALSE);
        }
        $data_to_template = array(
            'inst_id' => $params['inst_id'],
            'template_id' => $params['template_id'],
            'template_name' => $params['template_name'],
            'template_desc' => $params['template_desc'],
            'isapproved' => 1,
            'islinked' => 0,
            'is_student_linked' => 0,
            'acd_year_id' => $params['acd_year_id'],
            'approve_comments' => 'No approval required'
        );

        $class_data1 = json_decode($params['class_detail_id'], TRUE);
        $current_classes1 = json_decode($params['current_classes'], TRUE);

        $delete_array = array_diff($current_classes1, $class_data1);
        if (empty($delete_array)) {
            $del_data = 0;
        } else { //$delete_array = implode(',',$delete_array); 
            $del_data = array();
            foreach ($delete_array as $value) {
                $del_data[] = array(
                    'class_detail_id' => $value
                );
            }
        }

        $class_data2 = json_decode($params['class_detail_id'], TRUE);
        $current_classes2 = json_decode($params['current_classes'], TRUE);

        $add_array = array_diff($class_data1, $current_classes1);
        if (empty($add_array)) {
            $add_data = 0;
        } else { //$add_array = implode(',',$add_array); 
            $add_data = array();
            foreach ($add_array as $value) {
                $add_data[] = array(
                    'class_detail_id' => $value
                );
            }
        }

        $class_data_raw = json_decode($params['class_detail_id'], TRUE);
        $class_data = array();
        foreach ($class_data_raw as $value) {
            $class_data[] = array(
                'class_detail_id' => $value
            );
        }

        $dbparams[1] = json_encode($data_to_template);
        $dbparams[2] = json_encode($class_data);
        $dbparams[3] = $params['template_name'];
        $dbparams[4] = $params['inst_id'];
        $dbparams[5] = $params['template_id'];
        $dbparams[6] = json_encode($del_data);
        $dbparams[7] = json_encode($add_data);

        $template_status = $this->MFeeTemplate->edit_fee_template($dbparams);
        if (!empty($template_status) && is_array($template_status) && $template_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => array('id' => $template_status['id']));
        } else {
            if (isset($template_status['ErrorMessage']) && !empty($template_status['ErrorMessage']) && is_array($template_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $template_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }

    public function delete_fee_template($params)
    {
        $dbparams = array();
        $dbparams[0] = $params['API_KEY'];

        if (!(isset($params['inst_id']) && !empty($params['inst_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Inst code is required', 'data' => FALSE);
        } else {
            $dbparams[1] = $params['inst_id'];
        }

        if (!(isset($params['template_id']) && !empty($params['template_id']))) {
            return array('data_status' => 0, 'error_status' => 1, 'message' => 'Template ID is required', 'data' => FALSE);
        } else {
            $dbparams[2] = $params['template_id'];
        }
        $template_status = $this->MFeeTemplate->delete_fee_template($dbparams);
        if (!empty($template_status) && is_array($template_status) && $template_status['ErrorStatus'] == 0) {
            return array('data_status' => 1, 'error_status' => 0, 'message' => 'Data updated successfully', 'data' => FALSE);
        } else {
            if (isset($template_status['ErrorMessage']) && !empty($template_status['ErrorMessage']) && is_array($template_status)) {
                return array('data_status' => 0, 'error_status' => 0, 'message' => $template_status['ErrorMessage'], 'data' => FALSE);
            } else {
                return array('data_status' => 0, 'error_status' => 0, 'message' => 'Data insert failed', 'data' => FALSE);
            }
        }
    }
}
