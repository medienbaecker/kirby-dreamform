<?php

use Kirby\Cms\App;
use tobimori\DreamForm\DreamForm;

return function () {
	$layouts = App::instance()->option('tobimori.dreamform.layouts', ['1/1']);
	$fieldsets = [];

	foreach (DreamForm::fields() as $type => $field) {
		if (!isset($fieldsets[$group = $field::group()])) {
			$fieldsets[$group] = [
				'label' => t("dreamform.{$group}"),
				'type' => 'group',
				'fieldsets' => []
			];
		}

		$fieldsets[$group]['fieldsets']["{$type}-field"] = $field::blueprint();
	}

	return [
		'label' => t('dreamform.fields'),
		'type' => 'layout',
		'layouts' => App::instance()->option('tobimori.dreamform.multiStep', true) ? ["dreamform-page", ...$layouts] : $layouts,
		'fieldsets' => $fieldsets
	];
};
