<?php
/**
 * View class
 *
 * Options Array values:
 * 	'controllerName' 		=> Controller name
 *  'controllerMethod' 	=> Controller method name
 * 	'layout'						=> Layout filename
 * 	'template'					=> Controller->method template name 
 * 												 (default is tpl_controller_method.php)
 */
class View {
	protected $controller = null; // reference back to controller instance
	protected $data = []; // data used in the view templates
	protected $layout = null; // the main layout template content
	protected $content_for_layout = null; // the controller method template content
	protected $options = []; // view rendering parameters
	protected $defaultOptions = [
		'layout' 	=> 'tpl_layout.php'
	];

	/*
		The constructor sets the controller variable, then sets the options array
		by overriding the default options with any options passed into the constructor
	*/
	public function __construct(&$controller, $options = []) {
		$this->controller = $controller;
		$this->options = array_merge($this->defaultOptions, $options);

	} // __construct

	/*
		Sets data for use when rendering the view. The controller code
		should call this setter to make data from the controller available.
	*/
	public function set($key, $value) {
		$this->data[$key] = $value;
	} // set

	/*
		Renders and outputs the templates.
	*/
	public function render($options = []) {
		// update options with any passed directly to render()
		$this->options = array_merge($this->options, $options);
		// use a ternary to assign default template name if not passed
		// default filename format is tpl_controller_method.php
		$this->options['template'] = 
			empty($this->options['template']) ? 
			'tpl_'. $this->options['controllerName'] .'_'. $this->options['controllerMethod'] .'.php' : 
			$this->options['template'];

		// extract data from array into the scope. The view template file can then access the
		// variables as usual without having to go through an array.
		extract($this->data);

		// first render inner content template for controller->method
		// use output buffering to save output to a string variable
		ob_start(); // start buffering
		require($this->options['template']); // include the template file
		$this->content_for_layout = ob_get_contents(); // save output buffer to variable
		ob_end_clean(); // stop buffering and delete buffer contents

		// now do the same for the layout
		// note that the template content is accessible via $this->content_for_layout 
		ob_start(); // start buffering
		require($this->options['layout']); // include the template file
		$this->layout = ob_get_contents(); // save output buffer to variable
		ob_end_clean(); // stop buffering and delete buffer contents

		// output full view
		echo $this->layout;
	} // render

} // View