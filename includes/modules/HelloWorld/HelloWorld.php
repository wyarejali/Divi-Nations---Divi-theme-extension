<?php

class DNE_HelloWorld extends ET_Builder_Module {

	public $slug       = 'dne_hello_world';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => 'https://divi-nations.com',
		'author'     => 'Wyarej Ali',
		'author_uri' => 'https://wyarejali.vercel.app',
	);

	public function init() {
		$this->name = esc_html__( 'Hello World', 'dne-divi-nations' );
	}

	public function get_fields() {
		return array(
			'content' => array(
				'label'           => esc_html__( 'Content', 'dne-divi-nations' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear inside the module.', 'dne-divi-nations' ),
				'toggle_slug'     => 'main_content',
			),
		);
	}

	public function render( $attrs, $content = null, $render_slug ) {
		return sprintf( '<h1>%1$s</h1>', $this->props['content'] );
	}
}

new DNE_HelloWorld;
