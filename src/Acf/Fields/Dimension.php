<?php

namespace Sitepilot\Theme\Acf\Fields;

class Dimension extends \acf_field
{
	function __construct($settings)
	{
		$this->name = 'sp_dimension';
		$this->label = __('Dimension', 'sp-theme');
		$this->category = 'basic';
		$this->settings = $settings;

		parent::__construct();
	}

	function render_field_settings($field)
	{
		acf_render_field_setting($field, array(
			'label'			=> __('Choices', 'sp-theme'),
			'instructions'	=> __('Enter each choice on a new line.', 'sp-theme') . '<br /><br />' . __('For more control, you may specify both a value and label like this:', 'sp-theme') . '<br /><br />' . __('red : Red', 'sp-theme'),
			'name'			=> 'choices',
			'type'			=> 'textarea',
		));
	}

	function render_field($field)
	{
		$html = '';
		$fields = $field['fields'] ?? [];
		$choices = $field['choices'] ?? [];
		$width = ceil(100 / count($fields)) . '%';

		$html = "<div style=\"display: flex; gap: 5px;\">";

		foreach ($fields as $field_key => $field_name) {
			$field_value = $field['value'][$field_key] ?? $field['default_value'];
			$html .= "<div style=\"width: {$width};\">";
			$html .= "<p style=\"margin-bottom: 2px; font-size: 12px; color: gray;\">{$field_name}</p>";
			$html .= "<select name=\"{$field['name']}[$field_key]\">";
			foreach ($choices as $choice_value => $name) {
				if ((string) $field_value == (string) $choice_value) {
					$selected = ' selected';
				} else {
					$selected = '';
				}
				$html .= "<option value=\"$choice_value\"{$selected}>{$name}</option>";
			}
			$html .= "</select>";
			$html .= "</div>";
		}

		$html .= "</div>";

		echo $html;
	}
}
