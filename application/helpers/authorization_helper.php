<?php  if(! defined('BASEPATH'))
	exit('No direct script access allowed');

	if(! function_exists('verify_access')) {
		/**
		 * @param        $groups
		 * @param string $redirect
		 *
		 * @return bool
		 */
		function verify_access($groups = -1, $redirect = 'dashboard/') {
			$CI =& get_instance();

			if($groups == - 1)
				return FALSE;

			if($CI->ion_auth->logged_in() == FALSE OR $CI->ion_auth->in_group($groups) == FALSE) {
				$CI->session->set_flashdata('error', '<p class="text-error">' . $CI->lang->line('error_access_forbidden') . '</p>');
				redirect(base_url($redirect), 'refresh');
			}
		}
	}
?>