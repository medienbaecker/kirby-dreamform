<?php

use Kirby\Cms\App;
use Kirby\Toolkit\A;

return function () {
	return [
		'title' => 'dreamform.form',
		'image' => [
			'icon' => 'survey',
			'query' => 'icon',
			'back' => '#fafafa'
		],
		'num' => 0,
		'options' => [
			'preview' => false,
			'move' => false
		],
		'create' => [
			'title' => [
				'label' => 'dreamform.form-name'
			]
		],
		'status' => [
			'draft' => [
				'label' => 'dreamform.form-draft-label',
				'text' => 'dreamform.form-draft'
			],
			'unlisted' => false,
			'listed' => [
				'label' => 'dreamform.form-listed-label',
				'text' => 'dreamform.form-listed'
			]
		],
		'tabs' => [
			'fields' => [
				'label' => 'dreamform.fields',
				'icon' => 'input-cursor-move',
				'fields' => [
					'fields' => 'dreamform/fields/fields'
				]
			],
			'workflow' => [
				'label' => 'dreamform.workflow',
				'icon' => 'folder-structure',
				'fields' => [
					'actions' => 'dreamform/fields/actions'
				]
			],
			'submissions' => App::instance()->user()->role()->permissions()->for('tobimori.dreamform', 'accessSubmissions') ? 'dreamform/tabs/form-submissions' : false,
			'settings' => [
				'label' => 'dreamform.settings',
				'icon' => 'cog',
				'columns' => A::merge(
					[
						[
							'width' => '1/4',
							'fields' => [
								'_success' => [
									'label' => 'dreamform.success-page',
									'type' => 'headline'
								]
							]
						],
						[
							'width' => '3/4',
							'fields' => [
								'success' => [
									'type' => 'group',
									'extends' => 'dreamform/fields/success'
								]
							]
						],
					],
					App::instance()->option('tobimori.dreamform.storeSubmissions') ? [
						[
							'width' => '1',
							'fields' => [
								'_line' => [
									'type' => 'line'
								]
							]
						],
						[
							'width' => '1/4',
							'fields' => [
								'_submissions' => [
									'label' => 'dreamform.submissions',
									'type' => 'headline'
								]
							]
						],
						[
							'width' => '3/4',
							'fields' => [
								'storeSubmissions' => [
									'label' => 'dreamform.store-submissions',
									'type' => 'toggle',
									'default' => true,
									'help' => 'dreamform.store-submissions-help',
									'width' => '1/3'
								]
							]
						],
					] : []
				)
			]
		]
	];
};
