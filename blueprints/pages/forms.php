<?php

use Kirby\Cms\App;

return function () {
	return [
		'title' => 'dreamform.forms',
		'image' => [
			'icon' => 'survey',
			'query' => 'icon',
			'back' => '#fafafa'
		],
		'options' => [
			'create' => false,
			'preview' => false,
			'delete' => false,
			'changeSlug' => false,
			'changeStatus' => false,
			'duplicate' => false,
			'changeTitle' => false,
			'update' => false
		],
		'status' => [
			'draft' => false,
			'unlisted' => true,
			'listed' => false
		],
		'tabs' => [
			'forms' => [
				'label' => 'dreamform.all-forms',
				'icon' => 'survey',
				'sections' => [
					'license' => [
						'type' => 'dreamform-license'
					],
					'forms' => [
						'label' => 'dreamform.forms',
						'type' => 'pages',
						'empty' => 'dreamform.empty-forms',
						'template' => 'form',
						'image' => false
					]
				]
			],
			'submissions' => App::instance()->user()->role()->permissions()->for('tobimori.dreamform', 'accessSubmissions') ? [
				'label' => 'dreamform.recent-submissions',
				'icon' => 'archive',
				'sections' => [
					'license' => [
						'type' => 'dreamform-license'
					],
					'submissions' => [
						'label' => 'dreamform.recent-submissions',
						'type' => 'pages',
						'empty' => 'dreamform.empty-submissions',
						'template' => 'submission',
						'layout' => 'table',
						'create' => false,
						'text' => false,
						// TODO: cache the query as it seems to be slow on larger sites (> 1 sec)
						'query' => "page.index.filterBy('intendedTemplate', 'submission').sortBy('sortDate', 'desc').limit(20)",
						'columns' => [
							'date' => [
								'label' => 'dreamform.submitted-at',
								'type' => 'html',
								'value' => '<a href="{{ page.panel.url }}">{{ page.title }}</a>',
								'mobile' => true
							],
							'form' => [
								'label' => 'dreamform.form',
								'type' => 'html',
								'value' => '<a href="{{ page.parent.panel.url }}?tab=submissions">{{ page.parent.title }}</a>'
							]
						]
					]
				]
			] : false,
		]
	];
};
